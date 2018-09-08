
<?php 
session_start();
$fid  =  "c0111";  //$_SESSION['user_id'];
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<script src="js/jquery-1.8.3.js"></script>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>
 <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/base/jquery-ui.css">
<link rel="stylesheet" href="bootstrap.min.css">
<script src="bootstrap/js/bootstrap.js"></script>
<script src="js/my.js">


</script>
<style type="text/css">
body{}
.setrelative{ position: relative;
}
.inline{
  display: inline-block;
}
.blk{
  height: 50px; border: 1px solid #000;
 position: relative;
  margin: 2.5px;
  padding: 0 10px;
  width: 100%;    
}

.blkin{
  height: 20px;
  position: absolute;
  top: 50%;
  width: 100%;
  margin-top: -10px;
  text-align: center;
  word-wrap: break-word;
   font-size: 15px; 
  letter-spacing: 1px; 
  margin-left: -10px;
   cursor:default;

}
.sblk{
height: 50px; border: 1px solid #000;  
  margin: 2.5px;
  padding: 0 10px;
  font-size: 15px;
  width: 100%;
  font-weight: bold;
  letter-spacing: 1px;
  position: relative;
}
.hd{
  font-size: 15px;
   font-weight: bold;
}
.t_submit{position: absolute;top: 0px; left:0px; right:0px; height: 100% !important; width: 100% !important; opacity: 0; border: none; background: #ff0; }
.btn-none{background: none ; border: none; font-weight: normal;}
.blk:hover{
  background-color: #4d88ff;
  color: #fff;
}
.n-hover{
  height: 60px;
}
.n-hover:hover{
  background: #FFF;
  color: #000;
}
</style>
</head>
<body>
<?php require_once 'connection.php';   if(!isset($_POST['t_submit'])){  

 ?>


<center> <div class="week-picker"></div></center>
  
<br>
<div class="setrelative" id="ttable" style="opacity: 0; visibility: hidden;">
<center>
<div class="container row">
<div class="col-md-1" style="padding: 2px;">
<div class="sblk n-hover">#</div>
 <div class="sblk"  >
 <div class="blkin">1</div>
 </div>
 <div class="sblk"  >
 <div class="blkin">2</div>
 </div>
           <br>
 <div class="sblk"  >
 <div class="blkin">3</div>
 </div>
 <div class="sblk"  >
 <div class="blkin">4</div>
 </div>
            <br>
 <div class="sblk"  >
 <div class="blkin">5</div>
 </div>
 <div class="sblk"  >
 <div class="blkin">6</div>
 </div>
</div>

<div class="col-md-11" style="padding: 0;">
<?php 

$ar = array("mon", "tue", "wed" , "thu", "fri", "sat");
$arf = array("Monday", "Tuesday", "Wednasday" , "Thusday", "Friday", "Saturday"); 

for ($j=0; $j < 6 ; $j++) { 
$x= $ar[$j];   ?>

<div class="col-sm-2" style="padding: 2px;">
<?php
$i = 1; ?>
<div class="hd blk n-hover"><?php echo $arf[$j]; ?><br>
<input type="button"  <?php if($j !=5){ echo 'id="startDate'; echo $j+1; echo '"';}else{ echo 'id="endDate"';} ?> class="btn-none" disabled>
</div>
<?php
while($i != 7){
  $rowno  = $i;
$sql = $conn->query("SELECT $x from $fid where id = $i");
$row = mysqli_fetch_assoc($sql); 
    $s = $row[$x];  
    $rt = array_pad(explode('-', $s, 3), 3, null);
    $mn1 = $rt[0].'-'.$rt[1]; // display
    $passname = array_pad(explode('[', $mn1, 2), 2, null);
    $mn = $passname[0];   
    $pn = $passname[1]; //check lec or lab
    $ss = $rt[2]; //class name
     ?>
 <div class="blk" <?php if (strpos($pn, 'LAB') !== false) { echo 'style="height:100px;  margin: 3.8px 2.5px;"'; $i++; } ?> >
 <div class="blkin"><?php if($s != ""){echo $mn1;} ?></div>
 <?php if($s != ""){ ?>
  <form  method="post" >
           <input type="hidden" name="sname" value="<?php echo $mn; if (strpos($pn, 'LAB') !== false) { echo 'lab';} ?>">
           <input type="hidden" name="pdate"  <?php if($i !=6){ echo 'class="startDate'; echo $j+1; echo '"';}else{ echo 'class="endDate"';} ?>> 
           <input type="hidden" name="rwno"  value="<?php echo $rowno; ?>" >    
           <input type="hidden" name="cname" value="<?php echo $ss; ?>">       
           <input type="submit" name="t_submit" class="t_submit" >
   </form>
   <?php } ?>
 </div>
<?php if($i ==2 || $i==4){echo '<br>';} ?> 
<?php $i++; }  ?>
</div>
<?php  } ?>
</div>
</div>
</center>   
</div>

 <?php } ?>


<br>
<br>


<?php
if(isset($_POST['t_submit'])){


$d = $_POST['pdate']; 
$s = strtolower($_POST['sname']); 
$r = $_POST['rwno'];
$c = strtolower($_POST['cname']);
$cc = $c;
$rt = explode('-', $s);
if(isset($rt[0])){$fpar = $rt[0];   $fpart = $fpar;}
if(isset($rt[1])){$s = $rt[1];}



   $vqp = $conn->query("SELECT * from attecheck where date1='$d'");
      if (mysqli_affected_rows($conn) == 0) {
     
                 echo "<center>There are no attendence you already filled<center>";
             
      	
      	}
  
    else{  //end at last

 
$sql="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA` = 'attendence1' AND `TABLE_NAME` = '$s' ";
$names =$conn->query($sql) or die("error 1");
$post = array();
$a=0;?>

 <center>
<form action="chng2.php" method="post">
<input type="hidden" name="pdate" value="<?php  echo $d; ?>">
<input type="hidden" name="sname" value="<?php  echo $s; ?>">
<input type="hidden" name="rwno" value="<?php  echo $r; ?>">
<input type="hidden" name="class" value="<?php  echo $cc; ?>">
<input type="hidden" name="part" value="<?php  echo $fpart; ?>">
<?php
while($row = mysqli_fetch_assoc($names))  {
   $x = $row['COLUMN_NAME'];   
      
          $aw=$conn->query("SELECT $x FROM $s WHERE date1='$d'") or die("error 2");
          $m=mysqli_fetch_assoc($aw);
          
        if(($m[$x]==1 || $m[$x] ==0) && $m[$x]!="" && $x !="ck")
        	{       ?>


  <div class="col-md-4" style="margin-bottom: 10px;">
      <div class="input-group">
         <span class="input-group-addon">
            <input type="checkbox" id="yourBox<?php echo $a; ?>" <?php if($m[$x]==1){echo "checked";} ?>>
         </span>
       <input type="text" name="check_list[]" class="form-control" id="yourText<?php echo $a; ?>" value="<?php echo substr($x,1); ?>" <?php if($m[$x]==0){echo "disabled";} ?>><br>
      </div>
  </div>   
        <script type="text/javascript">
 $('#yourBox<?php echo $a; ?>').change(function() {	
	 if($('#yourBox<?php echo $a; ?>').prop("checked") == true){
               document.getElementById('yourText<?php echo $a; ?>').disabled = false;
            }
            else {
              document.getElementById('yourText<?php echo $a++; ?>').disabled = true;
            }

});
    </script> 



        <?php	} //if  end.

 }//while loop end. 

 ?>



<br><input type="submit" value="Submit"  class="btn btn-primary">
</form> 
</center>
<?php  } } $conn->close(); ?>
</body>
</html>