<?php 
include('includes/header.php'); 
	$query = "SELECT * FROM product_company_name ORDER BY id ASC";
    $result = $db->select($query);

if (isset($_POST['submit'])) {
    $product_company = $_POST['product_company'];
    $created_by = Session::get('adminId');
    
    
    $insert = "INSERT INTO product_company_name (company_name, status) VALUES ('$product_company', '1')";
    
    $query = $db->link->query($insert);
    
    if($query){
        header("location: ".$_SERVER['PHP_SELF']."?success=true");
    }else{
        header("location: ".$_SERVER['PHP_SELF']."?success=false");
        echo $db->link->error;
    }
}
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
						<div class="col-md-1"></div>
						<div class="col-md-12">
							<!-- start: FORM VALIDATION 1 PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">ADD NEW PRODUCT COMPANY
									<i class="fa fa-external-link-square"></i>
								</div>
								<div class="panel-body">

									<div class="row">
										<div class="col-md-12">
										<?php 
											if (isset($insertRoute)) { ?>
												<div class="alert alert-info fade in">
												    <a href="#" class="close" data-dismiss="alert">&times;</a>
												    <strong><?php echo $insertRoute; ?></strong>
												</div>
										<?php } ?>
										</div>
									</div>

									<form action="#" method="POST" role="form" id="form">
										<div class="row">
											<div class="col-md-12">
												<div class="errorHandler alert alert-danger no-display">
													<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
												</div>
												<div class="successHandler alert alert-success no-display">
													<i class="fa fa-ok"></i> Your form validation is successful!
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label">
														Product Company Name <span class="symbol required"></span>
													</label>
													<input type="text" class="form-control" id="product_company" name="product_company" required>
												</div>
											</div>

											<br>
											<div class="col-md-4">
												<input class="btn btn-md btn-warning btn-block" type="submit" name="submit" value="submit">
											</div>

										</div>


									</form>
								</div>
							</div>
							<!-- end: FORM VALIDATION 1 PANEL -->
						</div>
						<div class="col-md-1"></div>
					</div>

					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-12">
							<!-- start: FORM VALIDATION 1 PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									List of Product Company Name
								</div>

								<div class="panel-body">
									<table class="table table-striped table-bordered table-hover table-full-width" id="routetbl">
										
										<thead>
											<tr>
												<th class="center">#</th>
												<th>Company Name</th>
												<th>ACTION</th>
											</tr>
										</thead>
										<tbody>
                                           <?php
                                            while($row = $result->fetch_assoc()){

                                                ?>

                                                <tr>
                                                    <td style="text-align:center"><?php echo $row['id'] ?></td>
                                                    <td><?php echo $row['company_name'] ?></td>
                                                    <td>Edit</td>
                                                    
                                                </tr>

                                                <?php
                                            }

                                            ?>

                                        </tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="col-md-1"></div>
							<!-- end: FORM VALIDATION 1 PANEL -->
					</div>
					<!-- end: PAGE CONTENT-->
				</div>
			</div>
			<!-- end: PAGE -->


		</div>
		<!-- end: MAIN CONTAINER -->


<?php 
include('includes/footer.php');
?>
<script type="text/javascript">
jQuery( document ).ready(function( $ ) {
UIElements.init();


// data table with pdf csv excel print copy
table = $('#routetbl').DataTable({

  // paging: false,
  // info: false,
  //  dom: 'Bfrtip',
  //       buttons: [
  //           'copy', 'csv', 'excel', 'pdf', 'print'
  //       ]
});
})


</script>