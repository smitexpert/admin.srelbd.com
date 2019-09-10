<?php 
include('includes/header.php');
//	$query = "SELECT * FROM user WHERE rule != '1' AND rule != '2' ORDER BY userId DESC";
	$query = "SELECT * FROM sale_history";
    $result = $db->select($query);

    function getDesignation($dId){
        $designation = $dId;
        $db = new Database();
        
        $queryD = "SELECT ruleName from user_rule where ruleId = '$dId'";
        $query = $db->link->query($queryD);
        
        $designation = $query->fetch_row();
        
        return $designation[0];
        
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
						<div class="col-md-12">
							<!-- start: FORM VALIDATION 1 PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									DETAILS SALE HISTORY
								</div>

								<div class="panel-body">
									<table id="viewAllSaleTable" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>product_id</th>
                                                <th>chalan_no</th>
                                                <th>buyer_id</th>
                                                <th>buyer_name</th>
                                                <th>quantity</th>
                                                <th>unit_price</th>
                                                <th>total_buy_price</th>
                                                <th>total_price</th>
                                                <th>invoice_no</th>
                                                <th>branch_id</th>
                                                <th>sale_date</th>
                                                <th>entry_by </th>
                                                <th>entry_by </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
                                            if($result){while($row = $result->fetch_assoc()){
                                                ?>

                                                <tr>
                                                    <td><?php echo $row['product_id']; ?></td>
                                                    <td><?php echo $row['chalan_no']; ?></td>
                                                    <td><?php echo $row['buyer_id']; ?></td>
                                                    <td><?php echo $row['buyer_name']; ?></td>
                                                    <td><?php echo $row['quantity']; ?></td>
                                                    <td><?php echo $row['unit_price']; ?></td>
                                                    <td><?php echo $row['total_buy_price']; ?></td>
                                                    <td><?php echo $row['total_price']; ?></td>
                                                    <td><?php echo $row['invoice_no']; ?></td>
                                                    <td><?php echo $row['branch_id']; ?></td>
                                                    <td><?php echo $row['sale_date']; ?></td>
                                                    <td><?php echo $row['entry_by']; ?></td>
                                                </tr>

                                                <?php
                                            }}else{
                                                echo "No Data Found!";
                                            }

                                            ?>

                                        </tbody>
                                    </table>
								</div>
							</div>


							</div>
							<!-- end: FORM VALIDATION 1 PANEL -->
						</div>
					</div>
					<!-- end: PAGE CONTENT-->
				</div>
			</div>
			<!-- end: PAGE -->


		
		<!-- end: MAIN CONTAINER -->


<?php 
include('includes/footer.php');
?>


