<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="bootstrap.min.css">
  <script src="js/jquery-1.8.3.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="js/angular.min.js"></script>
<script src="valid.js"></script>
	<title>BATCH</title>
</head>
<body ng-app="ngPatternExample"> 

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">After320</a>
    </div>
    <ul class="nav navbar-nav">
      <li ><a href="class.php">ClASS</a></li>
      <li><a href="division.php">DIVISION</a></li>
      <li class="active"><a href="batch.php">BATCH</a></li>
      <li><a href="addsub.php">SUBJECT</a></li>
      <li><a href="table.php">FACULTY TABLE</a></li>

    </ul>
  </div>
</nav>
<?php if(!isset($_POST['submit1'])) { ?>
<center>
<?php require_once 'classnames.php'; ?>
<form action="batch.php" method="post" style="width: 300px;" >

<select name='cname' class="form-control"><?php
 while ($qv = mysqli_fetch_assoc($ac)) { ?>  
    <option><?php echo $qv['name']; ?></option>
    <?php } ?>
</select>   <br> 
 <input type="submit" name="submit1" value="submit" class="btn btn-primary">

</form>
</center>
<?php } ?>



<?php if(isset($_POST['submit1'])){ ?>
<center>
<form action="pstore1.php" method="post" ng-controller="ExampleController" >
<?php  $s=$_POST['cname'];  ?>
<input type="hidden" name="cname" value="<?php echo $s; ?>">

<?php 
require_once 'connection.php'; 
$sql="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA` = 'attendence1' AND `TABLE_NAME` = 'a$s'";
$names =$conn->query($sql);
$post = array();
while($row = mysqli_fetch_assoc($names))  { $post[] = $row; }
array_splice($post, 0, 1);
 ?>


<h2>BATCH</h2>
<input type="text" name="parta" placeholder="batch_name" class="form-control" style="width: 300px;" ng-model="model" id="input"  my-directive required>
* if batch exists then it auto update <br><br>
<!--student display-->
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


<input type="submit" name="submit222" value="submit">
 </form>
</center>
 <?php } ?>
 
</body>
</html>