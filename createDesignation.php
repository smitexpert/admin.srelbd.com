<?php include('includes/header.php'); 
error_reporting(E_ALL);
if (isset($_POST['designationTitle'])) {
    /*$createDesignation = $Designationset->insertDesignation($_POST);*/
    
    $designationTitle = $format->validation($_POST['designationTitle']);
    $designationTitle = mysqli_real_escape_string($db->link, $designationTitle);
    
    $status = $_POST['designationstatus'];
    
    $query = "INSERT INTO user_rule (ruleName, status) VALUES ('$designationTitle', '$status')";
    
    $res  = $db->insert($query);
    
    if($res = 1){
        header("location: ".$_SERVER['PHP_SELF'].'?status=Operation Successful');
    }
    
    
}

?>

		<!-- start: MAIN CONTAINER -->
		<div class="main-container">

<?php include('includes/sidebar-menu.php'); ?>

			<div class="main-content">

				<div class="container"><br><br>

					<div class="row">
						<div class="col-md-12">

									<form action="<?php echo $_SERVER['PHP_SELF']; ?>" role="form" id="form_cons_booking" method="POST">
										<div class="row">
											<div class="col-md-12">
												<div class="errorHandler alert alert-danger no-display">
													<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
												</div>
												<div class="successHandler alert alert-success no-display">
													<i class="fa fa-ok"></i> Your form validation is successful!
												</div>
											</div>

											<div class="row-fluid">
												<div class="col-md-12">
												
												</div>
											</div>



										<div class="row">
											<div class="col-md-1"></div>

											<div class="col-md-10 center-block">
											
											<?php 
													if (isset($_GET['status'])) { ?>
														<!--<div class="alert alert-info fade in">
														    <a href="#" class="close" data-dismiss="alert">&times;</a>
														    <strong>
														    	
														    </strong>
														</div>-->
														<div class="alert alert-success alert-dismissible" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <?php echo $_GET['status']; ?>
                                                        </div>
												<?php } ?>
											
												<div class="panel panel-default">
													<div class="panel-heading bdOrange">
														CREATE DESIGNATION
														
													</div>


												<div class="panel-body borderOrange">

													<div class="form-group">
														<div class="row">
															<div class="col-md-6">										
																<div class="form-group">
																	<label class="control-label">
																		Designation Title <span class="symbol required"></span>
																	</label>
																	<input type="text" required class="form-control" name="designationTitle" id="designationTitle" value="">
																</div>
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">
																		Status <span class="symbol required"></span>
																	</label>
																	<select name="designationstatus" id="designationstatus" class="form-control" required>
																		<option value="1">Publish</option>
																		<option value="0">Pending</option>
																		
																	</select>
																</div>
															</div>


														</div>
													</div>														




													<div class="row">
														<div class="col-md-12">
															<div class="form-group connected-group">
																<input class="btn btn-md btn-warning btn-block" type="submit" name="submit" value="submit">
															</div>		
														</div>
													</div>

												</div>										


													</div>
												</div>
											</div>
											<div class="col-md-1"></div>
										</div>





									</form>


						</div>
					</div>

				</div>
			</div>

		</div>



<?php 
include('includes/footer.php');
?>
<script type="text/javascript">
jQuery( document ).ready(function( $ ) {
})
</script>
