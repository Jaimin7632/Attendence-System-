<?php
require_once 'connection.php'; 



// Delete record by id.
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata))
{
    $request = json_decode($postdata);

    $id  = $request->recordId;//class name

    $sql = "DELETE FROM `nameclass` WHERE `name` = '$id' LIMIT 1";
    mysqli_query($conn,$sql);

    $conn->query("DROP TABLE a$id");
    $df=$conn->query("SELECT * FROM subnames WHERE class='$id'");
    while($row=mysqli_fetch_assoc($df))
    {    
    	$temp=$row['name'];
    	if($row['lec']==1){$conn->query("DROP TABLE $temp");}
    	if($row['lab']==1){$temp = $temp."lab"; $conn->query("DROP TABLE $temp");}
    	$conn->query("DELETE FROM `subnames` WHERE `class` = '$id' LIMIT 1");
    }
}
?>