<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="bootstrap.min.css">
  <script src="js/jquery-1.8.3.js"></script>
  <script src="js/angular.min.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script >
   angular.module('ngPatternExample', [])
    .controller('ExampleController', ['$scope', function($scope) {
      $scope.regex = /^[^`~!@#$%\^&*()_+={}|[\]\\:';"<>?,./0-9]*$/;
    }])
    .directive('myDirective', function() {
        function link(scope, elem, attrs, ngModel) {
            ngModel.$parsers.push(function(viewValue) {
              var reg = /^[^`~!@#$%\^&*()_+={}|[\]\\:';"<>?,./0-9]*$/;
              // if view values matches regexp, update model value
              if (viewValue.match(reg)) {
                return viewValue;
              }
              // keep the model value as it is
              var transformedValue = ngModel.$modelValue;
              ngModel.$setViewValue(transformedValue);
              ngModel.$render();
              return transformedValue;
            });
        }

        return {
            restrict: 'A',
            require: 'ngModel',
            link: link
        };      
    });
   
</script>
<style type="text/css">
  table > tr,td,th{
    padding: 10px 10px;
    height: 50px;

  }
  .x{
    width: 80%;

  }
</style>
	<title>ADD_SUBJECT</title>
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
      <li><a href="batch.php">BATCH</a></li>
      <li class="active"><a href="addsub.php">SUBJECT</a></li>
      <li><a href="table.php">FACULTY TABLE</a></li>

    </ul>
  </div>
</nav>
<center>
<h2>ADD SUBJECTS</h2><br>
<form action="addsub.php" method="post" ng-app="app" style="width: 500px;">

 <label style="display: inline-block;">CLASS :</label>
<select name="cname" required class="form-control" style="width: 300px; display: inline-block;">
	<?php require_once 'classnames.php'; ?>
         <?php while ($qv = mysqli_fetch_assoc($ac)) { ?>  
    <option><?php echo $qv['name']; ?></option>
         <?php } ?>
</select>

<br><br>
<table border="">
  <tr>
  <th><center>#</center></th>
    <th><center>SUBJECT NAME</center></th>
    <th><center>LEC</center></th>
    <th><center>LAB</center></th>
  </tr>

  <tr>
  <td><center>1</center></td>
    <td><center><input type="text" name="fname1" class="form-control x" ng-model="model" id="input"  my-directive placeholder="subject" required></center></td>
    <td><center><input type="checkbox" name="lec1" value="lec"></center></td>
    <td><center><input type="checkbox" name="lab1" value="lab"></center></td>
  </tr>
  <tr>
  <td><center>2</center></td>
    <td><center><input type="text" name="fname2" class="form-control x" ng-model="model2" id="input"  my-directive placeholder="subject" ></center></td>
    <td><center><input type="checkbox" name="lec2" value="lec"></center></td>
    <td><center><input type="checkbox" name="lab2" value="lab"></center></td>
  </tr>
  <tr>
  <td><center>3</center></td>
    <td><center><input type="text" name="fname3" class="form-control x" ng-model="model3" id="input"  my-directive placeholder="subject" ></center></td>
    <td><center><input type="checkbox" name="lec3" value="lec"></center></td>
    <td><center><input type="checkbox" name="lab3" value="lab"></center></td>
  </tr>
  <tr>
  <td><center>4</center></td>
    <td><center><input type="text" name="fname4" class="form-control x" ng-model="model4" id="input"  my-directive placeholder="subject"  ></center></td>
    <td><center><input type="checkbox" name="lec4" value="lec"></center></td>
    <td><center><input type="checkbox" name="lab4" value="lab"></center></td>
  </tr>
  <tr>
  <td><center>5</center></td>
    <td><center><input type="text" name="fname5" class="form-control x" ng-model="model5" id="input"  my-directive placeholder="subject"  ></center></td>
    <td><center><input type="checkbox" name="lec5" value="lec"></center></td>
    <td><center><input type="checkbox" name="lab5" value="lab"></center></td>
  </tr>
  <tr>
  <td><center>6</center></td>
    <td><center><input type="text" name="fname6" class="form-control x" ng-model="model6" id="input"  my-directive placeholder="subject"  ></center></td>
    <td><center><input type="checkbox" name="lec6" value="lec"></center></td>
    <td><center><input type="checkbox" name="lab6" value="lab"></center></td>
  </tr>
  <tr>
  <td><center>7</center></td>
    <td><center><input type="text" name="fname7" class="form-control x" ng-model="model7" id="input"  my-directive placeholder="subject"  ></center></td>
    <td><center><input type="checkbox" name="lec7" value="lec"></center></td>
    <td><center><input type="checkbox" name="lab7" value="lab"></center></td>
  </tr>

