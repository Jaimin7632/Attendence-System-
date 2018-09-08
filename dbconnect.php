<?php

require_once 'connection.php'; 

$class  = preg_replace('/[^a-zA-Z0-9]/','',$_POST['classname']);


$conn -> query("CREATE TABLE IF NOT EXISTS nameclass ( name varchar(32) PRIMARY KEY)") or die("create erroe") or die("error 1");
$ck =$conn-> query("INSERT INTO nameclass (name) VALUES ('$class')") or die("insert error");

$conn -> query("CREATE TABLE IF NOT EXISTS a$class(part varchar(20) PRIMARY KEY)") or die("class table error");
if(!empty($_POST['check_list'])) {
    foreach($_POST['check_list'] as $check) {
             $conn->query("ALTER TABLE A$class ADD A$check int( 2 )") or die("error 4");       
                                                 
         }
}
$conn->query("INSERT INTO a$class(part) VALUES ('$class')");

$sql="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA` = 'attendence1' AND `TABLE_NAME` = 'a$class'";
$names =$conn->query($sql);
$post = array();
while($row = mysqli_fetch_assoc($names))  { $post[] = $row; }
array_splice($post, 0, 1);

foreach ($post as $k) {
	foreach ($k as $e) {
		$conn->query("update a$class set $e = 1 where part = '$class'");
	}
}


$conn->close();
echo "SUCCESSFUL";


?>