<?php 
include('includes/header.php'); 


	$query = "SELECT * FROM tbl_branch WHERE branch_status = '1' ORDER BY branch_id ASC";
    $selectBranch = $Branchset->selectBranch($query);

    function getBranchManagerId($branchId){
        $db = new Database();
        $branchManagerId = "SELECT manager_id FROM branch_managers where branch_id = '$branchId'";
        $branchManagerId = $db->link->query($branchManagerId);
        $managerId = "";
        
        while($row = $branchManagerId->fetch_assoc()){
            $managerId = $row['manager_id'];
        } 
        
        return getManagerName($managerId);
    }

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
                            Branch Lists:
                        </div>

                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover table-full-width" id="branchList">

                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th>Branch Name</th>
                                        <th>Branch Manager</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0; if ($selectBranch) {while ($getbrunch=$selectBranch->fetch_assoc()) { $i++; ?>
                                    <tr>
                                        <td class="center"><?php echo $i; ?></td>
                                        <td><?php echo $getbrunch['branch_name']; ?></td>
                                        <td><?php echo getBranchManagerId($getbrunch['branch_id']); ?></td>
                                        <td><?php echo $getbrunch['branch_contact']; ?></td>
                                        <td><?php echo $getbrunch['branch_email']; ?></td>
                                        <td><?php echo $getbrunch['branch_address']; ?></td>
                                        <td><?php if($getbrunch['branch_status'] == "1"){
                                                        echo "Running";
                                                }else{
                                                    echo "Closed";
                                                } ?>
                                        </td>
                                        <td class="hidden-xs text-center"><?php echo $getbrunch['dated']; ?></td>

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


</div>
<!-- end: MAIN CONTAINER -->


<?php 
include('includes/footer.php');
?>
