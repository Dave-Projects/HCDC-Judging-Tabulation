<?php include('server.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="img/hcdc_logo.png"/>
	<title>Register - Judging & Tabulation System 2023</title>
	<link rel="stylesheet" href="css/bootstrap.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/animate.css" />
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>

</head>
<body class="flare-bg-login">
	<div class="container-fluid">
		<div class="row animated fadeInLeft">
		<div class="col-lg-6 header">
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
		<div class="col-lg-5 judge-contestant reg-form">	
			<h2 class="page-header laboratory-inventory-log">
		        Register
		    </h2>
		<form action="register.php" method="POST">
		<!--display validation errors-->
		<?php include('errors.php'); ?>

			<div class="form-group">
				<label class="label-log">Username:</label>
				<input type="text" class="form-control" name="username"  placeholder="Username" required>
			</div>
			<div class="form-group">
				<label class="label-log">Password:</label>
				<input type="password" class="form-control " name="password_1" placeholder="Password" required>
			</div>
			<div class="form-group">
				<label class="label-log">Confirm Password:</label>
				<input type="password" class="form-control" name="password_2" placeholder="Confirm Password" required>
			</div>
				<h5>Already a member? <a href="login.php">Log in<b class="caret"></b>
				</a></h5>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" name="register">&nbsp;&nbsp;&nbsp;Register&nbsp;&nbsp;&nbsp;</button>
			</div>
		</form>		  			
		</div>
		</div>
	</div>
</body>
</html>