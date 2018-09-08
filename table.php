<!DOCTYPE html>
<html  ng-app="ajaxExample">
<head>
	<title></title>
  <link rel="stylesheet" href="bootstrap.min.css">
  <script src="js/jquery-1.8.3.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
      <script src="js/angular.min.js"></script>
  
	<style type="text/css">
		.inline{
			display: inline-block;
		}
		.a{
			margin: 0 3px; 
			background: #f1f1f1;
			padding: 6px 10px;			
			border: none;
		}
    .main > table { z-index: 0; }
    td , th {
      padding: 10px 10px;
    }
		.intin{position: absolute; background: #FFF;
			box-shadow: 0 0 3px 1px #ccc; z-index: 2;
      visibility: hidden;
			padding: 10px 20px;
      transition: all ease-out .1s; }

      .intin:after {
  bottom: 100%;
  left: 40%;
  border: solid transparent;
  content: " ";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
  border-color: rgba(255, 255, 255, 0);
  border-bottom-color: #ffffff;
  border-width: 10px;
  margin-left: -10px;
}
      .intin > .icon-close{
        position: absolute;
        right: 0px; top: 0px;
        height: 20px; width: 20px;
        background : #FF408C;
        
      }
		.op{opacity: 0;}
    .csel, .dsel{
      width: 150px;
      margin-bottom: 10px;
    }
		.active{
			background: #19A3FF;color: #FFF;
		}
.inner-addon { 
    position: relative; 
    width: 200px;
}

/* style icon */
.inner-addon .glyphicon {
  position: absolute;
  padding-top: 12px;
  padding-right: 10px;
   cursor:default;
  }

/* align icon */
.left-addon .glyphicon  { left:  0px;}
.right-addon .glyphicon { right: 0px;}

/* add padding  */
.left-addon input  { padding-left:  30px; }
.right-addon input { padding-right: 30px; }
.int{
  box-shadow: none; border: none;
  padding: 20px 20px;
 
}

	</style>
   

</head>
<body ng-controller="mainController" >
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">After320</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="class.php">ClASS</a></li>
      <li><a href="division.php">DIVISION</a></li>
      <li><a href="batch.php">BATCH</a></li>
      <li><a href="addsub.php">SUBJECT</a></li>
      <li class="active"><a href="table.php">FACULTY TABLE</a></li>

    </ul>
  </div>
</nav>


<div class="main"> 
<form action="#" id="tform">
<center><h2>falculty id from database [ffid]</h2>

<table border="" >
  <tbody>
    <tr>
      <th><center>#</center></th>
      <th><center>Monday</center></th>
      <th><center>Tuesday</center></th>
      <th><center>Wednasday</center></th>
      <th><center>Thusday</center></th>
      <th><center>Friday</center></th>
      <th><center>Saturday</center></th>
    </tr>

    <?php $row =1; 
    while($row != 7){ ?>
    <tr>
        
       <td><center><?php echo $row;?></center></td>
         <?php for ($i=1; $i <=6 ; $i++) { ?>
        <td>
        <center>
        <div class="par<?php echo $row; echo $i; ?>">

<div class="inner-addon right-addon">
    <i class="glyphicon glyphicon-remove"></i>
    <input type="text"  id="input" class="int form-control"  readonly>
</div>


<input type="hidden"   id="input" class="int2" name="blk<?php echo $row; echo $i; ?>" value="">
<div class="intin op">
 <img src="close.png" class="icon-close">

   <center>
       <div class="btn2">
          <input type="button" value="LEC" class="a inline" ng-click="count = 1" >
          <input type="button" value="LAB" class="a inline" ng-click="count = 2" >
       </div>
<br>
     <select   class="csel form-control inline"  ng-change="addPerson()" ng-model="newName">
       <option value="" selected>Select Class</option>
       <?php include 'classnames.php'; 
             while ($qv = mysqli_fetch_assoc($ac)) { ?>  
    <option value="<?php echo $qv['name']; ?>"><?php echo $qv['name']; ?></option>
    <?php } ?>

      </select>
      <select   class="dsel form-control  inline" >
       <option value="" selected="true">divison / batch</option>
        <option  ng-repeat="p in div" value="{{p.name}}">{{p.name}}</option>
      </select>
      <br>
       <select   class="ssel form-control " >
       <option value="" selected="true">Select Subject</option>
        <option  ng-repeat="s in subject" value="{{s.sub}}">{{s.sub}}</option>
      </select>
      <br>
      <input type="button" class="kbtn btn btn-success" value="Submit" ng-click="clear()">
   </center>
</div>
</div>
          
        </center>
        </td>
        <?php } ?>
    </tr>
    <?php $row++; } ?>
  
   
  </tbody>
