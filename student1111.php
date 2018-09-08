<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Materil | Angular Material Design Admin Template</title>
  <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="../libs/assets/animate.css/animate.css" type="text/css" />
  <link rel="stylesheet" href="../libs/assets/font-awesome/css/font-awesome.css" type="text/css" />
  <link rel="stylesheet" href="../libs/jquery/waves/dist/waves.css" type="text/css" />
  <link rel="stylesheet" href="styles/material-design-icons.css" type="text/css" />

  <link rel="stylesheet" href="../libs/jquery/bootstrap/dist/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="styles/font.css" type="text/css" />
  <link rel="stylesheet" href="styles/app.css" type="text/css" />
<style type="text/css">
  .panel-card{
    height: 250px;
  }
  .m-b{font-size: 15px; }
</style>
</head>
<body>
<div class="ng-app container">



<?php
require_once 'connection.php'; 
$student = "16cl02";
$qv = $conn->query("SELECT name from nameclass");
while($ow = mysqli_fetch_assoc($qv)){
  $g= $ow['name'];
  $pp  = $conn->query("SELECT a$student from a$g");
  if($pp){
  if(mysqli_num_rows($pp) != 0){
    $class = $g;
  }
}
}



$sql11="SELECT name from subnames WHERE class='$class'";
$subname =$conn->query($sql11);
$sname = array();
    while($row = mysqli_fetch_assoc($subname))
    {
        $sname[] = $row;
    }   

 $sum =0;
 $cnt = 0;
 $attesname1 = array();
  $attesname2 = array(); 
  $v = 0;
foreach ($sname as $key => $value) {
   foreach ($value as $ke ) {
        $leccheck = $conn->query("SELECT lec FROM subnames WHERE name = '$ke'");
        $rw = mysqli_fetch_assoc($leccheck);
          $laccheck = $conn->query("SELECT lab FROM subnames WHERE name = '$ke'");
        $sw = mysqli_fetch_assoc($laccheck);
                      if($rw["lec"] && $sw["lab"]){
                      
                   $asd = $ke;                    
                      $attedq= $conn->query("Select (Count(A$student)* 100 / (Select Count(A$student) From $asd WHERE A$student=0 OR A$student=1 )) as Score From $asd WHERE A$student = 1");
                      $resatted = mysqli_fetch_assoc($attedq);
                      $attesname1[] = $resatted["Score"]; 
                   $asa = $ke."lab";   
                      $attedq= $conn->query("Select (Count(A$student)* 100 / (Select Count(*) From $asa)) as Score From $asa WHERE A$student = 1");
                      $resatted2 = mysqli_fetch_assoc($attedq);
                      $attesname2[] = $resatted2["Score"];  
                    
                   $fgh = $conn->query("Select Count(A$student) AS cnt From $asd WHERE A$student=0 OR A$student=1");
                   $fgj= $conn->query("Select Count(A$student) AS cnt From $asa WHERE A$student=0 OR A$student=1");
                   $fgh1 = mysqli_fetch_assoc($fgh);
                   $fgj1 = mysqli_fetch_assoc($fgj);
                   $tolec = $fgh1['cnt'] + $fgj1['cnt'];
              
                   $hh = $conn->query("Select Count(A$student) AS cnt From $asd WHERE A$student=1");
                   $hh1= $conn->query("Select Count(A$student) AS cnt From $asa WHERE A$student=0 OR A$student=1");
                   $ff = mysqli_fetch_assoc($hh);
                   $ff1 = mysqli_fetch_assoc($hh1);
                   $plec = $ff['cnt'] + $ff1['cnt'];
                  
                   if ($tolec == 0) { $tolec =1; $nolec  = ' [ NO LEC/LAB ] ';}
                   else{$cnt++;}   
                   $totalatte = ($plec * 100)/$tolec;   
                        $sum = $sum + $totalatte;
                  
                       ?>
<div class="col-sm-4">
<div class="panel panel-card p m-b-sm">
        <h5 class="no-margin m-b"><?php echo strtoupper($ke);?></h5>
        <div class="text-center">
          <div class="inline">
            <div ui-jp="easyPieChart" ui-options="{
                percent: <?php echo round($totalatte); ?>,
                lineWidth: 12,
                trackColor: '#f1f2f3',
                barColor: '#4caf50',
                scaleColor: '#fff',
                size: 167,
                lineCap: 'butt',
                color: '',
                animate: 3000,
                rotate: 0
              }" ng-init="color = getColor(app.setting.theme.primary, 400)">
              <div class="font-bold text-primary" style="font-size: 20px;">
                <?php echo round($totalatte); ?>%
              </div>
            </div>
          </div>
        </div>
        <div>
          <div><small>Lec : <?php echo round($resatted["Score"]); ?> %   ||   Lab : <?php echo round($resatted2["Score"]); ?> %</small><?php if(isset($nolec)){ echo $nolec;}?></div>
          </div>
      </div>
</div>
                  <?php
                    }          
                    elseif($rw["lec"]){
                     
                      $asd = $ke;                    
                        $attedq= $conn->query("Select (Count(A$student)* 100 / (Select Count(A$student) From $asd WHERE A$student=0 OR A$student=1 )) as Score From $asd WHERE A$student = 1");
                      $resatted = mysqli_fetch_assoc($attedq);
                      $attesname1[] = $resatted["Score"];  
                       $sum = $sum + $resatted["Score"];
                       $cnt++;
                       ?> 
<div class="col-sm-4">
 <div class="panel panel-card p m-b-sm">
        <h5 class="no-margin m-b"><?php echo strtoupper($asd); ?></h5>
        <div class="text-center">
          <div class="inline">
            <div ui-jp="easyPieChart" ui-options="{
                percent: <?php echo round($resatted["Score"]); ?>,
                lineWidth: 12,
                trackColor: '#f1f2f3',
                barColor: '#4caf50',
                scaleColor: '#fff',
                size: 167,
                lineCap: 'butt',
                color: '',
                animate: 3000,
                rotate: 0
              }" ng-init="color = getColor(app.setting.theme.primary, 400)">
              <div class="font-bold text-primary" style="font-size: 20px;">
                <?php echo round($resatted["Score"]); ?>%
              </div>
            </div>
          </div>
        </div>
        <div>
          <div></div>
          </div>
      </div> 
</div>

             
                      <?php 
                    }
            
                      elseif($sw["lab"]){ 
                        
                         $asa = $ke."lab";   
                         $attedq= $conn->query("Select (Count(A$student)* 100 / (Select Count(A$student) From $asa WHERE A$student=0 OR A$student=1 )) as Score From $asa WHERE A$student = 1");
                      $resatted2 = mysqli_fetch_assoc($attedq);
                      $attesname2[] = $resatted2["Score"]; 
                      $sum = $sum + $resatted2["Score"];
                       $cnt++;
                         ?> 
<div class="col-sm-4"> 
<div class="panel panel-card p m-b-sm">
        <h5 class="no-margin m-b"><?php echo strtoupper($asa); ?></h5>
        <div class="text-center">
          <div class="inline">
            <div ui-jp="easyPieChart" ui-options="{
                percent: <?php echo round($resatted2["Score"]); ?>,
                lineWidth: 12,
                trackColor: '#f1f2f3',
                barColor: '#2196F3',
                scaleColor: '#fff',
                size: 167,
                lineCap: 'butt',
                color: '',
                animate: 3000,
                rotate: 0
              }" ng-init="color = getColor(app.setting.theme.primary, 400)">
              <div class="font-bold text-info" style="font-size: 20px;">
                <?php echo round($resatted2["Score"]); ?>%
              </div>
            </div>
          </div>
        </div>
        <div>
          <div></div>
          </div>
      </div> 
