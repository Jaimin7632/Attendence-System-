<?php

$class = $_POST['cname'];
$limit = $_POST['limit'];
require('fpdf.php');
require_once 'connection.php'; 
class PDF extends FPDF
{
 
	function addt($qt,$w){
		$this->SetFillColor(255,0,0);

	$this->SetDrawColor(128,0,0);
       $this->Cell($w,5,$qt,1,0,'C',true);
	}
	function linebreak(){
			$this->Ln();
	}

}

$pdf = new FPDF();
$pdf->SetFont('Arial','',6);
$pdf->SetFont('','B');
$pdf->SetFillColor(255);
$pdf->AddPage();


$todaydate= 'Date : '.date("d / m / Y");
$pdf->Cell(40,5,$todaydate,0);
$pdf->Ln();
$pdf->Ln();

	$pdf->Cell(20,5,' ',1,0,'L');
$ac=$conn->query("SELECT * from subnames where class='$class'");
$ar = array();
$l=0;
        while ($qv = mysqli_fetch_assoc($ac)) { 
           $ar[$l][0]=$qv['name'];
           $ar[$l][1]=$qv['lec'];
           $ar[$l][2]=$qv['lab'];
            $l++;
            $qt=$qv['name'];
        	$pdf->Cell(27,5,$qt,1,0,'L');
        }
      $pdf->Cell(15,5,'Total(%)',1,0,'R');
        $pdf->Ln();
$pdf->Cell(20,5,'#',1,0,'L');
 for($g=0;$g<$l;$g++)//second line 
        {
        	 $pdf->Cell(10,5,'lec',1,0,'L');
             $pdf->Cell(10,5,'lab',1,0,'L');
            $pdf->Cell(7,5,'%',1,0,'L');
        	
        }
$pdf->Cell(15,5,' ',1,0,'R');
   $pdf->Ln();
$sql="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA` = 'attendence1' AND `TABLE_NAME` = 'a$class' ";
$names =$conn->query($sql);
$post = array();
while($row = mysqli_fetch_assoc($names))  {
  $post[]=$row['COLUMN_NAME'];
}
array_splice($post, 0,1);


$pdf->SetFont('');
foreach ($post as $key => $value) {
		
	$data = array();
   $data[0][0] = substr($value,1);
     $gplec =0;
     $gtlec =0;
	for($g=0;$g<$l;$g++)
        {  
        	if($ar[$g][1] == 1)//lec
        	{ $df =$ar[$g][0];
              $ct=$conn->query("Select Count($value) as a From $df WHERE $value=0 OR $value=1");
        	  $ctt=mysqli_fetch_assoc($ct);
        	  $ht=$conn->query("Select Count($value) as a From $df WHERE $value=1");
        	  $htt=mysqli_fetch_assoc($ht);  
        	  $at = $htt['a']." / ".$ctt['a'];
        	      $data[$g+1][0]= $at;
        	   $plec = $htt['a'];
        	   $tlec = $ctt['a'];
        	   $gplec += $plec;
        	    $gtlec += $tlec;
               
        	}else{  $data[$g+1][0]='-'; $plec = 0; $tlec = 0;}
        	if($ar[$g][2] == 1)//lab
        	{
        	   $df =$ar[$g][0]."lab";
               $ch=$conn->query("Select Count($value) as a From $df WHERE $value=0 OR $value=1");
        	   $chh=mysqli_fetch_assoc($ch);
        	   $hh=$conn->query("Select Count($value) as a From $df WHERE $value=1");
        	   $hhh=mysqli_fetch_assoc($hh);  
        	   $at = $hhh['a']." / ".$chh['a'];
        	   $data[$g+1][1]=$at;
        	   $plec = $hhh['a'];
        	   $tlec = $chh['a'];
        	     $gplec += $plec;
        	    $gtlec += $tlec;
        		
        	}else{   $data[$g+1][1] ='-'; $pplec = 0; $ttlec = 0;}
        	//  %
        	if($tlec !=0 || $ttlec !=0){
        	 $satte =(($plec+$pplec)*100)/($tlec+$ttlec);}
        	 else{ $satte=0;}

        	  $data[$g+1][2]=round($satte);
        }
if($gtlec !=0){
 $atte =($gplec*100)/($gtlec);
}else{$atte=0;}
 $data[$l+1][0]=round($atte);

if($data[$l+1][0] < $limit){ //check it less than limit
   $pdf->Cell(20,5,$data[0][0],1,0,'L',true);
   for($qq=1; $qq<=$l;$qq++){
           $pdf->Cell(10,5,$data[$qq][0],1,0,'L',true);
           $pdf->Cell(10,5,$data[$qq][1],1,0,'L',true);
           $pdf->Cell(7,5,$data[$qq][2],1,0,'L',true);
           
   	       
   } 
$pdf->SetFillColor(240,240,245);
      $pdf->Cell(15,5,$data[$l+1][0],1,0,'R',true);
      $pdf->SetFillColor(255);
     $pdf->Ln();
}


}


$pdf->AddPage();

$pdf->output();
?>
