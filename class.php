<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="bootstrap.min.css">
<script src="js/jquery-1.8.3.js"></script>    
<script src="bootstrap/js/bootstrap.js"></script>
<script src="js/angular.min.js"></script>
<script src="valid.js"></script>
	<title></title>
	<style type="text/css">
		.inline{
			display: inline-block;
		}
    .wrn{
      color: #fff;
    }
    #contact-form{
     
      padding: 20px 20px;
    }
  
	</style>
</head>
<body ng-app='myApp'  >

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">After320</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="class.php">ClASS</a></li>
      <li><a href="division.php">DIVISION</a></li>
      <li><a href="batch.php">BATCH</a></li>
      <li><a href="addsub.php">SUBJECT</a></li>
      <li><a href="table.php">FACULTY TABLE</a></li>

    </ul>
  </div>
</nav>
<center><h2>ADD CLASSES</h2></center>
<form action="#" method="post" id="contact-form" >
<center>
<span class="wrn"><strong>*</strong>only Numberic and Alphbates</span>
<br>
<br>

<label>CLASS NAME</label>
<input list="browsers"  name="classname" class="form-control" style="width: 300px;" placeholder="ex. 5comp , 3civil , 2mech"  required>
<datalist id="browsers">
    <?php require_once 'classnames.php'; ?>
         <?php while ($qv = mysqli_fetch_assoc($ac)) { ?>  
    <option><?php echo $qv['name']; ?></option>
         <?php } ?>
</datalist>

<br>
<div  >
<label>COMMON PATTEN</label>
<input type="text" class="form-control" style="width: 300px; " ng-model="ptn" placeholder="eg. 15ce , 17me , 14cl">
<br>
<label>HOW MANY STUDENTS </label>
<input type="text" class="form-control" style="width: 300px; " ng-model="x" placeholder="ex. 50 , 60">

<br>


<div class="container">
    
    <div class="col-md-4" style="margin-bottom: 10px;" ng-repeat="n in [] | range:x">
    <div class="input-group">
      <span class="input-group-addon">
        <input type="checkbox" ng-model="aa" ng-init="aa=true" >
      </span>
     <input type="text" class="form-control" name="check_list[]" ng-disabled="!aa"  value="{{ptn+($index+1 | a)}}" >
    </div>   
 </div>
</div>
    
</div>


<input type="submit" value="Submit" class="btn btn-success" style="padding: 8px 30px; font-size: 17px;" id="submit-button">
</center>
</form>
<br>
<br>
<div ng-app="ajaxExample" ng-controller="mainController">

<center>
 <h4>Already Added Classes</h4>
  <table class="table" style="width:400px;">
    <tr  ng-repeat="per in p">
      <td><center>{{ per.name }}</center></td>
       <td><center><button ng-click="delete( per.name )" style="border: none; background:  #4C4CB8; color: #fff; border-radius: 4px; padding: 5px 10px;">Delete</button></center></td>
    </tr>
  </table>
</center>  
</div>
<script>
var myApp = angular.module('myApp', []);
myApp.filter('range', function() {
  return function(input, total) {
    total = parseInt(total);
    for (var i=0; i<total; i++)
      input.push(i);
    return input;
  };
});
myApp.filter('a', function() {
  return function(inp) {
    if(inp <10 )
    return "0"+inp;
    return inp;
  };
});

myApp.controller('mainController',function($scope,$http){
    $scope.people;

    $scope.get = function() {
          $http({
              
              method: 'GET',
              url: 'anglr/classget.php'
              
          }).then(function (response) {
              
              // on success
              $scope.p = response.data;
              
          });
    };

    $scope.delete = function( id ) {

          $http({
              
              method: 'POST',
              url:  'anglr/classdelete.php',
              data: { recordId : id }
              
          }).then(function (response) {
        
              $scope.get();
        
          });
        };

        $scope.get();
});

</script>
<script>
  $(document).ready(function(){
      $('#submit-button').click(function() {
         $.ajax({
               type:"post",
               url:"dbconnect.php",
               data:  $("#contact-form").serialize(),
               success: function(response){
                  alert("successful");
               }

         });
         return false;    
      });
   });
</script>

</html>