</table>
<br>
<br>
<input type="submit" name="submit76" value="ADD" class="btn btn-primary" style="padding: 8px 30px;">
</center>

</form>
<?php require_once 'connection.php'; 

if(isset($_POST['submit76'])){
	$cname = strtolower($_POST['cname']);
	$conn -> query("CREATE TABLE IF NOT EXISTS subnames (class varchar(30), name varchar(32) PRIMARY KEY,lec int(2),lab int(2))") or die("create erroe");
$lec =0 ; $lab=0;

$sql="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA` = 'attendence1' AND `TABLE_NAME` = 'a$cname'";
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




if($_POST['fname1'] != ""){
	$a = $_POST['fname1'];
	if(isset($_POST['lec1'])){ $lec =1 ; $tname1 = $_POST['fname1'];}
	if(isset($_POST['lab1'])){ $lab =1 ; $tname2 = $_POST['fname1'] ."lab";}
$conn-> query("INSERT INTO subnames (class,name,lec,lab) VALUES ('$cname','$a',$lec,$lab)") or die("insert error");
    
if(isset($tname1)){ 
  $sqlt = 'CREATE TABLE '.$tname1.$data;
$conn -> query($sqlt) or die($conn->connect_error);
  

}	
if(isset($tname2)){ 
  $sqlt = 'CREATE TABLE '.$tname2.$data;
$conn -> query($sqlt) or die($conn->connect_error);
 

}
	
}
//sub
if($_POST['fname2'] != ""){
  $a = $_POST['fname2'];
  $tname1 = '';
  $tname2 = '';
  $lec = 0;
  $lab = 0;
  if(isset($_POST['lec2'])){ $lec =1 ; $tname1 = $_POST['fname2'];}
  if(isset($_POST['lab2'])){ $lab =1 ; $tname2 = $_POST['fname2'] ."lab";}
$conn-> query("INSERT INTO subnames (class,name,lec,lab) VALUES ('$cname','$a',$lec,$lab)") or die("insert error");

 
    
if($tname1 != ''){ 
  $sqlt = 'CREATE TABLE '.$tname1.$data;
$conn -> query($sqlt) or die($conn->connect_error);
  

} 
if($tname2 != ''){ 
  $sqlt = 'CREATE TABLE '.$tname2.$data;
$conn -> query($sqlt) or die($conn->connect_error);
  

}
  
}

//sub
if($_POST['fname3'] != ""){
  $a = $_POST['fname3'];
  $tname1 = '';
  $tname2 = '';
  $lec = 0;
  $lab = 0;
  if(isset($_POST['lec3'])){ $lec =1 ; $tname1 = $_POST['fname3'];}
  if(isset($_POST['lab3'])){ $lab =1 ; $tname2 = $_POST['fname3'] ."lab";}
$conn-> query("INSERT INTO subnames (class,name,lec,lab) VALUES ('$cname','$a',$lec,$lab)") or die("insert error");

 
    
if($tname1 != ''){ 
  $sqlt = 'CREATE TABLE '.$tname1.$data;
$conn -> query($sqlt) or die($conn->connect_error);
  

} 
if($tname2 != ''){ 
  $sqlt = 'CREATE TABLE '.$tname2.$data;
$conn -> query($sqlt) or die($conn->connect_error);
 

}
  
}

//sub
if($_POST['fname4'] != ""){
  $a = $_POST['fname4'];
  $tname1 = '';
  $tname2 = '';
  $lec = 0;
  $lab = 0;
  if(isset($_POST['lec4'])){ $lec =1 ; $tname1 = $_POST['fname4'];}
  if(isset($_POST['lab4'])){ $lab =1 ; $tname2 = $_POST['fname4'] ."lab";}
$conn-> query("INSERT INTO subnames (class,name,lec,lab) VALUES ('$cname','$a',$lec,$lab)") or die("insert error");

 
    
if($tname1 != ''){ 
  $sqlt = 'CREATE TABLE '.$tname1.$data;
$conn -> query($sqlt) or die($conn->connect_error);
 

} 
if($tname2 != ''){ 
  $sqlt = 'CREATE TABLE '.$tname2.$data;
$conn -> query($sqlt) or die($conn->connect_error);
 
}
  
}

//sub
if($_POST['fname5'] != ""){
  $a = $_POST['fname5'];
  $tname1 = '';
  $tname2 = '';
  $lec = 0;
  $lab = 0;
  if(isset($_POST['lec5'])){ $lec =1 ; $tname1 = $_POST['fname5'];}
  if(isset($_POST['lab5'])){ $lab =1 ; $tname2 = $_POST['fname5'] ."lab";}
$conn-> query("INSERT INTO subnames (class,name,lec,lab) VALUES ('$cname','$a',$lec,$lab)") or die("insert error");

 
    
if($tname1 != ''){ 
  $sqlt = 'CREATE TABLE '.$tname1.$data;
$conn -> query($sqlt) or die($conn->connect_error);
  

} 
if($tname2 != ''){ 
  $sqlt = 'CREATE TABLE '.$tname2.$data;
$conn -> query($sqlt) or die($conn->connect_error);
  
}
  
}

//sub
if($_POST['fname6'] != ""){
  $a = $_POST['fname6'];
  $tname1 = '';
  $tname2 = '';
  $lec = 0;
  $lab = 0;
  if(isset($_POST['lec6'])){ $lec =1 ; $tname1 = $_POST['fname6'];}
  if(isset($_POST['lab6'])){ $lab =1 ; $tname2 = $_POST['fname6'] ."lab";}
$conn-> query("INSERT INTO subnames (class,name,lec,lab) VALUES ('$cname','$a',$lec,$lab)") or die("insert error");

 
    
if($tname1 != ''){ 
  $sqlt = 'CREATE TABLE '.$tname1.$data;
$conn -> query($sqlt) or die($conn->connect_error);
  
} 
if($tname2 != ''){ 
  $sqlt = 'CREATE TABLE '.$tname2.$data;
$conn -> query($sqlt) or die($conn->connect_error);
 
}
  
}

//sub
if($_POST['fname7'] != ""){
  $a = $_POST['fname7'];
  $tname1 = '';
  $tname2 = '';
  $lec = 0;
  $lab = 0;
  if(isset($_POST['lec7'])){ $lec =1 ; $tname1 = $_POST['fname7'];}
  if(isset($_POST['lab7'])){ $lab =1 ; $tname2 = $_POST['fname7'] ."lab";}
$conn-> query("INSERT INTO subnames (class,name,lec,lab) VALUES ('$cname','$a',$lec,$lab)") or die("insert error");

 
    
if($tname1 != ''){ 
  $sqlt = 'CREATE TABLE '.$tname1.$data;
$conn -> query($sqlt) or die($conn->connect_error);
  
} 
if($tname2 != ''){ 
  $sqlt = 'CREATE TABLE '.$tname2.$data;
$conn -> query($sqlt) or die($conn->connect_error);
 
}
  
}

echo "SUCCESSFULLY SUBJECTS ADDED";
 
} ?>

</center>
</body>
</html>