</div>
 
                         <?php 
                    }
                    else{}

   }
} 
$conn->close();
?>

<div class="col-sm-4">
<div class="panel panel-card p m-b-sm">
        <h5 class="no-margin m-b">TOTAL </h5>
        <div class="text-center">
          <div class="inline">
            <div ui-jp="easyPieChart" ui-options="{
                percent: <?php if($cnt != 0){echo round($sum/$cnt);} ?>,
                lineWidth: 12,
                trackColor: '#f1f2f3',
                barColor: '#2196F3',
                scaleColor: '#fff',
                size: 167,
                lineCap: 'butt',
                color: '',
                animate: 3000,
                rotate: 0
              }" ng-init="color = getColor(app.setting.theme.primary, 400)">
              <div class="font-bold text-primary" style="font-size: 20px;">
                <?php if($cnt != 0){echo round($sum/$cnt);} ?>%
              </div>
            </div>
          </div>
        </div>
        <div>
          <div></div>
          </div>
      </div> 
 </div>

</div>

<script src="../libs/jquery/jquery/dist/jquery.js"></script>
<script src="../libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
<script src="../libs/jquery/waves/dist/waves.js"></script>

<script src="scripts/ui-load.js"></script>
<script src="scripts/ui-jp.config.js"></script>
<script src="scripts/ui-jp.js"></script>
<script src="scripts/ui-nav.js"></script>
<script src="scripts/ui-toggle.js"></script>
<script src="scripts/ui-form.js"></script>
<script src="scripts/ui-waves.js"></script>
<script src="scripts/ui-client.js"></script>

</body>
</html>
