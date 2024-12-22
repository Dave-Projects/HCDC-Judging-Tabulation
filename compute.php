<?php
	include('config.php');
	$errors = array();

	if (isset($_POST["compute"])) {
		if (empty($_POST['contestant'])) {
			array_push($errors, "Select Contestant first!");
		}
		elseif (empty($_POST['category'])) {
			array_push($errors, "Select Category first!");
		}
		else{
			$user = $_POST['userid'];
			$contestant = $_POST['contestant'];
			$category = $_POST['category'];
			$query = "SELECT * FROM criteria WHERE CategoryID=".$category." ";
			$result = mysqli_query($dbcon, $query);
			while ($row = mysqli_fetch_assoc($result)) {
				$criteria = $row['CriteriaID'];
				$point = $row['CriteriaPoint'];
				

				$qry = "SELECT * FROM contestantcategory WHERE CategoryID = ".$category." AND ContestantID = ".$contestant."";
				$res = mysqli_query($dbcon, $qry);
				while ($rows = mysqli_fetch_assoc($res)) {
					$contestantcategory = $rows['ContestantCategoryID'];
				}
				
				$txt = $_POST['txt'.$criteria];

				//echo "$txt<br> $criteria<br> $contestantcategory<br>";
				$qry1 = "SELECT * FROM criconcat WHERE CriteriaID = ".$criteria." AND ContestantCategoryID=".$contestantcategory." AND UserID= ".$user."";
				$res1 = mysqli_query($dbcon, $qry1);
				$count = mysqli_num_rows($res1);

				if ($count > 0) {
					array_push($errors, "Data already exists!");
				}
				else{

					if ($txt > $point) {
						array_push($errors, "Invalid input! Score must not be greater than criteria point.");
					}
					elseif ($txt < 0) {
						array_push($errors, "Invalid input! Score must not be less than zero.");
					}
					else{
						$qry = "INSERT INTO criconcat(CriteriaID, ContestantCategoryID, Score, UserID) Values('$criteria','$contestantcategory', '$txt', '$user')";
						mysqli_query($dbcon, $qry);
					}
				}
			}
		}
	}
		
	// if (empty($_POST['txt1']) && empty($_POST['txt2'])) {

	// 	$score = array($_POST['txt3'], $_POST['txt4']);
 //    	// $sum = ($delivery + $intelligence) * 0.5;
 //    	$query = "SELECT * FROM criteria JOIN contestantcategory ON criteria.ContestantCategoryID = contestantcategory.ContestantCategoryID WHERE CategoryID = '".$_POST["category"]."'";    
 //    	$result = mysqli_query($dbcon, $query);

 //    	while ($row = mysqli_fetch_array($result)) {
 //    	 	// $concat = $row['ContestantCategoryID'];

 //    	 	$criteria = $row['CriteriaID'];
    	
 //    	 	// echo "<input type='text' class='form-control' value='".$criteria."' name=txt'".$criteria."'>";
 //    	 	$loop = count($criteria);
 //    	 	echo "$criteria";

 //    	 	// for ($i=0; $i <=$loop ; $i++) { 

	//     	 // 	$query2 = "UPDATE criteria SET Score='$score[$i]' WHERE ContestantCategoryID = ".$concat." AND CriteriaID='".$criteria."'";
	//     	 // 	mysqli_query($dbcon, $query2);

	//     	 // 	// echo "Score: $score[$i], $concat, $criteria[$i]<br>";
 //    	 	// }

 //    	}

    	 	

 //    	// $qry = "UPDATE criteria SET Score = '".$intelligence."' WHERE ContestantCategoryID=".$concat." AND CriteriaID = 3";
 //    	// $qry1 = "UPDATE criteria SET Score = '".$delivery."' WHERE ContestantCategoryID=".$concat." AND CriteriaID = 4";
 //    	// mysqli_query($dbcon, $qry);
 //    	// mysqli_query($dbcon, $qry1);

 //    	// echo "ContestantCategory: $concat";
 //    	// echo "$intelligence $delivery $sum";
	// }
	// elseif(empty($_POST['txt3']) && empty($_POST['txt4'])){
	// 	$poise = $_POST['txt1'];
	// 	$audience = $_POST['txt2'];
		
	// 	$sum = ($poise + $audience) * 0.5;

	// 	echo "$poise $audience $sum";
	// }
	// echo "$contestant";
?>