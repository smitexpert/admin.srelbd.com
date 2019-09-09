<?php include('includes/header.php'); 
error_reporting(E_ALL);
if (isset($_POST['submit'])) {
    $createBranchs = $Branchset->insertBranch($_POST);
}

?>

<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>

    <div class="main-content">

        <div class="container"><br><br>
            <div class="row">
                <div class="col-md-12">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" role="form" id="form_cons_booking" method="POST">
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
								    if (isset($createBranchs)) { 
                                    ?>
                                    <div class="alert alert-info fade in">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <strong>
                                            <?php echo $createBranchs; ?>
                                        </strong>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-2"></div>

                                <div class="col-md-8 center-block">
                                    <div class="panel panel-default">
                                        <div class="panel-heading bdOrange">
                                            <i class="fa fa-external-link-square"></i>Create Branch Form
                                            <div class="panel-tools"><a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a><a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal"><i class="fa fa-wrench"></i></a><a class="btn btn-xs btn-link panel-refresh" href="#"><i class="fa fa-refresh"></i></a><a class="btn btn-xs btn-link panel-expand" href="#"><i class="fa fa-resize-full"></i></a></div>
                                        </div>


                                        <div class="panel-body borderOrange">

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Branch Name <span class="symbol required"></span>
                                                            </label>
                                                            <input type="text" required class="form-control" name="Branchname" id="Branchname" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Email <span class="symbol"></span>
                                                            </label>
                                                            <input type="text" class="form-control" name="Branchmail" id="Branchmail" value="">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Contact<span class="symbol required"></span>
                                                            </label>
                                                            <input type="text" required class="form-control" name="Branchcontact" id="Branchcontact" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Branch Address <span class="symbol required"></span>
                                                            </label>
                                                            <input type="text" required class="form-control" name="Branchaddr" id="Branchaddr">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group connected-group">
                                                            <input class="btn btn-lg btn-green btn-block" type="submit" name="submit" value="submit">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php 

	$branchQuery = "SELECT * FROM  tbl_branch WHERE branch_status=1";
    $branchList = $Courcompanyset->selectcourComp($branchQuery);

?>



                <div class="row">

                    <div class="col-md-12">
                        <!-- start: FORM VALIDATION 1 PANEL -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-external-link-square"></i>
                                SREL BRANCH LIST
                            </div>

                            <div class="panel-body">
                                <table class="table table-striped table-bordered table-hover table-full-width" id="brnachtbl">

                                    <thead>
                                        <tr>
                                            <th class="center">#</th>

                                            <th>Branch Name</th>
                                            <th>Contact</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Registration Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php $i=0; if ($branchList) { while ($row=$branchList->fetch_assoc()) { $i++; ?>
                                        <tr>
                                            <td class="center"><?php echo $i; ?></td>

                                            <td><?php echo $row['branch_name']; ?></td>
                                            <td><?php echo $row['branch_contact']; ?></td>
                                            <td><?php echo $row['branch_email']; ?></td>
                                            <td><?php echo $row['branch_address']; ?></td>
                                            <td><?php echo $row['dated']; ?></td>                                   


                                            <td class="center">
                                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                                    <a href="#" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
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
                                                            
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } }else{ } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end: FORM VALIDATION 1 PANEL -->
                </div>
            </div>
        </div>

    </div>



    <?php 
include('includes/footer.php');
?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {

            // data table with pdf csv excel print copy
            table = $('#brnachtbl').DataTable({

                // paging: false,
                // info: false,
                //  dom: 'Bfrtip',
                //       buttons: [
                //           'copy', 'csv', 'excel', 'pdf', 'print'
                //       ]
            });


        })

    </script>
