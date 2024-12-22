<?php   
 include('server.php'); 
 if (empty($_SESSION['username'])){
  header('location: login.php');
  }

 //load_data_select.php  
 include('config.php');
 // if user is not logged in, they cannot access this page

  function fill_category($dbcon) {  
      $output = '';  
      $sql = "SELECT * FROM category";  
      $result = mysqli_query($dbcon, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<option value="'.$row["CategoryID"].'"  style="font-size: 15px padding:2px;">'.$row["CategoryName"].'</option>';  
      }  
      return $output;  
 } 

  function fill_result($dbcon) {  
      $output = '';  
      $sql = "SELECT * FROM contestant";  
      $result = mysqli_query($dbcon, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<option value="'.$row["ContestantID"].'"  style="font-size: 15px padding:2px;">#'.$row['ContestantID'].' '.$row["ContestantName"].'</option>';  
      }  
      return $output;  
 } 

 function fill_record($dbcon) {  
     ?>
    <tr><td colspan="3">
    <div class="alert alert-info animated bounceInDown" role="alert">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      Select Title/Category first. 
    </div>
    </td></tr>
     <?php
 } 
 
 ?> 

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Overall - Judging/Tabulation System 2023</title>
  <link rel="shortcut icon" href="img/hcdc_logo.png"/>
	<link rel="stylesheet" href="css/bootstrap.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/animate.css" />
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body class="flare-bg">
	<div class="container-fluid">
  <div class="row animated fadeInLeft">
    <div class="col-lg-5 header">
       <div class="row">
          <div class="col-lg-12">
            <center><img src="img/hcdc_logo.png" class="dost-logo"></center>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
             <center><img src="img/HCDC_Background.png" class="searchfor"></center>
          </div>
        </div>
    </div>
    <div class="col-lg-6 judge-contestant">
     <h3 class="page-header">Tabulation Report<span class="animated fadeInDown right-loged">
    <a href="index-admin.php"><input type="button" class="backtohome" title="Back to home"></a> <a href="index.php?logout=1"><input type="button" class="logout" title="Logout"></a></span></h3>
    <div class="row">
      <div class="col-lg-12">
       
      </div>
    </div>
    <div class="row">
    <div class="col-lg-4">
      <div class="form-group">
      <label>Title:</label>
      <?php
        include('config.php');
        $query = "SELECT * FROM title";
        $result = mysqli_query($dbcon, $query);
      ?>
      <select name="title" id="title" class="form-control">
        <option value="" style="color:#bbb;">-- Select Title --</option>    
      <?php
        while ($row = mysqli_fetch_array($result)) {
          echo "<option value=".$row['TitleID'].">".$row['TitleName']."</option>";
        } 
      ?> 
      </select>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="form-group">
      <label>Category:</label>
      <select name="category" id="category" class="form-control">  
        <option value="" style="color:#bbb;">-- Select Category --</option>  
          <?php echo fill_category($dbcon); ?>  
      </select>
      </div>
    </div>
    </div>

    <div class="table-responsive">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>ContestantName</th>
          <th>CriteriaName</th>
          <th>Score</th>
        </tr>
      </thead>
      <tbody id="criteria">
         <?php echo fill_record($dbcon); ?>  
      </tbody>
    </table>
    </div> 
    <div class="modal-footer">
    <a href="overall-admin.php"><input type="submit" class="btn btn-primary" value="View Overall Record"></a>
    </div>
  </div>
  </div>
  </div>
  </div>
</body>
</html>

<script>  
 $(document).ready(function(){  
      $('#category').change(function(){  
           var category = $(this).val();  
           var userid = $('#userid').val(); 
           var title = $('#title').val();
           $.ajax({  
                url:"report-admin_data.php",  
                method:"POST",  
                data:{category:category, userid:userid, title:title},
                success:function(data){  
                     $('#criteria').html(data);  
                }  
           });  
      });
 });  
 </script>  