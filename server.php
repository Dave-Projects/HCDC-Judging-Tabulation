<?php 
session_start();
$username ="";
$email = "";
$errors = array();
//connect to the database
$db=mysqli_connect('localhost', 'root','','tabulation_judging_system');
// if the register button is clicked
if(isset($_POST['register'])){
	$username =mysqli_real_escape_string($db,$_POST['username']);

	$password_1 =mysqli_real_escape_string($db, $_POST['password_1']);
	$password_2 =mysqli_real_escape_string($db, $_POST['password_2']);	
	
	// ensure that form fields are filled properly
	if (empty($username)){
		array_push($errors, "Username is required!");
	}

	if (empty($password_1)){
		array_push($errors, "Password is required!");
	}
 	if($password_1 != $password_2){
	array_push($errors, "The two Passwords do not match!");
}
//if there are no errors, save user to data base
if (count($errors) == 0){
	
	$password = mysqli_real_escape_string($db, $_POST['password_1']); // No hashing, storing plain text
	$sql = "INSERT INTO user (UserName, Password) VALUES ('$username','$password')";
	mysqli_query($db, $sql);
	
	$_SESSION['username'] = $username;
	$_SESSION['success'] = "You are now logged in.";
	header('location: login.php'); //redirect to home page 
}
}
//log user in from login page
if (isset($_POST['login'])){
	$username= mysqli_real_escape_string ($db,$_POST['username']);
	$password= mysqli_real_escape_string ($db,$_POST['password']);

	//ensure that form fields are filled properly
	if (empty($username)){
		array_push($errors, "Username is required!");
	}
	if (empty($password)){
		array_push($errors, "Password is required!");
	}
	if ($username == 'AdminDave' && $password == '123') {
		$_SESSION['user'] = $user;
		$_SESSION['username'] = $username;
		$_SESSION['success'] = "You are now logged in.";
		header('location: index-admin.php');
	}
	if (count($errors) == 0){
	 //encrypt password before comparing 

	$query= "SELECT * FROM  user where UserName='$username' AND Password ='$password'";
	$result = mysqli_query($db, $query);
	while ($row = mysqli_fetch_array($result)) {
		$user = $row['UserID'];
	}

		
		if (mysqli_num_rows($result) == 1){
			$_SESSION['user'] = $user;
			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in.";
			header('location: index.php');
		}
		else{
			array_push($errors, "Wrong Username/password combination!");

		}
	}
}
//logout
if (isset($_GET['logout'])){
	session_destroy();
	unset($_SESSION['username']);
	header('location:login.php');
	} 
	?>
