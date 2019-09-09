<?php 
include('includes/header.php'); 


	
    

$query = "SELECT * FROM user_rule";

$result = $db->select($query);

?>
		<!-- start: MAIN CONTAINER -->
		<div class="main-container">

<?php include('includes/sidebar-menu.php'); ?>


			<!-- start: PAGE -->
			<div class="main-content">
				<!-- end: SPANEL CONFIGURATION MODAL FORM -->
				<div class="container"><br><br>
					<!-- end: PAGE HEADER -->
					<!-- start: PAGE CONTENT -->
					<div class="row">
					<div class="col-md-3"></div>
						<div class="col-md-6">
							<!-- start: FORM VALIDATION 1 PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									Designation Lists:
								</div>

								<div class="panel-body" id="designationTabelId">
									<table id="designationTable" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Rule Id</th>
                                                    <th>Rule Title</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
                                                while($row = $result->fetch_assoc()){

                                                    ?>

                                                    <tr>
                                                        <td><?php echo $row['ruleId']; ?></td>
                                                        <td><?php echo $row['ruleName']; ?></td>
                                                        <td><?php if($row['status'] == 1){echo 'Active';}else{echo 'Pending';} ?></td>
                                                        <td><button type="button" class="btn btn-xs btn-teal editBtn" data-toggle="modal" data-target="#myModal" id="<?php echo $row['ruleId']; ?>"><i class="fa fa-edit"></i></button>
                                                        
                                                        </td>
                                                    </tr>

                                                    <?php
                                                }

                                                ?>

                                        </tbody>
                                    </table>
								</div>
							</div>


							</div>
							<!-- end: FORM VALIDATION 1 PANEL -->
							<div class="col-md-3"></div>
						</div>
					</div>
					<!-- end: PAGE CONTENT-->
				</div>
			</div>
			<!-- end: PAGE -->
		<!-- end: MAIN CONTAINER -->
		
		<div class="">
		    <div class="modal modal-dialog fade" id="myModal" role="dialog">

		        <!-- Modal content-->
		        <div class="">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal">&times;</button>
		                <h4 class="modal-title">Update Designation</h4>
		            </div>
		            <div class="modal-body">
		                <form action="" id="updateDesignationForm">
		                    <input type="text" id="ruleIdUp" name="ruleIdUp" hidden>
		                    <label for="designationTitle">Designation Title</label>
		                    <input type="text" placeholder="Title" id="designationTitle" class="form-control" name="designationTitleUp" required><br>
		                    <label for="designationStatus">Designation Status</label>
		                    <select name="designationStausUp" id="designationStatus" class="form-control">
		                        <option value="1">Active</option>
		                        <option value="0">Pending</option>
		                    </select><br>
		                    <input type="submit" value="Update" class="btn btn-sm btn-danger btn-block">
		                </form>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		            </div>
		        </div>

		    </div>
		</div>

<?php 
include('includes/footer.php');
?>
