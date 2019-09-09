



<?php 
ob_start();
require __DIR__."/classes/Courcompanyset.php";
$Courcompanyset = new Courcompanyset();?> 

<table class="table table-striped table-bordered table-hover table-full-width" id="principricetable">
	<thead>
		<tr>
			<th class="center">#</th>
			<th>Company Name</th>
			<th>Zone</th>
			<!-- <th>Country</th> -->
			<th>Where</th>
			<th>Goods Type</th>
			<th>Unit</th>
			<th>Price</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>




<?php if (isset($_POST['action']) == 'courcompPricesrch') {
$country = $_POST['country'];
		if (!empty($country)) {
			$routequery = "SELECT route_code,cntry_id FROM `tbl_cour_comp_route` WHERE cntry_id=$country";
			$runroutequery = $Courcompanyset->selectcourComp($routequery);
			if ($runroutequery == ""){ echo "route and county not found for this contry"; }else{
			$getroute = $runroutequery->fetch_assoc();
			//echo "route found from route table : <br>" .
			$route = $getroute['route_code'];
			//echo "cntry from route table : <br>" .
			$rescountry = $getroute['cntry_id'];
			//SEARCH ROUTE OR COUNTRY WHICH IS  AVAILABLE IN PRINCIPAL PRICE TABLE
				$srcquery	 = "SELECT p.*,c.cour_comp_name FROM `tbl_principal_price` as p,tbl_courier_companies as c WHERE p.cour_company = c.cour_comp_id AND country_id=$rescountry";
				$runsrcquery = $Courcompanyset->selectcourComp($srcquery);
				if ($runsrcquery != ""){ 
					$i=1;
					while($getsrcdata = $runsrcquery->fetch_assoc()){?> 
				<tr>
					<td><?php echo $i++; ?></td>
					 <td><?php echo $getsrcdata['cour_comp_name']; ?></td>
					<td><?php echo $getsrcdata['route_code']; ?></td>
					<!-- <td><?php //echo $getsrcdata['country_id']; ?></td> -->
					<td><?php echo $getsrcdata['income_or_outgo']; ?></td>
					<td><?php echo $getsrcdata['goods_type']; ?></td>
					<td><?php echo $getsrcdata['unit']; ?></td>
					<td><?php echo $getsrcdata['price']; ?></td>
					<td class="center">
					<div class="visible-md visible-lg hidden-sm hidden-xs">
						<a href="#" editdata="<?php echo $getsrcdata['id']; ?>" class="btn btn-xs btn-teal tooltips editactionbtn" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
						<a href="#" class="btn btn-xs btn-bricky tooltips delactionbtn"  deldata = "<?php echo $getsrcdata['id']; ?>" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
					</div>
					</td>
				</tr>
					<!-- $output = array("price" => $getsrcdata['price'],"unit" => $getsrcdata['unit']);
					ob_clean();
					echo json_encode($output); -->
					<?php }
				}else{
					$srcquery2	 = "SELECT p.*,c.cour_comp_name FROM `tbl_principal_price` as p,tbl_courier_companies as c WHERE p.cour_company = c.cour_comp_id AND route_code=$route";
					$runsrcquery = $Courcompanyset->selectcourComp($srcquery2);	
					$i=1;
					while($getsrcdata = $runsrcquery->fetch_assoc()){?> 
				<tr>
					<td><?php echo $i++; ?></td>
					 <td><?php echo $getsrcdata['cour_comp_name']; ?></td>
					<td><?php echo $getsrcdata['route_code']; ?></td>
					<!-- <td><?php //echo $getsrcdata['country_id']; ?></td> -->
					<td><?php echo $getsrcdata['income_or_outgo']; ?></td>
					<td><?php echo $getsrcdata['goods_type']; ?></td>
					<td><?php echo $getsrcdata['unit']; ?></td>
					<td><?php echo $getsrcdata['price']; ?></td>
					<td class="center">
					<div class="visible-md visible-lg hidden-sm hidden-xs">
						<a href="#" editdata="<?php echo $getsrcdata['id']; ?>" class="btn btn-xs btn-teal tooltips editactionbtn" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
						<a href="#" class="btn btn-xs btn-bricky tooltips delactionbtn" deldata = "<?php echo $getsrcdata['id']; ?>" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
					</div>
					</td>
				</tr>
					<!-- $output = array("price" => $getsrcdata['price'],"unit" => $getsrcdata['unit']);
					ob_clean();
					echo json_encode($output); -->
					<?php }
					}
			}
		}
}?> 								
	</tbody>
	        <tfoot>
            <tr>
			<th></th>
			<th width="19%"></th>
			<th width="11%"></th>
			<th></th>
			<th width="14.4%"> </th>
			<th></th>
			<th></th>
			<th></th>
			

            </tr>
        </tfoot>
</table>
<?php 									
exit();




//MANIFESTED CONSIGNMENT SEARCH 

