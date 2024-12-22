<?php
	include('config.php');
		
	if (isset($_POST["category"])) {
		if ($_POST["category"] != '') {
			$query = "SELECT * FROM criteria WHERE CategoryID = ".$_POST["category"]."";
			$result = mysqli_query($dbcon, $query);
			echo "<tr><th>ContestantName</th>";
			while ($row = mysqli_fetch_array($result)) {
				echo "<th>".$row['CriteriaName']."</th>";
			}
			echo "</tr>";
		}
	}

?>