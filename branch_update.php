<?php 
include('includes/header.php'); 


	$query = "SELECT * FROM tbl_branch WHERE branch_status = '1' ORDER BY branch_id ASC";
    $selectBranch = $Branchset->selectBranch($query);

//select all user from user table
	$query2 = "SELECT * FROM user WHERE rule != '1' AND rule != '2' ORDER BY userId DESC";
    $selectUser = $db->link->query($query2);

    function getBranchManagerId($branchId){
        $db = new Database();
        $branchManagerId = "SELECT manager_id FROM branch_managers where branch_id = '$branchId'";
        $branchManagerId = $db->link->query($branchManagerId);
        $managerId = "";
        
        if($branchManagerId->num_rows >0 ){
            while($row = $branchManagerId->fetch_assoc()){
                $managerId = $row['manager_id'];
                
            }
            
            return getManagerName($managerId);
            
        }else{
            return "0";
        }
        
    }

    function getManagerName($managerId){
        $db = new Database();
        $branchManagerId = "SELECT name FROM user where userId = '$managerId'";
        $branchManagerId = $db->link->query($branchManagerId);
        $managerId = "";
        
        while($row = $branchManagerId->fetch_assoc()){
            $managerId = $row['name'];
        }
        
        return $managerId;
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
                            BRANCH UPDATE
                        </div>

                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover table-full-width" id="branchUpdate">

                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th>Branch Name</th>
                                        <th>Branch Manager</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Update</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0; if ($selectBranch) {while ($getbrunch=$selectBranch->fetch_assoc()) { $i++;
                                                                                                                     
                                         
                                             
                                                                                                                
                                    ?>
                                    <tr>
                                        <td class="center"><?php echo $i; ?></td>
                                        <td><?php echo $getbrunch['branch_name']; ?></td>
                                        <td><?php if(getBranchManagerId($getbrunch['branch_id']) == "0"){
                                        echo "Manager not assigned";
                                    }else{
                                        echo getBranchManagerId($getbrunch['branch_id']);
                                    } ?></td>
                                        <td><?php echo $getbrunch['branch_contact']; ?></td>
                                        <td><?php echo $getbrunch['branch_email']; ?></td>
                                        <td><?php echo $getbrunch['branch_address']; ?></td>
                                        <?php $st =  $getbrunch['branch_status']; 
                                        
                                            if($st == 0){
                                                $status = "Closed";
                                                ?>
                                        <td style="text-align:center" ;><button type="button" class="btn btn-xs btn-teal editBranchBtn" data-toggle="modal" data-target="#branchEditModal" id="<?php echo $getbrunch['branch_id']; ?>" disabled><i class="fa fa-edit"></i></button>
                                        </td>
                                        <?php
                                            }else if($st == 1){
                                                $status = "Running";
                                                ?>
                                        <td style="text-align:center" ;><button type="button" class="btn btn-xs btn-teal editBranchBtn" data-toggle="modal" data-target="#branchEditModal" id="<?php echo $getbrunch['branch_id']; ?>"><i class="fa fa-edit"></i></button>
                                        </td>
                                        <?php
                                                
                                            }
                                        
                                        ?>
                                        <td style="text-align:center"><?php echo $status; ?></td>

                                    </tr>
                                    <?php } }
                                    else{ echo "Data not found";} ?>
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
    <div class="modal modal-dialog modal-lg fade" id="branchEditModal" role="dialog">

        <!-- Modal content-->
        <div class="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Branch Information</h4>
            </div>
            <div class="modal-body">
                <form action="" id="updateBranchInformation">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">
                                        BRANCH NAME <span class="symbol required"></span>
                                    </label>
                                    <input type="text" class="form-control" name="upBranchName" id="branchName" value="" disabled>

                                    <input type="hidden" class="form-control" name="upBranchId" id="branchId" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">
                                        BRANCH MANAGER <span class="symbol required"></span>
                                    </label>
                                    <select name="upBranchManager" id="branchManager" class="form-control" required>
                                        <option value="">Select Manager</option>
                                        <?php
                                            while($row = $selectUser->fetch_assoc()){                                                
                                                ?>
                                        <option value="<?php echo $row['userId'];?>"><?php echo $row['name'];?></option>
                                        <?php 
                                            }  
                                        ?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">
                                        CONTACT NO. <span class="symbol required"></span>
                                    </label>
                                    <input type="text" required class="form-control" name="upContact" id="contact" value="">
                                </div>
                            </div>
                               
                               <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">
                                        BRANCH ABOUT
                                    </label>
                                    <input type="text" class="form-control" name="upBranchAbout" id="branchAbout" value="">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">
                                        E-MAIL <span class="symbol required"></span>
                                    </label>
                                    <input type="text" required class="form-control" name="upEmail" id="email">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">
                                        ADDRESS
                                    </label>
                                    <input type="text" class="form-control" name="upAddress" id="address">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">
                                        Update Status <span class="symbol required"></span>
                                    </label>
                                    <select name="upStatus" id="updateStatus" class="form-control" data-show-subtext="true" data-live-search="true">
                                        <option value="1">Running</option>
                                        <option value="0">Close</option>
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
