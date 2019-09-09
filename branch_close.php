<?php 
include('includes/header.php'); 


//	$query = "SELECT * FROM tbl_branch WHERE branch_status= '0' ORDER BY dated DESC";
	$query = "SELECT tbl_branch.*, branch_managers.manager_id FROM  tbl_branch LEFT JOIN branch_managers ON tbl_branch.branch_id = branch_managers.branch_id WHERE branch_status='0'";
    $selectBranch = $Branchset->selectBranch($query);
    
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
                            LIST OF CLOSE BRANCHES
                        </div>

                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover table-full-width" id="closeBranch">

                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th>Branch Name</th>
                                        <th>Manager</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Address</th>
                                        <th>About Branch</th>
                                        <th>Created at</th>
                                        <th>Run Again</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0; if ($selectBranch) {while ($getbrunch=$selectBranch->fetch_assoc()) { $i++; ?>
                                    <tr>
                                        <td class="center"><?php echo $i; ?></td>
                                        <td><?php echo $getbrunch['branch_name']; ?></td>
                                        <td><?php echo getManagerName($getbrunch['manager_id']); ?></td>
                                        <td><?php echo $getbrunch['branch_email']; ?></td>
                                        <td><?php echo $getbrunch['branch_contact']; ?></td>
                                        <td><?php echo $getbrunch['branch_address']; ?></td>
                                        <td><?php echo $getbrunch['branch_about']; ?></td>
                                        <td class="hidden-xs text-center"><?php echo $getbrunch['dated']; ?></td>
                                        
                                        <td style="text-align:center" ;>
                                        <button type="button" class="btn btn-xs btn-teal reopenBranch" data-toggle="modal" data-target="#branchStatusEditModal" id="<?php echo $getbrunch['branch_id']; ?>"><i class="fa fa-edit"></i></button>
                                        </td>

                                    </tr>
                                    <?php } }else{ echo "Data not found";} ?>


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
<!--Start Modal code for editing Plant information-->
<div class="">
    <div class="modal modal-dialog modal-lg fade" id="branchStatusEditModal" role="dialog">

        <!-- Modal content-->
        <div class="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">REOPEN CLOSED BRANCH</h4>
            </div>
            <div class="modal-body">
                <form action="" id="reopenBranchModal">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">
                                        BRANCH NAME <span class="symbol required"></span>
                                    </label>
                                    <input type="text" class="form-control" name="reopnBranchNameName" id="reopnBranchNameId" value="" disabled>

                                    <input type="hidden" class="form-control" name="hiddenReopenName" id="hiddenReopenId" value="">
                                </div>
                            </div>  
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">
                                        Update Status <span class="symbol required"></span>
                                    </label>
                                    <select name="reopenBranchStatusName" id="reopenBranchStatusId" class="form-control" data-show-subtext="true" data-live-search="true">
                                        <option value="1">Open Again</option>
                                        <option value="0">Closed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Update Plant Info" class="btn btn-sm btn-success btn-block">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!--End Modal code for editing Plant information-->

<!-- end: MAIN CONTAINER -->


<?php 
include('includes/footer.php');
?>
