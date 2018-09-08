<?php
require_once 'connection.php'; 
$classname = "class1";
$sql1="SELECT subname1 from $classname";
$subname =$conn->query($sql1);
$sname = array();

$saname = array();
$saname1 = array();
    while($row = mysql_fetch_assoc($subname))
    {
        $sname[] = $row;
        $b = $row['subname1'];
        $a = "SELECT lec FROM $classname WHERE subname1 = '$b'";
		$rs = $conn->query($a);
        $res = mysqli_fetch_assoc($rs);
		if($res ==  1){$saname = $key ."lec";}
        
		$a = "SELECT lab FROM $classname WHERE subname1 = '$b'";
		$es = $conn->query($a);
		$ees = mysqli_fetch_assoc($es);
		if($ees ==  1){$saname1 = $key ."lab";}


    }

$conn->close();



?>