</table>
<br>
<br>
<input type="submit" class="btn btn-success" style="padding: 10px 40px; font-size: 20px;" id="submit16" value="Submit Table">
<br>
<br>
<span class="wrn"><strong>*</strong> if table exists then it auto update to this new table</span>

</center>
</form> 
</div>

<script>
  $(document).ready(function(){
      $('#submit16').click(function() {
         $.ajax({
               type:"post",
               url:"tablestore.php",
               data:  $("#tform").serialize(),
               success: function(response){
                  alert("successful");
               }

         });
         return false;    
      });
   });
</script>


<script>   
 
$(document).ready(function () {
	 var $ida = '';
  var l ="";
	var cls = "";
  var div = "";
  var sub = "";


	 $('.int').click(function(e) {
  	       var $parent = $(this).parent();
           $ida = $($parent).parent();
           $($ida).find('.intin').css({"opacity": "1"});         
           $($ida).find('.intin').css({"visibility": "visible"}); 
            $( $ida ).find( "select" ).prop('disabled', true);
             $( $ida ).find( ".kbtn" ).prop('disabled', true); 
            $('.main div .int').css("pointer-events","none");
            $($ida).find('.btn2 input').removeClass('active');
            

    });
   
  

    $('.btn2 input').click(function(e) {
        $('.btn2 input').removeClass('active');
        var $parent = $(this).parent();
        $(this).addClass('active');
        var aa =$(this).val();
        
        if(aa == 'LEC'){
          l ="";          
        }
        if(aa == 'LAB'){        
        	 l =aa;     
        }
        $( $ida ).find( ".csel" ).prop('disabled', false);
        e.preventDefault();
    });
    $('.csel').click( function() {
          var val = $(this).val();
          if(val != ""){
          cls = val;
         $( $ida ).find( ".dsel" ).prop('disabled', false);
           }
    });
    $('.dsel').click( function() {
          var val2 = $(this).val();
          if(val2 != ""){
          div= val2;
         $( $ida ).find( ".ssel" ).prop('disabled', false);
         }
    });
     $('.ssel').click( function() {
          var val3 = $(this).val();
          if(val3 != ""){
          sub = val3;            
            $( $ida ).find( ".kbtn" ).prop('disabled', false);      
         }          
    });

     $('.kbtn').click(function(){
         $($ida).find('.intin').css({"opacity": "0"});
          $('.main div .int').css("pointer-events","auto");
           $($ida).find('.intin').css({"visibility": "hidden"});    
            
            $($ida).find('.int2').val(div+"-"+sub+"["+l+"]-"+cls);
            $($ida).find('.int').val(div+"-"+sub+"["+l+"]");


           $( $ida ).find( ".csel" ).val("");
         $ida = ''; 
        cls = "";
        div = "";
         sub = "";
       
         l ="";
     });

      $('.icon-close').click(function(e){
     $($ida).find('.intin').css({"opacity": "0"});
          $('.main div .int').css("pointer-events","auto");
           $($ida).find('.intin').css({"visibility": "hidden"}); 
            $(rw).attr("rowspan","1");   
             $ida = ''; 
             cls = "";
             div = "";
             sub = "";  
            
             l ="";
   });
   $('.glyphicon').click(function(e){
     var parent = $(this).parent();
      $(parent).find('.int').val("");
     var parent2 = $(parent).parent();
      $(parent2).find('.int2').val("");
      var parent3 = $(parent2).parent();
      var parent4 = $(parent3).parent();
        $(parent4).attr("rowspan","1");   
         
   });
 


});


</script>
 <script type="text/javascript">
      var ajaxExample = angular.module('ajaxExample', []);

ajaxExample.controller('mainController',function($scope,$http){
    $scope.people;

  

    $scope.addPerson = function() {        
          $http({              
               method: 'POST',
               url:  'anglr/post.php',
               data: {newName: $scope.newName}
               
          }).then(function (response) {// on success
            
                $scope.div = response.data;
                           
          });
          $http({
              
               method: 'POST',
               url:  'anglr/post1.php',
               data: {newName: $scope.newName,lol : $scope.count}
               
          }).then(function (response) {// on success
            
                $scope.subject = response.data;

                           
          });
    };
    $scope.clear = function(){
        $scope.newName = "";
       $scope.count = 0;
          
    };

   

       
});
    </script>
   
</body>
</html>