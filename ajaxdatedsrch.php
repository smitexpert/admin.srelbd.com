
<?php 
ob_start();

require __DIR__."/classes/Accounts.php";
$Accounts = new Accounts();


//CORPO CLIENT ACC DATED SRCH #############################

if ($_POST['action'] == 'srchclientrecordbydata') {

	$corpoclientid = $_POST['corpoclientid'];
	$dateForm = $_POST['dateForm'];
	$dateTo = $_POST['dateTo'];

	if (!empty($corpoclientid)) {
		echo $query = "SELECT sender_name,dest_country,income_or_outgo,goods_type,goods_type,goods_quantity,goods_weight,CorpoClientPrice,total_charge,track_id,booking_date,booked_by,assigned_to,menifested,consignment_status FROM tbl_consignment WHERE sender_id=$corpoclientid AND sender_type=2 AND booking_date BETWEEN '$dateForm' AND '$dateTo'";
	if ($query) { 
	$selectCorpoClientAmount = $Accounts->selectAccount($query); ?>
s



										<tr>
											<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
											<td>
											<!-- CSV EXPORT FORM DATA --> 
															<form method="post" action="exportCsv.php" align="center">  
																<input type="hidden" name="csvdata" value="<?php echo $query;  ?>">
																<input type="submit" name="exportCsv" value="CSV Export" id="csvsubmitbtn" class="btn btn-xs btn-danger" />  
															</form> 
											<!-- CSV EXPORT FORM DATA END -->
											</td>
										</tr>
											<div class="center-block text-center" id="loader" style="display: none;">
												<strong>Data is loading.. please wait for while</strong><br>
												<img  src="assets/images/dataloader.gif" alt="ddd" width="25"><br><br>
											</div>

									   <?php $i=0; if ($selectCorpoClientAmount) { while ($getclientamount=$selectCorpoClientAmount->fetch_assoc()) { $i++; ?>
											<tr>
												<td class="center"><?php echo $i; ?></td>
												
												<td><a href="accoun_single_corpoclient.php?clientid=<?php if(!empty($getclientamount['sender_id'])){echo $corpoclientid=$getclientamount['sender_id']; } ?>">
												<?php echo $getclientamount['sender_name']; ?></a></td>
												<td><?php echo $getclientamount['dest_country']; ?></td>
												<td><?php echo $getclientamount['income_or_outgo']; ?></td>
												<td><?php echo $getclientamount['goods_type']; ?></td>
												<td><?php echo $getclientamount['goods_quantity']; ?></td>
												<td><?php echo $getclientamount['goods_weight']; ?></td>
												<td><?php echo $getclientamount['CorpoClientPrice']; ?></td>
												<td><?php echo $getclientamount['total_charge']; ?></td>
												<td><?php echo $getclientamount['track_id']; ?></td>
												<td><?php echo $getclientamount['booking_date']; ?></td>
												<td><?php echo $getclientamount['booked_by']; ?></td>
												<td><?php echo $getclientamount['assigned_to']; ?></td>
												<td><?php echo $getclientamount['menifested']; ?></td>
												<td><?php echo $getclientamount['consignment_status']; ?></td>
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
										 <?php } }else { echo "Data not found";} 







	} } }else{} 

