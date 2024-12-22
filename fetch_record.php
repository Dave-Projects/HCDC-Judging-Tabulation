<?php
	include('config.php');

	if(isset($_POST["contestantid"])){  
	    $query = "SELECT * FROM contestant WHERE ContestantID = '".$_POST["contestantid"]."'";  
	    $result = mysqli_query($dbcon, $query);  
	    $row = mysqli_fetch_array($result);  
	    echo json_encode($row);  
	 }  
	 elseif(isset($_POST["categoryid"])){  
	    $query = "SELECT * FROM category WHERE CategoryID = '".$_POST["categoryid"]."'";  
	    $result = mysqli_query($dbcon, $query);  
	    $row = mysqli_fetch_array($result);  
	    echo json_encode($row);  
	 }  
	 elseif(isset($_POST["criteriaid"])){  
	    $query = "SELECT * FROM criteria WHERE CriteriaID = '".$_POST["criteriaid"]."'";  
	    $result = mysqli_query($dbcon, $query);  
	    $row = mysqli_fetch_array($result);  
	    echo json_encode($row);  
	 }  
	 elseif(isset($_POST["criconcatid"])){  
	    $query = "SELECT * FROM criconcat WHERE CriConCatID = '".$_POST["criconcatid"]."'";  
	    $result = mysqli_query($dbcon, $query);  
	    $row = mysqli_fetch_array($result);  
	    echo json_encode($row);  
	 }  
?>