<?php
require_once 'connection.php'; 
$class=$_POST['cname']; 
$part=strtolower($_POST['parta']);

$ck  = $conn->query("SELECT part from a$class where part  = '$part'");
if(mysqli_num_rows($ck) != 1){

$sql="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA` = 'attendence1' AND `TABLE_NAME` = 'a$class'";
$names =$conn->query($sql);
$post = array();
while($row = mysqli_fetch_assoc($names))  { $post[] = $row; }
array_splice($post, 0, 1);

foreach ($post as $k) {
	foreach ($k as $e) {
		$conn->query("update a$class set $e = 0 where part = '$part'");
	}
}
}

    $conn->query("INSERT INTO a$class (part) VALUES ('$part')");// optional

    foreach($_POST['check_list'] as $check) {
    	$a =$check;
       $que = "UPDATE A$class SET A$a = 1 WHERE part = '$part'";
       $conn->query($que) or die("error for add data");                                     
         }
echo "DIVISION SUCCESSFUL";
$conn->close();
header( "refresh:2;url=division.php" );

?>