if ($_POST['action'] == 'manifestedcons') {

	$corcompany = $_POST['corcompany'];

	if (!empty($corcompany)) {

	 $query = "SELECT cons.*,cntry.country_name FROM tbl_consignment as cons,tbl_country as cntry WHERE cons.dest_country = cntry.country_id AND cons.assigned_to = $corcompany";
	if ($query) { ?>
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

	<?php	$selectcourcomp = $Courcompanyset->selectcourComp($query);
		if (count($selectcourcomp)>0) {?> 


	
									   <?php $i=0; while ($getcourcomp=$selectcourcomp->fetch_assoc()) { $i++; ?>
											<tr>
												<td class="center"><?php echo $i; ?></td>
												<td><?php echo $getcourcomp['assigned_to']; ?></td>
												
												<td><?php if(isset($getcourcomp['route_code'])){ echo $getcourcomp['route_code'];} ?></td>

												<td><?php if(isset($getcourcomp['country_id'])){ 
													$cntryy = $getcourcomp['country_id'];
												$queryy = "SELECT country_name FROM tbl_country WHERE country_id=$cntryy";
												$selectcourcomppp = $Courcompanyset->selectcourComp($queryy);
												$getcourcomppp=$selectcourcomppp->fetch_assoc();
													echo $getcourcomppp['country_name'];

												} ?></td>

												<td><?php echo $getcourcomp['income_or_outgo']; ?></td>
												<td><?php echo $getcourcomp['goods_type']; ?></td>
												<td><?php echo $getcourcomp['goods_weight']; ?></td>
												<td><?php echo $getcourcomp['total_charge']; ?></td>
												<td class="text-center"><?php echo $getcourcomp['booking_date']; ?></td>
												<td class="text-center"><?php echo $getcourcomp['consignment_status']; ?></td>
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


										<?php } } else{ $msg = "no data found"; echo $msg; } }}else{} 

}





//MANIFESTED consignment search by date

if ($_POST['action'] == 'srchconsbydate') {

	$corcompany = $_POST['corcompany'];
	$dateForm = $_POST['dateForm'];
	$dateTo = $_POST['dateTo'];

	if (!empty($corcompany)) {

	 $query = "SELECT cons.* FROM tbl_consignment as cons WHERE cons.dest_country AND cons.assigned_to = $corcompany AND booking_date BETWEEN '$dateForm' AND '$dateTo' ";
	if ($query) { ?>
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

	<?php
		$selectcourcomp = $Courcompanyset->selectcourComp($query);
		if (count($selectcourcomp)>0) {?> 
									   <?php $i=0; while ($getcourcomp=$selectcourcomp->fetch_assoc()) { $i++; ?>
											<tr>
												<td class="center"><?php echo $i; ?></td>
												<td><?php echo $getcourcomp['assigned_to']; ?></td>
												
												<td><?php if(isset($getcourcomp['route_code'])){ echo $getcourcomp['route_code'];} ?></td>

												<td><?php if(isset($getcourcomp['country_id'])){ 
													$cntryy = $getcourcomp['country_id'];
												$queryy = "SELECT country_name FROM tbl_country WHERE country_id=$cntryy";
												$selectcourcomppp = $Courcompanyset->selectcourComp($queryy);
												$getcourcomppp=$selectcourcomppp->fetch_assoc();
													echo $getcourcomppp['country_name'];

												} ?></td>

												<td><?php echo $getcourcomp['income_or_outgo']; ?></td>
												<td><?php echo $getcourcomp['goods_type']; ?></td>
												<td><?php echo $getcourcomp['goods_weight']; ?></td>
												<td><?php echo $getcourcomp['total_charge']; ?></td>
												<td class="text-center"><?php echo $getcourcomp['booking_date']; ?></td>
												<td class="text-center"><?php echo $getcourcomp['consignment_status']; ?></td>
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


										<?php } } else{ $msg = "no data found"; echo $msg; } }}else{} 

}








//GEET ALL COMPANY PRICES,THIS DATA WILL SHOW BY DEFAULT WHEN SEACH PRICE OPTIONS NOT SELECTED

if ($_POST['action'] == 'getallcompprice') {

	$query = "SELECT p.*,r.cour_comp_name,c.country_name FROM tbl_principal_price as p,tbl_courier_companies as r,tbl_country as c WHERE p.cour_company = r.cour_comp_id order by p.unit ASC";

	if (isset($query)) {
		$selectcourcomp = $Courcompanyset->selectcourComp($query);
		if (count($selectcourcomp)>0) {?> 
									   <?php $i=0; while ($getcourcomp=$selectcourcomp->fetch_assoc()) { $i++; ?>
											<tr>
												<td class="center"><?php echo $i; ?></td>
												<td><?php echo $getcourcomp['cour_comp_name']; ?></td>
												<td>
													<?php 
														if (isset($getcourcomp['route_code'])) {
															echo $getcourcomp['route_code']; 
														}
													 ?>
												</td>

												<td>
													<?php 
														if (isset($getcourcomp['country_name'])) {
															echo $getcourcomp['country_name']; 
														}
													 ?>
												</td>
												<td><?php echo $getcourcomp['income_or_outgo']; ?></td>
												<td><?php echo $getcourcomp['goods_type']; ?></td>
												<td><?php echo $getcourcomp['unit']; ?></td>
												<td><?php echo $getcourcomp['price']; ?></td>
												<td class="text-center"><?php echo $getcourcomp['status']; ?></td>
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


										 <?php } } else{ $msg = "no data found"; echo $msg; } }}else{}