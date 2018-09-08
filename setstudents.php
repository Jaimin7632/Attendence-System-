<?php
require_once 'connection.php'; 

#$facultyid= $_GET['fid'];
$dat = $_POST['pdate'];
$subn =$_POST['sname'];
$rn = $_POST['rwno'];
$class = $_POST['class'];
$part = $_POST['part'];
$xx = 0;
$check  = $conn->query("INSERT INTO attecheck (date1, lecno,sname) VALUES ('$dat',$rn,'$subn')") or die($conn->connect_error);

$conn->query("INSERT INTO $subn (date1,ck) VALUES ('$dat',0)") or die("subject not found");

$sql="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA` = 'attendence1' AND `TABLE_NAME` = 'a$class' ";
$names =$conn->query($sql);
$post = array();
while($row = mysqli_fetch_assoc($names))  {
   $x = $row['COLUMN_NAME'];   
   $a=$conn->query("SELECT $x FROM A$class WHERE part='$part'") or die("error 1");
   $c=mysqli_fetch_assoc($a);
      
         foreach ($c as $key => $m) {
           if($m == 1){ $post[] = $row; }
         
       }
 }
if($post[0] == 'part'){array_splice($post, 0,1);}
foreach ($post as $k) {
	foreach ($k as $kk) {
		$conn->query("UPDATE $subn SET $kk = 0 WHERE date1 = '$dat' AND ck = 0");
	}
}

if(!empty($_POST['check_list'])) {
    foreach($_POST['check_list'] as $check) {
    	$a =$check;
  
       $que = "UPDATE $subn SET A$a = 1 WHERE date1 = '$dat' AND ck=0";
       $conn->query($que) or die("error for add data");                                     
         }
}
$conn->query("UPDATE $subn SET ck = 1 WHERE date1 = '$dat'");
$conn->close();
echo "<center><h2>Successful</h2></center>";
header( "refresh:2;url=faculty1.php" );

?>
