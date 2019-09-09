<?php 
include('includes/header.php'); 
	echo $query = "SELECT sender_name,sender_id,sum(DISTINCT goods_quantity) as clnttotlagoods,sum(DISTINCT goods_weight) as clnttotalweight,sum(DISTINCT total_charge) as clienttotalamount FROM tbl_consignment WHERE sender_type=2 GROUP BY sender_id";
    $selectCorpoClientAmount = $Accounts->selectAccount($query);
?>

		<!-- start: MAIN CONTAINER -->
		<div class="main-container">

<?php include('includes/sidebar-menu.php'); ?>


			<!-- start: PAGE -->
			<div class="main-content">
				<!-- end: SPANEL CONFIGURATION MODAL FORM -->
				<div class="container"><br><br><br><br>

					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									STAFF ACCOUNTS
								</div>

								<div class="panel-body table-responsive">
									<div class="tbl">
									<table class="table table-striped table-bordered table-hover table-full-width" id="cntylisttable">
										<thead>
											<tr>
												<th class="center">#</th>
												<th>Staff Name</th>
												<th>Total Goods</th>
												<th>Total Weight</th>
												<th>Total Amount</th>
												<th></th>
											</tr>
										</thead>
										<tbody>

									   <?php $i=0; if ($selectCorpoClientAmount) { while ($getclientamount=$selectCorpoClientAmount->fetch_assoc()) { $i++; ?>
											<tr>
												<td class="center"><?php echo $i; ?></td>
												
												<td><a href="accoun_single_corpoclient.php?clientid=<?php if(!empty($getclientamount['sender_id'])){echo $corpoclientid=$getclientamount['sender_id']; } ?>">
												<?php echo $getclientamount['sender_name']; ?></a></td>
												<td><?php echo $getclientamount['clnttotlagoods']; ?></td>
												<td><?php echo $getclientamount['clnttotalweight']; ?></td>
												<td><?php echo $getclientamount['clienttotalamount']; ?></td>
												<!-- <td class="text-center"><?php //echo $getclientamount['status']; ?></td> -->
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
										 <?php } }else { echo "Data not found";}  ?> 
										</tbody>
											        <tfoot>
            								<tr>
											<th class="center">#</th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												
										
            								</tr>
        							</tfoot>
									</table>
									</div>
								</div>
							</div>


							</div>
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
	$(document).ready(function(){

// 	$("#route_code").change(function(){
// 		event.preventDefault();
// 		getGenVal();
// 	});

// 	function getGenVal(){
// 	   $.ajax({  
//         url:"get_gen_price.php",  
//         method:"POST",  
//         //data:{incomeid:incomeid, income_value:income_value},  
// 		//dataType: "JSON",
//         success:function(data){  
//              //alert(data[3]);
             
//              $('#countryName').val(data[2]);
//              //alert(data);  
//         }  
//    		});  
		
// 	}


})
</script>
