<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" href="bootstrap.min.css">
  <script src="js/jquery-1.8.3.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
</head>
<body  >

<?php
require_once 'connection.php'; 
$d = $_POST['pdate']; 
$s = strtolower($_POST['sname']); 
$r = $_POST['rwno'];
$c = strtolower($_POST['cname']);
$cc = $c;
$rt = explode('-', $s);

if(isset($rt[0])){$fpar = $rt[0];   $fpart = $fpar;}
if(isset($rt[1])){$ss = $rt[1]; $s = $ss;}

$conn->query("CREATE TABLE IF NOT EXISTS attecheck ( date1 date,lecno int(3),sname varchar(20))");
$check = $conn->query("SELECT lecno FROM attecheck WHERE date1='$d' AND sname='$s'");

$rw = mysqli_fetch_assoc($check);
if($rw['lecno'] == $r){

echo "you already filled attendence";
header( "refresh:3;url=faculty1.php" );
}
else{   ?>


<?php 
$sql="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA` = 'attendence1' AND `TABLE_NAME` = 'A$c' ";
$names =$conn->query($sql) or die("error 1");
$post = array();
while($row = mysqli_fetch_assoc($names))  {
   $x = $row['COLUMN_NAME'];   
     if(isset($ss)){ 
          $a=$conn->query("SELECT $x FROM A$cc WHERE part='$fpart'") or die("error 2");
          $c=mysqli_fetch_assoc($a);
          foreach ($c as $key => $m) {  if($m == 1){  $post[] = $row; }    }
       }
    else{ $post[] = $row;   }                          
 }
if(!isset($ss)){  array_splice($post, 0,1);}
 ?>

 <center>
<form action="setstudents.php" method="post">
<input type="hidden" name="pdate" value="<?php  echo $d; ?>">
<input type="hidden" name="sname" value="<?php  echo $s; ?>">
<input type="hidden" name="rwno" value="<?php  echo $r; ?>">
<input type="hidden" name="class" value="<?php  echo $cc; ?>">
<input type="hidden" name="part" value="<?php  echo $fpart; ?>">



<?php $a = 0; ?>
<div class="container">
<?php  foreach($post as $qw): ?>
    <?php foreach($qw as $key): ?>  
    <div class="col-md-4" style="margin-bottom: 10px;">
      <div class="input-group">
       <span class="input-group-addon">
        <input type="checkbox" id="yourBox<?php echo $a; ?>" checked>
      </span>
<input type="text" name="check_list[]" class="form-control" id="yourText<?php echo $a; ?>" value="<?php echo substr($key,1); ?>" ><br>
      </div>
    </div>   
        <script type="text/javascript">
document.getElementById('yourBox<?php echo $a; ?>').onchange = function() {
    document.getElementById('yourText<?php echo $a++; ?>').disabled = !this.checked;
};
    </script> 
    <?php endforeach; ?>
<?php endforeach; ?>   
</div>


<br><input type="submit" value="Submit" class="btn btn-primary">
</form> 
</center>
<?php } $conn->close(); ?>

<script type="text/javascript" src="./jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="./js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
<script type="text/javascript">

  $('.form_date').datetimepicker({
    language:  'fr', 
      format: 'yyyy-mm-dd',     
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
    });
 
</script>

</body>
</html>
