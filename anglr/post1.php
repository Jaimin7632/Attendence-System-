<?php
file_get_contents("php://input");
require_once 'connection.php'; 




$postdata = file_get_contents("php://input");

    $request     = json_decode($postdata);    
    $newName  = $request->newName;  
 $lol  = $request->lol;
  
     if($lol ==1){ $sql = "SELECT name FROM subnames where class='$newName' AND lec=1"; }
     if($lol ==2){ $sql = "SELECT name FROM subnames where class='$newName' AND lab=1"; }  
 


$people = array();


$result = $conn->query($sql);

  $count = mysqli_num_rows($result);
$cr = 0;
  while($row = mysqli_fetch_assoc($result))
  {
        $sub[$cr]['sub']  = $row['name'];
          $cr++;
  }



$json = json_encode($sub);
echo $json;
exit;
?>