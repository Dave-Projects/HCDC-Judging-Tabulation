 <?php  
 //load_data.php  
 include('config.php');
 $output = ''; 
 if(isset($_POST["category"])){
    if($_POST["title"] != ''){  
      if($_POST["category"] != ''){ 

        $user = $_POST["userid"];
        $title = $_POST["title"];

        $query = "SELECT * FROM contestant WHERE TitleID = ".$title.""; 
        $result = mysqli_query($dbcon, $query);  
        while($row = mysqli_fetch_array($result)){  
          $contestant = $row["ContestantID"];

          $qry = "SELECT * FROM criteria WHERE CategoryID =".$_POST["category"]."";
          $res = mysqli_query($dbcon, $qry);

          while($rows = mysqli_fetch_array($res)) {
            $criteria = $rows['CriteriaID'];

            $query1 = "SELECT * FROM contestantcategory WHERE ContestantID = ".$contestant." AND CategoryID =".$_POST["category"]."";
            $result1 = mysqli_query($dbcon, $query1);
            while ($row1 = mysqli_fetch_array($result1)) {
              $contestantcategory = $row1['ContestantCategoryID'];

              $query2 = "SELECT *, SUM(Score) FROM criconcat WHERE ContestantCategoryID = ".$contestantcategory." AND CriteriaID =".$criteria." AND UserID =".$user."";
              $result2 = mysqli_query($dbcon, $query2);
              while ($row2 = mysqli_fetch_array($result2)) {
                $score = $row2['SUM(Score)'];

                   echo "<tr><td>#".$row['ContestantID']." ".$row['ContestantName']."</td><td>".$rows['CriteriaName']."</td><td>".$score."</td></tr>";
              }
            }
          }
        }
      }

    else{
    ?>
    <tr><td colspan="3">
    <div class="alert alert-info animated bounceInDown" role="alert">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      Select Title/Category first. 
    </div>
    </td></tr>
    <?php
    }
 } 
 else{
   ?>
    <tr><td colspan="3">
    <div class="alert alert-info animated bounceInDown" role="alert">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      Select Title/Category first. 
    </div>
    </td></tr>
    <?php
 }
}
?>