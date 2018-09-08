<?php
file_get_contents("php://input");
require_once 'connection.php'; 




$postdata = file_get_contents("php://input");

    $request     = json_decode($postdata);    
    $newName  = $request->newName;
  
    


$people = array();
$sql = "SELECT part as name FROM a$newName";
$result = $conn->query($sql);

  $count = mysqli_num_rows($result);

  $cr = 0;
  while($row = mysqli_fetch_assoc($result))
  {
        $div[$cr]['name']  = $row['name'];
          $cr++;
  }





$json = json_encode($div);
echo $json;
exit;
?>