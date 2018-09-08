<?php

require_once 'connection.php'; 
$sql="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA` = 'attendence1' AND `TABLE_NAME` = 'a5comp'";
$names =$conn->query($sql);
$post = array();
while($row = mysqli_fetch_assoc($names))  { $post[] = $row; }
array_splice($post, 0, 1);
$data='( date1 date,ck int(2)';
foreach ($post as $post1) {
  	foreach ($post1 as $post2) {
  		$data=$data.', '.$post2.' int( 2 )';  
  		}
  }
  $data=$data.')';

  $sqlt = 'CREATE TABLE tname1'.$data;  echo $sqlt;
  $conn -> query($sqlt) or die("erroe");

?>