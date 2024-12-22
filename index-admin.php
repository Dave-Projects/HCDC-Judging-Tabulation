<?php 
	include('server.php');
	if (empty($_SESSION['username'])){
	  header('location: login.php');
	  }
  
  $user = $_SESSION['user'];

	include('insert.php');
	include('edit.php');
	include('delete.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin - Hcdc Tabulation System 2023</title>

	<link rel="stylesheet" href="css/bootstrap.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">  
    <link rel="stylesheet" type="text/css" href="assets/animate.css" />
    <link rel="shortcut icon" href="img/Hcdc_logo.png"/>
   	<script src="js/responsive-tabs.js"></script>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="css/bootstrap-responsive-tabs.css">
</head>
<body class="flare-bg">
	<div class="container-fluid">
		<div class="row animated fadeInLeft">
			<div class="col-lg-5 header">
				<div class="row">
		          <div class="col-lg-12">
		            <center><img src="img/Hcdc_logo.png" class="dost-logo"></center>
		          </div>
		        </div>
		        <div class="row">
		          <div class="col-lg-12">
		             <center><img src="img/HCDC_Background.png" class="searchfor"></center>
		          </div>
		        </div>
			</div>
			<div class="col-lg-6 judge-contestant">
			<h3 class="page-header">Records <span class="animated fadeInDown right-loged"><a href="report-admin.php"><input type="button" class="report" title="Report"></a> <a href="index.php?logout=1"><input type="button" class="logout" title="Logout"></a></span></h3>
				<ul class="nav nav-tabs responsive" id="myTab">
			  		<li class="green"><a href="#one" data-toggle="tab">Contestant</a></li>
					<li><a href="#two" data-toggle="tab">Category</a></li>
					<li class="blue"><a href="#three" data-toggle="tab">Criteria</a></li>
					<li class="lightblue"><a href="#four" data-toggle="tab">ContestantCategory</a></li>
					<li class="lightblue"><a href="#five" data-toggle="tab">CriConCat</a></li>
				</ul>
				<div class="tab-content responsive">
					<div class="tab-pane fade in active table-responsive" id="one">
						<h3>Contestant <button class="btn btn-default right"  data-toggle="modal" data-target="#AddContestant"><i class="fa fa-plus"></i> Add </button></h3>
						<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>ContestantName</th>
								<th>Title</th>
								<th colspan="2">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								include('config.php');
								$query = "SELECT * FROM contestant JOIN title ON Title.TitleID = contestant.TitleID ORDER BY TitleName, ContestantID ASC";
								$result = mysqli_query($dbcon, $query);
								while ($row = mysqli_fetch_array($result)) {
									echo "<tr>";
									echo "<td>".$row['ContestantID']."</td>";
									echo "<td>".$row['ContestantName']."</td>";
									echo "<td>".$row['TitleName']."</td>";
									echo "<td style='width:23px;'><input type='button' name='edit' id=".$row["ContestantID"]." class='edit_contestant edit-img'></td>";
									echo "<td style='width:23px;'><input type='button' name='edit' id=".$row["ContestantID"]." class='delete_contestant delete-img'></td>";
									echo "</tr>";
								}
							?>
						</tbody>
						</table>
						<div class="modal-footer">
							<?php 
								$count = mysqli_num_rows($result);
								echo "$count records found.";
							?>
						</div>
					</div>
					<div class="tab-pane fade table-responsive" id="two">
						<h3>Category <button class="btn btn-default right" data-toggle="modal" data-target="#AddCategory"><i class="fa fa-plus"></i> Add </button></h3>
						<table class="table table-hover table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>CategoryName</th>
									<th>CategoryPercentage</th>
									<th colspan="2">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									include('config.php');
									$query = "SELECT * FROM category ORDER BY CategoryID ASC";
									$result = mysqli_query($dbcon, $query);
									while ($row = mysqli_fetch_array($result)) {
										$percentage = $row['CategoryPercentage'] * 100;
										echo "<tr>";
										echo "<td>".$row['CategoryID']."</td>";
										echo "<td>".$row['CategoryName']."</td>";
										echo "<td>".$percentage."%</td>";
										echo "<td style='width:23px;'><input type='button' name='edit' id=".$row["CategoryID"]." class='edit_category edit-img'></td>";
										echo "<td style='width:23px;'><input type='button' name='edit' id=".$row["CategoryID"]." class='delete_category delete-img'></td>";
										echo "</tr>";
									}
								?>
							</tbody>
						</table>
						<div class="modal-footer">
							<?php 
								$count = mysqli_num_rows($result);
								echo "$count records found.";
							?>
						</div>
					</div>
					<div class="tab-pane fade table-responsive" id="three">
						<h3>Criteria <button class="btn btn-default right" data-toggle="modal" data-target="#AddCriteria"><i class="fa fa-plus"></i> Add </button></h3>

						<table class="table table-hover table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>CriteriaName</th>
									<th>CriteriaPoint</th>
									<th>CategoryName</th>
									<th colspan="2">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									include('config.php');
									$query = "SELECT * FROM criteria JOIN category ON category.CategoryID = criteria.CategoryID ORDER BY CategoryName, CriteriaName ASC";
									$result = mysqli_query($dbcon, $query);
									while ($row = mysqli_fetch_array($result)) {
										echo "<tr>";
										echo "<td>".$row['CriteriaID']."</td>";
										echo "<td>".$row['CriteriaName']."</td>";
										echo "<td>".$row['CriteriaPoint']." pts</td>";
										echo "<td>".$row['CategoryName']."</td>";
										echo "<td style='width:23px;'><input type='button' name='edit' id=".$row["CriteriaID"]." class='edit_criteria edit-img'></td>";
										echo "<td style='width:23px;'><input type='button' name='edit' id=".$row["CriteriaID"]." class='delete_criteria delete-img'></td>";
										echo "</tr>";
									}
								?>
							</tbody>
						</table>
						<div class="modal-footer">
							<?php 
								$count = mysqli_num_rows($result);
								echo "$count records found.";
							?>
						</div>
					</div>
					<div class="tab-pane fade table-responsive" id="four">
						<h3>ContestantCategory</h3>
						<table class="table table-hover table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>ContestantName</th>
									<th>CategoryName</th>
								</tr>
							</thead>
							<tbody>
								<?php
									include('config.php');
									$query = "SELECT * FROM contestantcategory JOIN contestant ON contestant.ContestantID = contestantcategory.ContestantID JOIN category ON category.CategoryID = contestantcategory.CategoryID ORDER BY TitleID, ContestantName, CategoryName ASC ";
									$result = mysqli_query($dbcon, $query);
									while ($row = mysqli_fetch_array($result)) {
										echo "<tr>";
										echo "<td>".$row['ContestantCategoryID']."</td>";
										echo "<td>".$row['ContestantName']."</td>";
										echo "<td>".$row['CategoryName']."</td>";
										echo "<td style=display:none;>".$row['TitleID']."</td>";
										echo "</tr>";
									}
								?>
							</tbody>
						</table>
						<div class="modal-footer">
							<?php 
								$count = mysqli_num_rows($result);
								echo "$count records found.";
							?>
						</div>
					</div>
					<div class="tab-pane fade table-responsive" id="five">
						<h3>CriteriaContestantCategory</h3>
						<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>CriteriaName</th>
								<th>ContestantName,CategoryName</th>
								<th>Score</th>
								<th>User(Judge)</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								include('config.php');
								$query = "SELECT * FROM criconcat JOIN criteria ON criteria.CriteriaID = criconcat.CriteriaID JOIN contestantcategory ON contestantcategory.ContestantCategoryID = criconcat.ContestantCategoryID JOIN contestant ON contestant.ContestantID = contestantcategory.ContestantID JOIN category ON contestantcategory.CategoryID = category.CategoryID JOIN user ON user.UserID=criconcat.UserID ORDER BY UserName, ContestantName ASC ";
								$result = mysqli_query($dbcon, $query);
								while ($row = mysqli_fetch_array($result)) {
									echo "<tr>";
									echo "<td>".$row['CriConCatID']."</td>";
									echo "<td>".$row['CriteriaName']."</td>";
									echo "<td>".$row['ContestantCategoryID']." ".$row['ContestantName'].",".$row['CategoryName']."</td>";
									echo "<td>".$row['Score']."</td>";
									echo "<td>".$row['UserID']." ".$row['UserName']."</td>";
									echo "<td style='width:23px;'><input type='button' name='delete' id=".$row["CriConCatID"]." class='delete_criconcat delete-img'></td>";
									echo "</tr>";
								}
							?>
						</tbody>
					</table>
					<div class="modal-footer">
						<?php 
							$count = mysqli_num_rows($result);
							echo "$count records found.";
						?>
					</div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				(function($) {
				fakewaffle.responsiveTabs(['xs', 'sm']);
				})(jQuery);
			</script>
		</div>
	</div>
	<script src="js/jquery.bootstrap-responsive-tabs.min.js"></script>
</body>
</html>

<!-- Script for Edit Contestant -->
<script>  
$(document).ready(function(){  
    $(document).on('click', '.edit_contestant', function(){  
        var contestantid = $(this).attr("id");  
        $.ajax({  
            url:"fetch_record.php",  
            method:"POST",  
            data:{contestantid:contestantid},  
            dataType:"json",  
            success:function(data){  
                $('#contestantname').val(data.ContestantName); 
                $('#title').val(data.TitleID);
                $('#contestantid').val(data.ContestantID);
                $('#EditContestant').modal('show');  
            }  
        });  
    });  
    $(document).on('click', '.delete_contestant', function(){  
        var contestantid = $(this).attr("id");  
        $.ajax({  
            url:"fetch_record.php",  
            method:"POST",  
            data:{contestantid:contestantid},  
            dataType:"json",  
            success:function(data){  
                $('#contestantid_del').val(data.ContestantID);
                $('#DeleteContestant').modal('show');  
            }  
        });  
    });  
    $(document).on('click', '.edit_category', function(){  
        var categoryid = $(this).attr("id");  
        $.ajax({  
            url:"fetch_record.php",  
            method:"POST",  
            data:{categoryid:categoryid},  
            dataType:"json",  
            success:function(data){  
                $('#categoryname').val(data.CategoryName); 
                $('#percentage').val(data.CategoryPercentage * 100);
                $('#categoryid').val(data.CategoryID);
                $('#EditCategory').modal('show');  
            }  
        });  
    });  
    $(document).on('click', '.delete_category', function(){  
        var categoryid = $(this).attr("id");  
        $.ajax({  
            url:"fetch_record.php",  
            method:"POST",  
            data:{categoryid:categoryid},  
            dataType:"json",  
            success:function(data){  
                $('#categoryid_del').val(data.CategoryID);
                $('#DeleteCategory').modal('show');  
            }  
        });  
    });  
    $(document).on('click', '.edit_criteria', function(){  
        var criteriaid = $(this).attr("id");  
        $.ajax({  
            url:"fetch_record.php",  
            method:"POST",  
            data:{criteriaid:criteriaid},  
            dataType:"json",  
            success:function(data){  
                $('#criterianame').val(data.CriteriaName); 
                $('#point').val(data.CriteriaPoint);
                $('#categoryid').val(data.CategoryID);
                $('#criteriaid').val(data.CriteriaID);
                $('#EditCriteria').modal('show');  
            }  
        });  
    });  
    $(document).on('click', '.delete_criteria', function(){  
        var criteriaid = $(this).attr("id");  
        $.ajax({  
            url:"fetch_record.php",  
            method:"POST",  
            data:{criteriaid:criteriaid},  
            dataType:"json",  
            success:function(data){  
                $('#criteriaid_del').val(data.CriteriaID);
                $('#DeleteCriteria').modal('show');  
            }  
        });  
    });  
     $(document).on('click', '.delete_criconcat', function(){  
        var criconcatid = $(this).attr("id");  
        $.ajax({  
            url:"fetch_record.php",  
            method:"POST",  
            data:{criconcatid:criconcatid},  
            dataType:"json",  
            success:function(data){  
                $('#criconcat_del').val(data.CriConCatID);
                $('#DeleteCriConCat').modal('show');  
            }  
        });  
    });  
});  
</script>

<!-- Modal for Add Contestant-->
<div class="modal fade" id="AddContestant" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header ">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Add Contestant</h4>
		</div>
		<form action="index-admin.php" method="post">
		<div class="modal-body">
			<div class="form-group">
				<label for="recipient-name" class="control-label lg">Contestant Name:</label>
				<input type="text"  name="txtContestantName" class="form-control" placeholder="Enter ContestantName" required>
		    </div>
		    <div class="form-group">
				<label for="recipient-name" class="control-label lg">Title Name:</label>
				<?php
					include('config.php');
					$query = "SELECT * FROM title";
					$result = mysqli_query($dbcon, $query);
					echo "<select class='form-control' name='cboxTitle'>";
				 	while ($row = mysqli_fetch_array($result)) {
				 		
				 		echo "<option value=".$row['TitleID'].">".$row['TitleName']."</option>";
				 	}
				 	echo "</select>";
				?>
		    </div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<input type="submit" name="addcontestant" id="addcontestant" value="Add Contestant" class="btn btn-primary">
		</div>
	    </form>
	</div>
	</div>
</div>


<!-- Modal for Add Category-->
<div class="modal fade" id="AddCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header ">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Add Category</h4>
		</div>
		<form action="index-admin.php" method="post">
		<div class="modal-body">
			<div class="form-group">
				<label for="recipient-name" class="control-label lg">Category Name:</label>
				<input type="text"  name="txtCategoryName" class="form-control" placeholder="Enter CategoryName" required>
		    </div>
		    <div class="form-group">
				<label for="recipient-name" class="control-label lg">CategoryPercentage:</label>
				<div class="input-group">
				  <input type="text" class="form-control" name="txtCategoryPercentage" placeholder="Enter CategoryPercentage">
				  <span class="input-group-addon">%</span>
				</div>
				<h5><small style="color: #999;">Total Percentage must be equal to 100%.</small></h5>
		    </div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<input type="submit" name="addcategory" id="addcategory" value="Add Category" class="btn btn-primary">
		</div>
	    </form>
	</div>
	</div>
</div>


<!-- Modal for Add Criteria-->
<div class="modal fade" id="AddCriteria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header ">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Add Criteria</h4>
		</div>
		<form action="index-admin.php" method="post">
		<div class="modal-body">
			<div class="form-group">
				<label for="recipient-name" class="control-label lg">Criteria Name:</label>
				<input type="text"  name="txtCriteriaName" class="form-control" placeholder="Enter CriteriaName" required>
		    </div>
		    <div class="form-group">
				<label for="recipient-name" class="control-label lg">CriteriaPoint:</label>
				<div class="input-group">
				  <input type="text" class="form-control" name="txtCriteriaPoint" placeholder="Enter CriteriaPercentage">
				  <span class="input-group-addon">pts</span>
				</div>
				<h5><small style="color: #999;">Total Points for every Category must be equal to 100 points.</small></h5>
		    </div>
		    <div class="form-group">
				<label for="recipient-name" class="control-label lg">Category Name:</label>
				<?php
					include('config.php');
					$query = "SELECT * FROM category";
					$result = mysqli_query($dbcon, $query);
					echo "<select class='form-control' name='cboxCategory'>";
				 	while ($row = mysqli_fetch_array($result)) {
				 		
				 		echo "<option value=".$row['CategoryID'].">".$row['CategoryName']."</option>";
				 	}
				 	echo "</select>";
				?>
		    </div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<input type="submit" name="addcriteria" id="addcriteria" value="Add Criteria" class="btn btn-primary">
		</div>
	    </form>
	</div>
	</div>
</div>


<!-- Modal for Edit Contestant -->
<div id="EditContestant" class="modal fade">  
    <div class="modal-dialog">  
        <div class="modal-content"> 
        	<form method="post" action="index-admin.php">
                <div class="modal-header">  
                    <button type="button" class="close" data-dismiss="modal">&times;</button>  
                    <h4 class="modal-title">Edit Contestant</h4>  
                </div>  
                <div class="modal-body">  
                	<div class="form-group">
                        <label>Contestant Name:</label>  
                        <input type="text" name="contestantname" id="contestantname" class="form-control" />
                    </div> 

                    <div class="form-group">
                        <label>Title:</label>  
                        <?php
                          	$query="SELECT * FROM title";
                          	$result = mysqli_query($dbcon, $query);
                          	echo "<select name='cboxTitle' class='form-control'>";
                          		while ($row=mysqli_fetch_array($result)) {
                          		echo "<option value=".$row['TitleID'].">".$row['TitleName']."</option>";
                          	}
                          	echo "</select>";
                        ?>
                    </div>
                    <input type="text" name="contestantid" id="contestantid" style="display: none;">  
                </div>  
                <div class="modal-footer">  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                    <input type="submit" name="editcontestant" id="editcontestant" value="Update" class="btn btn-primary" />  
                </div>  
			</form> 
        </div>  
    </div>  
</div>  


<!-- Modal for Delete Contestant -->
<div id="DeleteContestant" class="modal fade">  
    <div class="modal-dialog">  
        <div class="modal-content"> 
        	<form method="post" action="index-admin.php">
                <div class="modal-header">  
                    <button type="button" class="close" data-dismiss="modal">&times;</button>  
                    <h4 class="modal-title">Delete Contestant</h4>  
                </div>  
                <div class="modal-body">  
                	<div class="form-group">
                       Are you sure you want to delete data?
                    </div> 
                    <input type="text" name="contestantid_del" id="contestantid_del" style="display: none;">  
                </div>  
                <div class="modal-footer">  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                    <input type="submit" name="deletecontestant" id="deletecontestant" value="Delete" class="btn btn-primary" />  
                </div>  
			</form> 
        </div>  
    </div>  
</div>  


<!-- Modal for Edit Category -->
<div id="EditCategory" class="modal fade">  
    <div class="modal-dialog">  
        <div class="modal-content"> 
        	<form method="post" action="index-admin.php">
                <div class="modal-header">  
                    <button type="button" class="close" data-dismiss="modal">&times;</button>  
                    <h4 class="modal-title">Edit Category</h4>  
                </div>  
                <div class="modal-body">  
                	<div class="form-group">
                        <label>Cateogry Name:</label>  
                        <input type="text" name="categoryname" id="categoryname" class="form-control" />
                    </div> 

                    <div class="form-group">
                        <label>Percentage:</label> 
                        <div class="input-group"> 
	                        <input type="text" name="percentage" id="percentage" class="form-control" />
	                        <span class="input-group-addon">%</span>
						</div>
						<h5><small style="color: #999;">Total Percentage must be equal to 100%.</small></h5>
                    </div>
                    <input type="text" name="categoryid" id="categoryid" style="display: none;">  
                </div>  
                <div class="modal-footer">  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                    <input type="submit" name="editcategory" id="editcategory" value="Update" class="btn btn-primary" />  
                </div>  
			</form> 
        </div>  
    </div>  
</div>  


<!-- Modal for Delete Category -->
<div id="DeleteCategory" class="modal fade">  
    <div class="modal-dialog">  
        <div class="modal-content"> 
        	<form method="post"action="index-admin.php">
                <div class="modal-header">  
                    <button type="button" class="close" data-dismiss="modal">&times;</button>  
                    <h4 class="modal-title">Delete Category</h4>  
                </div>  
                <div class="modal-body">  
                	<div class="form-group">
                       Are you sure you want to delete data?
                    </div> 
                    <input type="text" name="categoryid_del" id="categoryid_del" style="display: none;">  
                </div>  
                <div class="modal-footer">  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                    <input type="submit" name="deletecategory" id="deletecategory" value="Delete" class="btn btn-primary" />  
                </div>  
			</form> 
        </div>  
    </div>  
</div>  


<!-- Modal for Edit Criteria -->
<div id="EditCriteria" class="modal fade">  
    <div class="modal-dialog">  
        <div class="modal-content"> 
        	<form method="post" action="index-admin.php">
                <div class="modal-header">  
                    <button type="button" class="close" data-dismiss="modal">&times;</button>  
                    <h4 class="modal-title">Edit Criteria</h4>  
                </div>  
                <div class="modal-body">  
                	<div class="form-group">
                        <label>Criteria Name:</label>  
                        <input type="text" name="criterianame" id="criterianame" class="form-control" />
                    </div> 
                    <div class="form-group">
                        <label>Point:</label> 
                        <div class="input-group"> 
	                        <input type="text" name="point" id="point" class="form-control" />
	                        <span class="input-group-addon">pts</span>
						</div>
						<h5><small style="color: #999;">Total Points must be equal to 100pts.</small></h5>
                    </div>
                    <div class="form-group">
                        <label>Category Name:</label>  
                        <?php
							include('config.php');
							$query = "SELECT * FROM category";
							$result = mysqli_query($dbcon, $query);
							echo "<select class='form-control' name='cboxCategory'>";
						 	while ($row = mysqli_fetch_array($result)) {
						 		
						 		echo "<option value=".$row['CategoryID'].">".$row['CategoryName']."</option>";
						 	}
						 	echo "</select>";
						?>
                    </div> 
                    <input type="text" name="criteriaid" id="criteriaid" style="display: none;">  
                </div>  
                <div class="modal-footer">  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                    <input type="submit" name="editcriteria" id="editcriteria" value="Update" class="btn btn-primary" />  
                </div>  
			</form> 
        </div>  
    </div>  
</div>  


<!-- Modal for Delete Criteria -->
<div id="DeleteCriteria" class="modal fade">  
    <div class="modal-dialog">  
        <div class="modal-content"> 
        	<form method="post" action="index-admin.php">
                <div class="modal-header">  
                    <button type="button" class="close" data-dismiss="modal">&times;</button>  
                    <h4 class="modal-title">Delete Criteria</h4>  
                </div>  
                <div class="modal-body">  
                	<div class="form-group">
                       Are you sure you want to delete data?
                    </div> 
                    <input type="text" name="criteriaid_del" id="criteriaid_del" style="display: none;">  
                </div>  
                <div class="modal-footer">  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                    <input type="submit" name="deletecriteria" id="deletecriteria" value="Delete" class="btn btn-primary" />  
                </div>  
			</form> 
        </div>  
    </div>  
</div>  

<!-- Modal for Delete CriConCat-->
<div id="DeleteCriConCat" class="modal fade">  
    <div class="modal-dialog">  
        <div class="modal-content"> 
        	<form method="post" action="index-admin.php">
                <div class="modal-header">  
                    <button type="button" class="close" data-dismiss="modal">&times;</button>  
                    <h4 class="modal-title">Delete CriConCat</h4>  
                </div>  
                <div class="modal-body">  
                	<div class="form-group">
                       Are you sure you want to delete data?
                    </div> 
                    <input type="text" name="criconcat_del" id="criconcat_del" style="display: none;">  
                </div>  
                <div class="modal-footer">  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                    <input type="submit" name="deletecriconcat" id="deletecriconcat" value="Delete" class="btn btn-primary" />  
                </div>  
			</form> 
        </div>  
    </div>  
</div>  