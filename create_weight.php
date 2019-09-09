<?php 
include('includes/header.php'); 
	$query = "SELECT * FROM tbl_weight WHERE status=1 ORDER BY weight ASC";
    $selectweight = $priceset->selectRoute($query);


if (isset($_POST['submit'])) {
    $insertWeight = $priceset->creatWeight($_POST);
    $selectweight = $priceset->selectRoute($query);
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
						<div class="col-md-10">
							<!-- start: FORM VALIDATION 1 PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">CREATE WEIGHT
									<i class="fa fa-external-link-square"></i>
								</div>
								<div class="panel-body">

									<div class="row">
										<div class="col-md-12">
										<?php 
											if (isset($insertWeight)) { ?>
												<div class="alert alert-info fade in">
												    <a href="#" class="close" data-dismiss="alert">&times;</a>
												    <strong><?php echo $insertWeight; ?></strong>
												</div>
										<?php } ?>
										</div>
									</div>

									<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" role="form" id="form">
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
														Weight <span class="symbol required"></span>
													</label>
													<input required type="text" class="form-control" id="weight" name="weight">
												</div>
											</div>



											<div class="col-md-4">
												<div class="form-group connected-group">
													<label class="control-label">Status<span class="symbol required"></span>
													</label>
												<select name="status" required id="status" class="form-control" >
														<option value="">--</option>
														<option value="1">Publish</option>
														<option value="2">Pending</option>
												</select>
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
						<div class="col-md-10">
							<!-- start: FORM VALIDATION 1 PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									UNIT LIST
								</div>

								<div class="panel-body">
									<table class="table table-striped table-bordered table-hover table-full-width" id="weighttbl">
										
										<thead>
											<tr>
												<th class="center">#</th>
												<th>Unit</th>
												<th class="hidden-xs">Status</th>
												<th>Dated</th>
												<th></th>
											</tr>
										</thead>
										
										<tbody>

									   <?php $i=0; 
    
    	//echo "<h1>helllo data set</h1>";

									   if ($selectweight) { while ($getweight=$selectweight->fetch_assoc()) { $i++; ?>
											<tr>
												<td class="center"><?php echo $i; ?></td>
												<td><?php echo $getweight['weight']; ?></td>
												<td>
												<a href="#" rel="nofollow" target="_blank">
													<?php echo $getweight['status']; ?>
												</a></td>
												<td class="hidden-xs"><?php echo $getweight['dated']; ?></td>
												<td class="center">
												<div class="visible-md visible-lg hidden-sm hidden-xs">
													<a href="#" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
													<a href="#" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
													<a href="#" class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
												</div>
												<div class="visible-xs visible-sm hidden-md hidden-lg">
													<div class="btn-group">
														<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
															<i class="fa fa-cog"></i> <span class="caret"></span>
														</a>
														<ul role="menu" class="dropdown-menu pull-right">
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="#">
																	<i class="fa fa-edit"></i> Edit
																</a>
															</li>
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="#">
																	<i class="fa fa-share"></i> Share
																</a>
															</li>
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="#">
																	<i class="fa fa-times"></i> Remove
																</a>
															</li>
														</ul>
													</div>
												</div></td>
											</tr>
										 <?php } }else{ echo "No data found"; } ?> 

										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="col-md-1"></div>
							<!-- end: FORM VALIDATION 1 PANEL -->
					</div>
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
table = $('#weighttbl').DataTable({

//   paging: false,
//   info: false,
//    dom: 'Bfrtip',
//         buttons: [
//             'copy', 'csv', 'excel', 'pdf', 'print'
//         ]
});
})


</script>