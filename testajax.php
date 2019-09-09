<?php 
ob_start();
require __DIR__."/classes/Courcompanyset.php";
$Courcompanyset = new Courcompanyset();

if ($_POST['action'] == 'courcompPricesrch') {


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

		while($getsrcdata = $runsrcquery->fetch_assoc()){?> 
	<tr>
		<td><?php echo $getsrcdata['cour_comp_name']; ?></td>
		<td><?php echo $getsrcdata['route_code']; ?></td>
		<td><?php echo $getsrcdata['country_id']; ?></td>
		<td><?php echo $getsrcdata['income_or_outgo']; ?></td>
		<td><?php echo $getsrcdata['goods_type']; ?></td>
		<td><?php echo $getsrcdata['unit']; ?></td>
		<td><?php echo $getsrcdata['price']; ?></td>
		<td><?php echo $getsrcdata['price']; ?></td>
		<td><?php echo $getsrcdata['price']; ?></td>
		<td><?php echo $getsrcdata['price']; ?></td>

	</tr>
		<!-- $output = array("price" => $getsrcdata['price'],"unit" => $getsrcdata['unit']);
		ob_clean();
		echo json_encode($output); -->

		<?php }

	}else{

		$srcquery2	 = "SELECT p.*,c.cour_comp_name FROM `tbl_principal_price` as p,tbl_courier_companies as c WHERE p.cour_company = c.cour_comp_id AND route_code=$route";
		$runsrcquery = $Courcompanyset->selectcourComp($srcquery2);	
		while($getsrcdata = $runsrcquery->fetch_assoc()){?> 
	<tr>
		<td><?php echo $getsrcdata['cour_comp_name']; ?></td>
		<td><?php echo $getsrcdata['route_code']; ?></td>
		<td><?php echo $getsrcdata['country_id']; ?></td>
		<td><?php echo $getsrcdata['income_or_outgo']; ?></td>
		<td><?php echo $getsrcdata['goods_type']; ?></td>
		<td><?php echo $getsrcdata['unit']; ?></td>
		<td><?php echo $getsrcdata['price']; ?></td>
		<td><?php echo $getsrcdata['price']; ?></td>
		<td><?php echo $getsrcdata['price']; ?></td>
		<td><?php echo $getsrcdata['price']; ?></td>

	</tr>
		<!-- $output = array("price" => $getsrcdata['price'],"unit" => $getsrcdata['unit']);
		ob_clean();
		echo json_encode($output); -->

		<?php }
}

	}
}





}
exit();