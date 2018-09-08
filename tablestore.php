<?php
include 'connection.php';
$ffid = 'c0111';
$blk11 = $_POST['blk11'];
$blk12 = $_POST['blk12'];
$blk13 = $_POST['blk13'];
$blk14 = $_POST['blk14'];
$blk15 = $_POST['blk15'];
$blk16 = $_POST['blk16'];

$blk21 = $_POST['blk21'];
$blk22 = $_POST['blk22'];
$blk23 = $_POST['blk23'];
$blk24 = $_POST['blk24'];
$blk25 = $_POST['blk25'];
$blk26 = $_POST['blk26'];

$blk31 = $_POST['blk31'];
$blk32 = $_POST['blk32'];
$blk33 = $_POST['blk33'];
$blk34 = $_POST['blk34'];
$blk35 = $_POST['blk35'];
$blk36 = $_POST['blk36'];

$blk41 = $_POST['blk41'];
$blk42 = $_POST['blk42'];
$blk43 = $_POST['blk43'];
$blk44 = $_POST['blk44'];
$blk45 = $_POST['blk45'];
$blk46 = $_POST['blk46'];

$blk51 = $_POST['blk51'];
$blk52 = $_POST['blk52'];
$blk53 = $_POST['blk53'];
$blk54 = $_POST['blk54'];
$blk55 = $_POST['blk55'];
$blk56 = $_POST['blk56'];

$blk61 = $_POST['blk61'];
$blk62 = $_POST['blk62'];
$blk63 = $_POST['blk63'];
$blk64 = $_POST['blk64'];
$blk65 = $_POST['blk65'];
$blk66 = $_POST['blk66'];



   $conn->query("DROP TABLE $ffid");


$conn->query("CREATE TABLE IF NOT EXISTS $ffid (id int(2),mon varchar(32) NOT NULL,tue varchar(32) NOT NULL,wed varchar(32) NOT NULL,thu varchar(32) NOT NULL,fri varchar(32) NOT NULL,sat varchar(32) NOT NULL)");
$a = $conn->query("INSERT INTO $ffid(id,mon,tue,wed,thu,fri,sat) VALUES (1,'$blk11','$blk12','$blk13','$blk14','$blk15','$blk16')") or die("error 1");

$b = $conn->query("INSERT INTO $ffid(id,mon,tue,wed,thu,fri,sat) VALUES (2,'$blk21','$blk22','$blk23','$blk24','$blk25','$blk26')") or die("error 2");

$c = $conn->query("INSERT INTO $ffid(id,mon,tue,wed,thu,fri,sat) VALUES (3,'$blk31','$blk32','$blk33','$blk34','$blk35','$blk36')") or die("error 3");

$d = $conn->query("INSERT INTO $ffid(id,mon,tue,wed,thu,fri,sat) VALUES (4,'$blk41','$blk42','$blk43','$blk44','$blk45','$blk46')") or die("error 4");

$e = $conn->query("INSERT INTO $ffid(id,mon,tue,wed,thu,fri,sat) VALUES (5,'$blk51','$blk52','$blk53','$blk54','$blk55','$blk56')") or die("error 5");

$d = $conn->query("INSERT INTO $ffid(id,mon,tue,wed,thu,fri,sat) VALUES (6,'$blk61','$blk62','$blk63','$blk64','$blk65','$blk66')") or die("error 6");
?>