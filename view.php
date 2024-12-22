<?php   
 include('server.php'); 
 if (empty($_SESSION['username'])){
  header('location: login.php');
  }

  $user = $_SESSION['user'];

 //load_data_select.php  
 include('config.php');
 include('edit.php');
 // if user is not logged in, they cannot access this page

 function fill_category($dbcon)  
 {  
      $output = '';  
      $sql = "SELECT * FROM category";  
      $result = mysqli_query($dbcon, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<option value="'.$row["CategoryID"].'"  style="font-size: 15px padding:2px;">'.$row["CategoryName"].'</option>';  
      }  
      return $output;  
 } 

  function fill_contestant($dbcon)  
 {  
      $output = '';  
      $sql = "SELECT * FROM contestant";  
      $result = mysqli_query($dbcon, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<option value="'.$row["ContestantID"].'"  style="font-size: 15px padding:2px;">#'.$row['ContestantID'].' '.$row["ContestantName"].'</option>';  
      }  
      return $output;  
 } 
 
 function fill_criteria($dbcon)  
 {  
      $output = '';  
      $sql = "SELECT * FROM criteria GROUP BY CriteriaName";  
      $result = mysqli_query($dbcon, $sql);  

      while($row = mysqli_fetch_array($result)){ 
           
           $output .= '<tr>';  
           $output .= '<td>'.$row["CriteriaName"].'';
           $output .= '</td>'; 
           $output .= '<td>'.$row['CriteriaPoint'].' pts';
           $output .= '</td>';   
           $output .= '<td>';
           $output .= '</td>';  
           $output .= '</tr>';  
      }  
      return $output;  
 } 
 
 ?> 

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/hcdc_logo.png"/>
	<title>Edit for Judging & Tabulation System 2023</title>

	<link rel="stylesheet" href="css/bootstrap.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/animate.css" />
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body class="flare-bg">
	<div class="container-fluid">
    
  <form action="view.php" method="post" id="frmCompute">
    
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
     <h3 class="page-header">Edit Record <span class="animated fadeInDown right-loged">
    <a href="index.php"><input type="button" class="backtohome" title="Back to home"></a> <a href="report.php"><input type="button" class="report" title="Report"></a> <a href="index.php?logout=1"><input type="button" class="logout" title="Logout"></a></span></h3>
    <div class="row">
      <div class="col-lg-12">
        <!--display validation errors-->
        <?php include('errors.php'); ?>
      </div>
    </div>
    <div class="row">
    <div class="col-lg-5">
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
    
    <div class="col-lg-7">
      <div class="form-group">
      <label>Contestant:</label>
      <select name="contestant" id="contestant" class="form-control">  
        <option value="" style="color:#bbb;">-- Select Contestant --</option>  
          <?php echo fill_contestant($dbcon); ?>  
      </select>
      </div>
    </div>
    </div>
    <div class="row">
    <div class="col-lg-12">
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
          <th>Criteria</th>
          <th>Point</th>
          <th style="width: 100px;">Score</th>
        </tr>
      </thead>
      <tbody id="criteria">
          <?php echo fill_criteria($dbcon);?>  
      </tbody>
    </table>
    </div> 
    <div class="modal-footer">
    <input type="submit" class="btn btn-primary" id="edit" name="edit" value="Edit Record">
    <?php echo "<input type=text id=userid name=userid value=".$user." style='display:none'>"; ?>
    </div>
  </div>
  </div>
  </div>
  </form>

  </div>
</body>
</html>

<script>  
 $(document).ready(function(){  
      $('#category').change(function(){  
           var category = $(this).val();  
           var con = $('#contestant').val();
           var userid = $('#userid').val(); 
           $.ajax({  
                url:"view_data.php",  
                method:"POST",  
                data:{category:category, con:con, userid:userid},
                success:function(data){  
                     $('#criteria').html(data);  
                }  
           });  
      });

      $('#title').change(function(){  
           var title = $(this).val();  
           $.ajax({  
                url:"view_data.php",  
                method:"POST",  
                data:{title:title},  
                success:function(data){  
                     $('#contestant').html(data);  
                }  
           });  
      });   
 });  
 </script>  
<!--  <script type="text/javascript">
  $(document).ready(function() {
    $("#title").change(function() {
    var id=$(this).val();
    var dataString = 'id='+ id;

      $.ajax ({
        type: "POST",
        url: "load_data.php",
        data: dataString,
        cache: false,
        success: function(html) {
          $("#contestant").html(html);
          } 
      });
    });
  });
  </script>   -->