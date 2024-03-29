<?php 
include('includes/header.php'); 
	$query = "SELECT * FROM credit_item ORDER BY item_name ASC";
    $result = $db->select($query);

if (isset($_POST['submit'])) {
    $item_name = $_POST['item_name'];
    $created_by = Session::get('adminId');
    
    
    $insert = "INSERT INTO credit_item (item_name, entry_by) VALUES ('$item_name', '$created_by')";
    
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
								<div class="panel-heading">CREATE CREDIT ITEM
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
														Item Name <span class="symbol required"></span>
													</label>
													<input type="text" class="form-control" id="route" name="item_name" required>
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
									CREDIT ITEM LIST
								</div>

								<div class="panel-body">
									<table class="table table-striped table-bordered table-hover table-full-width" id="routetbl">
										
										<thead>
											<tr>
												<th class="center">#</th>
												<th>ITEM</th>
												<th>ACTION</th>
											</tr>
										</thead>
										<tbody>
                                           <?php
                                           if($result){
                                            while($row = $result->fetch_assoc()){

                                                ?>

                                                <tr>
                                                    <td style="text-align:center"><?php echo $row['id'] ?></td>
                                                    <td><?php echo $row['item_name'] ?></td>
                                                    <td style="text-align:center" ;><button type="button" class="btn btn-xs btn-teal editcreditItemBtn" data-toggle="modal" data-target="#creditItemEditModal" id="<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></button>
                                        			</td>
                                                    
                                                </tr>

                                                <?php
                                            }
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
<!--Start Modal code for editing Plant information-->
<div class="">
    <div class="modal modal-dialog modal-lg fade" id="creditItemEditModal" role="dialog">

        <!-- Modal content-->
        <div class="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">UPDATE CREDIT ITEM NAME</h4>
            </div>
            <div class="modal-body">
                <form action="" id="updateItemName">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">
                                        ITEM ID <span class="symbol required"></span>
                                    </label>
                                    <input type="text" class="form-control" name="itemNameId" id="itemNameId" value="" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">
                                        ITEM NAME <span class="symbol required"></span>
                                    </label>
                                    <input type="text" class="form-control" name="itemName" id="itemName" value="" required>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <input type="submit" value="UPDATE ITEM NAME" class="btn btn-sm btn-success btn-block submitBtn">
                </form>
			</div>
			<div class="loading-img">
               <img src="img/loading.gif" alt="Plaese Wait">                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!--End Modal code for editing Plant information-->

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