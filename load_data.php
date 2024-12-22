 <?php  
 //load_data.php  
 include('config.php');
 $output = ''; 
 if(isset($_POST["category"])){  
      if($_POST["category"] != ''){  
        $sql = "SELECT * FROM criteria WHERE CategoryID = '".$_POST["category"]."'"; 
        $result = mysqli_query($dbcon, $sql);  
        while($row = mysqli_fetch_array($result)){  
             $output .= '<tr><td>'.$row["CriteriaName"].'</td><td>'.$row['CriteriaPoint'].' pts</td>
             <td><input type=number class=form-control name=txt'.$row['CriteriaID'].' required></td></tr>';
        }  
        echo $output;

    }
    else{
        $sql1 = "SELECT * FROM criteria GROUP BY CriteriaName";    
              
        $result1 = mysqli_query($dbcon, $sql1);  
        while($row1 = mysqli_fetch_array($result1)){

             $output .= '<tr><td>'.$row1["CriteriaName"].'</td><td>'.$row1['CriteriaPoint'].' pts</td><td></td></tr>';  
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