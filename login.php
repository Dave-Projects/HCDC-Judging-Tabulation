<?php include('server.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - Hcdc Tabulation System 2023</title>
	<link rel="stylesheet" href="css/bootstrap.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet"> 
    <link rel="stylesheet" type="text/css" href="assets/animate.css" />
    <link rel="shortcut icon" href="img/Hcdc_logo.png"/>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body class="flare-bg-login">
	<div class="container-fluid">
		<div class="row animated fadeInLeft">
		<div class="col-lg-6 header">
		<div class="row">
          <div class="col-lg-12">
            <center><img src="img/Hcdc_logo.png" class="dost-logo"></center>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
             <center><img src="img/HCDC_Background.png" class="searchfor"></center>
          </div>
        </div>
		</div>
		<div class="col-lg-5 judge-contestant-login login-form">	
			<h2 class="page-header">
		        Login
		    </h2>
			<!--display validation errors-->
			<?php include('errors.php'); ?>
			<form action="login.php" method="POST">
			<div class="form-group">
				<label>Username:</label>
				<input type="text" class="form-control" name="username" placeholder="Enter Username" required>
			</div>
			<div class="form-group">
				<label>Password:</label>
				<input type="password" class="form-control" name="password" placeholder="Enter Password" required>
			</div>
			<h5>Not a member yet? <a href="register.php">Sign up<b class="caret"></b></a></h5>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" name="login">&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;</button>
			</div>	
			</form>	  			
		</div>
		</div>
	</div>
</body>
</html>