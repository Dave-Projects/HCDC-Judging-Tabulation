<?php
	include('config.php');

	if (isset($_POST["deletecontestant"])) {
		$contestant = $_POST['contestantid_del'];

		$query = "DELETE FROM contestant WHERE ContestantID = ".$contestant."";
		mysqli_query($dbcon, $query);

		$qry1 = "SELECT * FROM contestantcategory WHERE ContestantID = ".$contestant."";
		$result = mysqli_query($dbcon, $qry1);

		while ($row=mysqli_fetch_array($result)) {
			$contestantcategory = $row['ContestantCategoryID'];
			
			$qry2 = "SELECT * FROM criconcat  WHERE ContestantCategoryID = ".$contestantcategory."";
			$result1 = mysqli_query($dbcon, $qry2);

			while ($row=mysqli_fetch_array($result1)) {
				$criconcat = $row['CriConCatID'];
				
				$qry3 = "DELETE FROM criconcat WHERE CriConCatID =".$criconcat."";
				mysqli_query($dbcon, $qry3);
			}	
		}	

		$qry = "DELETE FROM contestantcategory WHERE ContestantID = ".$contestant."";
		mysqli_query($dbcon, $qry);
	}

	elseif (isset($_POST["deletecategory"])) {
		$category = $_POST['categoryid_del'];

		$qry1 = "SELECT * FROM contestantcategory WHERE CategoryID = ".$category."";
		$result = mysqli_query($dbcon, $qry1);

		while ($row=mysqli_fetch_array($result)) {
			$contestantcategory = $row['ContestantCategoryID'];
			
			$qry2 = "SELECT * FROM criconcat  WHERE ContestantCategoryID = ".$contestantcategory."";
			$result1 = mysqli_query($dbcon, $qry2);

			while ($row=mysqli_fetch_array($result1)) {
				$criconcat = $row['CriConCatID'];
				
				$qry3 = "DELETE FROM criconcat WHERE CriConCatID =".$criconcat."";
				mysqli_query($dbcon, $qry3);
			}	
		}	

		$query = "DELETE FROM category WHERE CategoryID = ".$category."";
		mysqli_query($dbcon, $query);

		$qry = "DELETE FROM criteria WHERE CategoryID =".$category."";
		mysqli_query($dbcon, $qry);

		$qry1 = "DELETE FROM contestantcategory WHERE CategoryID =".$category."";
		mysqli_query($dbcon, $qry1);
	}

	elseif (isset($_POST["deletecriteria"])) {
		$criteria = $_POST['criteriaid_del'];

		$qry = "SELECT * FROM criconcat WHERE CriteriaID = ".$criteria."";
			$result = mysqli_query($dbcon, $qry);

			while ($row=mysqli_fetch_array($result)) {
				$criconcat = $row['CriConCatID'];
				
				$qry1 = "DELETE FROM criconcat WHERE CriConCatID =".$criconcat."";
				mysqli_query($dbcon, $qry1);
			}	

		$query = "DELETE FROM criteria WHERE CriteriaID = ".$criteria."";
		mysqli_query($dbcon, $query);
	}

	elseif (isset($_POST["deletecriconcat"])) {
		$criconcat = $_POST['criconcat_del'];

		$query = "DELETE FROM criconcat WHERE CriConCatID = ".$criconcat."";
		mysqli_query($dbcon, $query);
	}
?>