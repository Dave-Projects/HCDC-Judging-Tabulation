 <?php  
 //load_data.php  
 include('config.php');
 $output = ''; 
 if(isset($_POST["category"])){
      if ($_POST["con"] == '') {
         
      }  
      elseif($_POST["category"] != ''){  
        $user = $_POST["userid"];
        $contestant = $_POST["con"];
        $category = $_POST["category"];

        $query = "SELECT * FROM contestantcategory WHERE CategoryID = ".$category." AND ContestantID =".$contestant."";
        $res = mysqli_query($dbcon, $query);
        while ($rows = mysqli_fetch_array($res)) {
          $contestantcategory = $rows['ContestantCategoryID'];
        }

        $sql = "SELECT * FROM criteria JOIN criconcat ON criconcat.CriteriaID=criteria.CriteriaID  WHERE ContestantCategoryID =".$contestantcategory." AND UserID = ".$user.""; 
        $result = mysqli_query($dbcon, $sql);  
        while($row = mysqli_fetch_array($result)){  
             $criteria = $row['CriteriaID'];
             $point = $row['CriteriaPoint']; 

             $output .= '<tr><td>'.$row["CriteriaName"].'</td><td>'.$point.' pts</td>
             <td><input type=number class=form-control col-xs-3 name=txt'.$row['CriteriaID'].' value='.$row['Score'].' required></td></tr>';
        }  
        echo $output;

    }
    else{
        $sql1 = "SELECT * FROM criteria GROUP BY CriteriaName";    
              
        $result1 = mysqli_query($dbcon, $sql1);  
        while($row1 = mysqli_fetch_array($result1)){
             $point = $row1['CriteriaPoint'];   

             $output .= '<tr><td>'.$row1["CriteriaName"].'</td><td>'.$point.' pts</td><td></td></tr>';  
        }  
        echo $output; 
    }
 } 

 elseif(isset($_POST["title"])) {
  $title=$_POST["title"];

  $sql="SELECT * FROM contestant WHERE TitleID='".$title."'";
  $res = mysqli_query($dbcon, $sql);
    while($row=mysqli_fetch_array($res)) {
      $id=$row['ContestantID'];
      $name=$row['ContestantName'];
      echo "<option value='".$id."'>#".$id.' '.$name."</option>";
    }
 }

?>