<?php 
include('includes/header.php');
	// $query = "SELECT s.*,d.designation_title FROM tbl_stuff as s,tbl_designation as d
	//  WHERE s.stuff_designation = d.id AND stuff_status=1 ORDER BY created_at DESC";
//	$query = "SELECT * FROM user WHERE rule != '1' ORDER BY userId DESC";
	$query = "SELECT user.*, user_rule.* FROM user LEFT JOIN user_rule ON user.rule = user_rule.ruleId WHERE rule != '1' ORDER BY userId DESC";
    $result = $db->select($query);

    //get current user rule from user table using by employee id
        $getRule = "SELECT rule FROM user WHERE userId = '$userId'";
        $userRule = $db->link->query($getRule);
        $row = $userRule->fetch_row();
        $currentUserRule = $row[0];

    //get Designatiom List 
    $designationList = "SELECT *FROM user_rule ORDER BY ruleId ASC";
    $getDesignation = $db->link->query($designationList);

    //get Designatiom List 
    $branch = "SELECT *FROM tbl_branch ORDER BY branch_name ASC";
    $branch = $db->link->query($branch);

?>
<!-- start: MAIN CONTAINER -->
<div class="main-container">
    <?php include('includes/sidebar-menu.php'); ?>
    <!-- start: PAGE -->
    <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container"><br><br>
            <div id="aleret_message" style="display:none">
                <div class="alert alert-success " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Operation Success!</strong>
                </div>
            </div>
            <!-- end: PAGE HEADER -->
            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            STAFF UPDATE WINDOW
                        </div>

                        <div class="panel-body">
                            <table id="userTable" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Email</th>
                                        <th>Contact1</th>
                                        <th>Contact2</th>
                                        <th>Reg Date</th>
                                        <th>Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            while($row = $result->fetch_assoc()){ 
                                                
                                                if($row['userId'] == '000000'|| $row['userId'] == '190402')
                                                    continue;

                                                ?>

                                    <tr>
                                        <td><?php echo $row['userId'] ?></td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['ruleName'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td><?php echo $row['contact1'] ?></td>
                                        <td><?php echo $row['contact2'] ?></td>
                                        <td><?php echo $row['createDate'] ?></td>
                                        <?php
                                                    if($currentUserRule > $row['rule']){
                                                        ?>
                                        <td style="text-align:center" ;><button disabled type="button" class="btn btn-xs btn-teal editStaffBtn" data-toggle="modal" data-target="#staffEditModal" id="<?php echo $row['userId']; ?>"><i class="fa fa-edit"></i></button>
                                        </td>
                                        <?php
                                                    }else{
                                                        ?>
                                        <td style="text-align:center" ;><button type="button" class="btn btn-xs btn-teal editStaffBtn" data-toggle="modal" data-target="#staffEditModal" id="<?php echo $row['userId']; ?>"><i class="fa fa-edit"></i></button>
                                        </td>
                                        <?php
                                                    }
                                        ?>
                                    </tr>

                                    <?php
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
<!--Start Modal code for editing Plant information-->
<div class="">
    <div class="modal modal-dialog modal-lg fade" id="staffEditModal" role="dialog">

        <!-- Modal content-->
        <div class="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">UPDATE STAFF INFORMATION</h4>
            </div>
            <div class="modal-body">
                <form action="" id="updateStaffInformation">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">
                                        EMPLOYEE ID <span class="symbol required"></span>
                                    </label>
                                    <input type="text" class="form-control" name="employeeId" id="employeeId" value="" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">
                                        EMPLOYEE NAME <span class="symbol required"></span>
                                    </label>
                                    <input type="text" class="form-control" name="employeeName" id="employeeName" value="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">
                                        DESIGNATION <span class="symbol required"></span>
                                    </label>
                                    <select name="designation" id="designation" class="form-control" required>
                                        <option value="">Select Manager</option>
                                        <?php
                                            while($row = $getDesignation->fetch_assoc()){                                                
                                                ?>
                                        <option value="<?php echo $row['ruleId'];?>"><?php echo $row['ruleName'];?></option>
                                        <?php 
                                            }  
                                        ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">
                                        BRANCH <span class="symbol required"></span>
                                    </label>
                                    <select name="empBranch" id="empBranch" class="form-control" required>
                                        <option value="">Select Branch</option>
                                        <?php
                                            while($row = $branch->fetch_assoc()){                                                
                                                ?>
                                        <option value="<?php echo $row['branch_id'];?>"><?php echo $row['branch_name'];?></option>
                                        <?php 
                                            }  
                                        ?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">
                                        E-MAIL <span class="symbol required"></span>
                                    </label>
                                    <input type="text" required class="form-control" name="upEmail" id="email">
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">
                                        CONTACT NO-1. <span class="symbol required"></span>
                                    </label>
                                    <input type="text" required class="form-control" name="upContact1" id="contact1" value="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">
                                        CONTACT NO-2.
                                    </label>
                                    <input type="text" class="form-control" name="upContact2" id="contact2" value="">
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

                        </div>
                    </div>
                    <input type="submit" value="UPDATE STAFF INFO" class="btn btn-sm btn-success btn-block">
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
