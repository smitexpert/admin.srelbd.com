
<?php 

include('includes/header.php'); 
	
?>

		<!-- start: MAIN CONTAINER -->
		<div class="main-container">

<?php include('includes/sidebar-menu.php'); ?>

			<!-- start: PAGE -->
			<div class="main-content">
				<!-- end: SPANEL CONFIGURATION MODAL FORM -->
				<div class="container"><br><br>
					<!-- start: PAGE CONTENT -->
					<div class="row">
					    <div class="col-md-1"></div>
					    <div class="col-md-10" id="alert"></div>
					    <div class="col-md-1"></div>
					</div>
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-10">
							<!-- start: FORM VALIDATION 1 PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									CORPORATE CLIENT LIMIT UPDATE
								</div>
								<div class="panel-body">
									<form action="" role="form" id="client_limit_update" method="POST">
										<div class="row">
											<div class="col-md-12">
												<div class="errorHandler alert alert-danger no-display">
													<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
												</div>
												<div class="successHandler alert alert-success no-display">
													<i class="fa fa-ok"></i> Your form validation is successful!
												</div>
											</div>


											<div class="col-md-4">
												<div class="form-group">
													<label for="form-field-select-3">
                                                        Corporate Company <span class="symbol required"></span>
                                                    </label>
                                                    <select id="client_limit_update_id" name="client_limit_update_id" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" required>

                                                        <option>Select Client</option>
                                                        <?php $query = "SELECT * FROM corporate_clients WHERE status=1 ORDER BY created_date DESC";
														      $result = $db->link->query($query);
                                                                while($row = $result->fetch_assoc()){
                                                                    ?>
                                                                    <option value="<?php echo $row['id'];?>"><?php echo $row['company_name']; ?></option>
                                                                    <?php
                                                                }
                                                        ?>
                                                    </select>
												</div>
											</div>
											
											<div class="col-md-4">
												<div class="form-group">
													<label for="form-field-select-3">
                                                        Current Limit <span class="symbol required"></span>
                                                    </label>
                                                    <input name="currentcredit" id="currentcredit" type="text" class="form-control" style="font-size: 18px;padding: 16px 10px!important;" disabled>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="form-field-select-3">
                                                        Update Limit Amount <span class="symbol required"></span>
                                                    </label>
                                                    <input type="text" name="updatelimitamount" id="updatelimitamount" class="form-control" required style="font-size: 18px;padding: 16px 10px!important;">
												</div>
											</div>
											
										</div>
										<br>
										<div class="row">
												<div class="col-md-12">
												<div class="form-group connected-group">
													<input class="btn btn-md btn-warning btn-block" type="submit" name="submit" value="submit">
												</div>
												</div>
											</div>

									</form>
								</div>
							</div>
							<!-- end: FORM VALIDATION 1 PANEL -->
						</div>
						<div class="col-md-1"></div>
					</div>

				
						
						
							
							<!-- end: FORM VALIDATION 1 PANEL -->
						
			</div>
			<!-- end: PAGE -->


		</div>
		<!-- end: MAIN CONTAINER -->
		
		<div class="loading">
		    <img src="img/loading.gif" alt="">
		</div>


<?php 
include('includes/footer.php');
?>
