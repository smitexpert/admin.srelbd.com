<?php include('includes/header.php'); 
	
if (isset($_POST['submit'])) {
    
    $client_name = $_POST['client_name'];
    $client_company = $_POST['client_company'];
    $client_mail = $_POST['client_mail'];
    $client_contact = $_POST['client_contact'];
    $client_addr = $_POST['client_addr'];
    $corpoAssignTo = $_POST['corpoAssignTo'];
    $created_by = Session::get('adminId');
    
    $insert = "INSERT INTO corporate_company (name, company_name, email, contact, address, assign_to, created_by) VALUES ('$client_name', '$client_company', '$client_mail', '$client_contact', '$client_addr', '$corpoAssignTo', '$created_by')";
    $query = $db->link->query($insert);
    
    if($query){
        header("location: ".$_SERVER['PHP_SELF']."?success=true");
    }else{
        header("location: ".$_SERVER['PHP_SELF']."?success=false");
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
            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            CREATE CORPORATE COMPANY
                        </div>
                        <div class="panel-body">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" role="form" id="fcorpo_orm" method="POST">
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
                                            <?php 
													if (isset($insertCorpoClient)) { ?>
                                            <div class="alert alert-info fade in">
                                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                                <strong>
                                                    <?php echo $insertCorpoClient; ?>
                                                </strong>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                Client Name<span class="symbol required"></span>
                                            </label>
                                            <input type="text" class="form-control" id="client_name" name="client_name" required>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label">
                                                Company Name<span class="symbol required"></span>
                                            </label>
                                            <input type="text" class="form-control" id="client_company" name="client_company" required>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label">
                                                Email Address <span class="symbol required"></span>
                                            </label>
                                            <input class="form-control" type="email" required id="client_mail" name="client_mail">
                                        </div>


                                        

                                    </div>
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <label class="control-label">
                                                Contact <span class="symbol required"></span>
                                            </label>
                                            <input type="text" required class="form-control" name="client_contact" id="client_contact">
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label">
                                                Address <span class="symbol required"></span>
                                            </label>
                                            <input type="textarea" required class="form-control" id="client_addr" name="client_addr">
                                        </div>

                                        <div class="form-group connected-group">
                                            <label class="control-label">Assign to :<span class="symbol required"></span>
                                            </label>
                                            <select name="corpoAssignTo" id="corpoAssignTo" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" required>
                                                <option value="">--</option>
                                                <?php 
	$query2 = "SELECT * FROM user WHERE status=1";
    $selectstuff = $db->link->query($query2);
	if ($selectstuff) { while ($getstuff=$selectstuff->fetch_assoc()) { ?>
                                                <option value="<?php echo $getstuff['userId']; ?>"><?php echo $getstuff['name']; ?></option>
                                                <?php } }else{} ?>

                                            </select>
                                        </div><br>





                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
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
            
            <div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-10">
							<!-- start: FORM VALIDATION 1 PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									CORPORATE COMPANY LIST
								</div>

								<div class="panel-body">
								
									<table class="table table-striped table-bordered table-hover table-full-width" id="weighttbl">
										
										<thead>
											<tr>
												<th class="center">#</th>
												<th>COMPANY NAME</th>
												<th>CONTACT</th>
												<th>ASSIGN TO</th>
												<th></th>
											</tr>
										</thead>
										
										<tbody>

									   <?php 
                                            $sql = "SELECT * FROM corporate_company";
                                            $rlt = $db->link->query($sql);
                                            
                                            $i=1;
                                            
                                            while($row = $rlt->fetch_assoc()){
                                        ?>
											<tr>
												<td class="center"><?php echo $i; ?></td>
												<td><?php echo $row['company_name']; ?></td>
												<td><?php echo $row['contact']; ?></td>
												<td><?php echo $db->getUserName($row['assign_to']); ?></td>
												<td></td>
											</tr>
										 <?php 
                                            $i++;
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
            
        </div>
        <!-- end: PAGE -->


    </div>
    <!-- end: MAIN CONTAINER -->


    <?php 
include('includes/footer.php');
?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            UIElements.init();
            $('#corpoClientTable3').DataTable({
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });
                        column.data().unique().sort().each(function(d, j) {
                            if (column.search() === '^' + d + '$') {
                                select.append('<option value="' + d + '" selected="selected">' + d + '</option>')
                            } else {
                                select.append('<option value="' + d + '">' + d + '</option>')
                            }
                        });
                    });
                }
            });
        })

    </script>
