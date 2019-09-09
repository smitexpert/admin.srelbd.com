<?php 

include('includes/header.php'); 
error_reporting(E_ALL);


if (isset($_POST['submit'])) {
    $createBranchs = $Branchset->insertBranch($_POST);
}

$staffList = "SELECT *FROM user where status = '1' and rule != '1'";
$staffList = $db->link->query($staffList);

//	$query = "SELECT * FROM  tbl_branch WHERE branch_status=1";
            
	$query = "SELECT tbl_branch.*, branch_managers.manager_id FROM  tbl_branch LEFT JOIN branch_managers ON tbl_branch.branch_id = branch_managers.branch_id WHERE branch_status=1 ORDER BY tbl_branch.branch_id DESC LIMIT 5";
    $selectcourcom = $Courcompanyset->selectcourComp($query);
    
    function getManagerName($managerId){
        $db = new Database();
        $branchManagerId = "SELECT name FROM user where userId = '$managerId'";
        $branchManagerId = $db->link->query($branchManagerId);
        $managerName = "";
        
        while($row = $branchManagerId->fetch_assoc()){
            $managerName = $row['name'];
        }
        
        return $managerName;
    }


?>
<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>

    <div class="main-content">

        <div class="container"><br><br>

            <div class="row">
                <div class="col-md-12">

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" role="form" id="create_branch" method="POST">
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
													if (isset($createBranchs)) { ?>
                                    <div class="alert alert-info fade in">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <strong>
                                            <?php echo $createBranchs; ?>
                                        </strong>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>



                            <div class="">

                                <div class="col-md-12 center-block">
                                    <div class="panel panel-default">
                                        <div class="panel-heading bdOrange">
                                            <i class="fa fa-external-link-square"></i>CREATE NEW BRANCH
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
                                                                Branch Manager <span class="symbol required"></span>
                                                            </label>
                                                            <!--                                                            <input type="text" required class="form-control" name="Branchman" id="Branchman">-->
                                                            <select name="Branchman" id="Branchman" class="form-control" required>
                                                                <option value="">---</option>
                                                                <?php
                                                                while($row=$staffList->fetch_assoc()){
                                                                    if($row['userId'] == '0' or $row['userId'] == '190402'){
                                                                        continue;
                                                                    }else{
                                                                        ?>
                                                                <option value="<?php echo $row['userId']; ?>"><?php echo $row['name']; ?></option>
                                                                <?php
                                                                    }
                                                                    
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Branch Email <span class="symbol"></span>
                                                            </label>
                                                            <input type="text" class="form-control" name="Branchmail" id="Branchmail" value="">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Contact<span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" required class="form-control" name="Branchcontact" id="Branchcontact" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Branch Address <span class="symbol required"></span>
                                                            </label>
                                                            <input type="text" required class="form-control" name="Branchaddr" id="Branchaddr">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Branch About <span class="symbol required"></span>
                                                            </label>
                                                            <input type="text" required class="form-control" name="Branchabout" id="Branchabout">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">
                                                            Status <span class="symbol required"></span>
                                                        </label>
                                                        <select name="BranchStatus" id="BranchStatus" class="form-control" required>
                                                            <option value="1">Publish</option>
                                                            <option value="2">Pending</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group connected-group">
                                                        <input class="btn btn-md btn-green btn-block" type="submit" name="submit" value="submit">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            Domestic Branch List
                        </div>

                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover table-full-width" id="brnachtbl">

                                <thead>
                                    <tr>
                                        <th class="center">#</th>

                                        <th>Branch Name</th>
                                        <th>Branch Manager</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>About</th>
                                        <th>Opening Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php $i=0; if ($selectcourcom) { while ($getcourcomp=$selectcourcom->fetch_assoc()) { $i++; ?>
                                    <tr>
                                        <td class="center"><?php echo $i; ?></td>

                                        <td><?php echo $getcourcomp['branch_name']; ?></td>
                                        <td><?php echo getManagerName($getcourcomp['manager_id']); ?></td>
                                        <td><?php echo $getcourcomp['branch_contact']; ?></td>
                                        <td><?php echo $getcourcomp['branch_email']; ?></td>
                                        <td><?php echo $getcourcomp['branch_address']; ?></td>
                                        <td><?php echo $getcourcomp['branch_about']; ?></td>

                                        <td><?php echo $getcourcomp['dated']; ?></td>
                                        <td>

                                            <?php 
                                                if($getcourcomp['branch_status'] == '1'){
                                                    echo "Running";
                                                }
                                            ?>
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
