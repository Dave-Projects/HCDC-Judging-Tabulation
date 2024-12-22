<?php  
  include('config.php');

  $output = '';

  if (isset($_POST["title"])) {
    if ($_POST["title"] == '') {
    ?>
      <tr><td colspan="3">
        <div class="alert alert-info animated bounceInDown" role="alert">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          Select Title first. 
        </div>
      </td></tr>
    <?php
    }
    elseif ($_POST["title"] != '') {
      $user = $_POST["userid"];

      $query = "DELETE FROM tabulate";
      mysqli_query($dbcon, $query);

      $query1 = "SELECT * FROM category";
      $result1 = mysqli_query($dbcon, $query1);
      while ($row1 = mysqli_fetch_array($result1)) {
        $category = $row1['CategoryID'];
        $percentage = $row1['CategoryPercentage'];

        $query2 = "SELECT * FROM contestant WHERE TitleID = ".$_POST["title"]."";
        $result2 = mysqli_query($dbcon, $query2);
        while ($row2 = mysqli_fetch_array($result2)) {
          $contestant = $row2["ContestantID"];

          $query3 = "SELECT *, SUM(Score) FROM criconcat JOIN contestantcategory ON contestantcategory.ContestantCategoryID = criconcat.ContestantCategoryID WHERE ContestantID = ".$contestant." AND CategoryID = ".$category." AND UserID = ".$user."";
          $result3 = mysqli_query($dbcon, $query3);
          while ($row3 = mysqli_fetch_array($result3)) {
            $score = $row3['SUM(Score)'] * $percentage;
          }

          $query4 = "INSERT INTO tabulate(ContestantID, Score) VALUES('$contestant', '$score')";
          mysqli_query($dbcon, $query4);
        }
      }

      $query5 = "SELECT *, SUM(Score) FROM tabulate JOIN contestant ON contestant.ContestantID=tabulate.ContestantID GROUP BY ContestantName ORDER BY Score DESC";
      $result5 = mysqli_query($dbcon, $query5);
      $rank = 0;
      $last_score = false;
      $count = 0;

      while ($row5 = mysqli_fetch_array($result5)) {
        $count++;

        if ($last_score != $row5['SUM(Score)']) {
          $last_score = $row5['SUM(Score)'];
          $rank = $count;
        }

        echo "<tr><td>#".$row5['ContestantID']." ".$row5['ContestantName']."</td>
        <td>".$row5['SUM(Score)']."</td>
        <td>".$rank."</td></tr>";

      }
    }
  }
?>
