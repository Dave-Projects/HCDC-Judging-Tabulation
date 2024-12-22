<?php
	include('config.php');

	if (isset($_POST['addcontestant'])) {
		$name = $_POST['txtContestantName'];
		$title = $_POST['cboxTitle'];

		$query = "INSERT INTO contestant(ContestantName, TitleID) VALUES('$name', $title)";
		mysqli_query($dbcon, $query);

		$qry = "SELECT * FROM contestant WHERE ContestantName = '".$name."' AND TitleID = '".$title."'";
		$result = mysqli_query($dbcon, $qry);
		while ($row = mysqli_fetch_array($result)) {
			$contestant = $row['ContestantID'];
		}

		$qry1 = "SELECT * FROM category";
		$result1 = mysqli_query($dbcon, $qry1);
		while ($row1 = mysqli_fetch_array($result1)) {
			$category = $row1['CategoryID'];

			$qry2 = "INSERT INTO contestantcategory(ContestantID, CategoryID) VALUES('$contestant','$category')";
			mysqli_query($dbcon, $qry2);
		}
	} 
	elseif (isset($_POST['addcategory'])) {
		$name = $_POST['txtCategoryName'];
		$percentage = $_POST['txtCategoryPercentage'] / 100;

		$query = "INSERT INTO category(CategoryName, CategoryPercentage) VALUES('$name', '$percentage')";
		mysqli_query($dbcon, $query);

		$qry = "SELECT * FROM category WHERE CategoryName ='".$name."' AND CategoryPercentage ='".$percentage."'";
		$res = mysqli_query($dbcon, $qry);
		while ($row = mysqli_fetch_array($res)) {
			$category = $row['CategoryID'];
		
			$qry1 = "SELECT * FROM contestant";
			$res1 = mysqli_query($dbcon, $qry1);
			while ($row1 = mysqli_fetch_array($res1)) {
				$contestant = $row1['ContestantID'];

				$qry2 = "INSERT INTO contestantcategory(ContestantID, CategoryID) VALUES('$contestant', '$category')";
				mysqli_query($dbcon, $qry2);
			}
		}
	}
	elseif (isset($_POST['addcriteria'])) {
		$name = $_POST['txtCriteriaName'];
		$point = $_POST['txtCriteriaPoint'];
		$category = $_POST['cboxCategory'];

		$query = "INSERT INTO criteria(CriteriaName, CriteriaPoint, CategoryID) VALUES('$name', '$point', '$category')";
		mysqli_query($dbcon, $query);
	}
?>