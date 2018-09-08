<html>
    <head>
        <script src="https://code.jquery.com/jquery-2.1.1.js"></script>
      <link rel="stylesheet" href="bootstrap.min.css">
<script src="bootstrap/js/bootstrap.js"></script>  
<link rel="stylesheet" type="text/css" href="rangeslider/rangeslider.css">
<script type="text/javascript" src="rangeslider/rangeslider.js"></script>  

        <style>
        body{
            padding: 30px;
        }
        </style>
    </head>
<body>

<?php require_once 'connection.php'; $ac =$conn->query("SELECT * FROM nameclass");?>
<form action="fpdf/tuto5.php" method="post">
<select name="cname" class="form-control" style="width:200px;">
  <?php while($row=mysqli_fetch_assoc($ac)){
    echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
    }?>
</select>
<br>
<label>Limit Value</label>
<input type="text" style="width:200px;" value="75" name="limit" class="form-control" required>
   <br>
<input type="submit" class="btn btn-success">

 
    </body>
</html>