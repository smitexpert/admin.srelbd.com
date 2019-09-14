<?php 
include('includes/header.php');
	// $query = "SELECT s.*,d.designation_title FROM tbl_stuff as s,tbl_designation as d
	//  WHERE s.stuff_designation = d.id AND stuff_status=1 ORDER BY created_at DESC";
//	$query = "SELECT * FROM user WHERE rule != '1' ORDER BY userId DESC";
	$query = "SELECT *FROM agent";
    $result = $db->link->query($query);

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
                            AGENT UPDATE WINDOW
                        </div>

                        <div class="panel-body">
                            <table id="agentTable" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>AGENT ID</th>
                                        <th>Name</th>
                                        <th>address</th>
                                        <th>Email</th>
                                        <th>Contact1</th>
                                        <th>Contact2</th>
                                        <th>UPDATE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            while($row = $result->fetch_assoc()){ 

                                                ?>

                                    <tr>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['address'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td><?php echo $row['contact1'] ?></td>
                                        <td><?php echo $row['contact2'] ?></td>        
                                        <td style="text-align:center" ;><button type="button" class="btn btn-xs btn-teal editAgentBtn" data-toggle="modal" data-target="#agentEditModal" id="<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></button>
                                        </td>
                                        
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
    <div class="modal modal-dialog modal-lg fade" id="agentEditModal" role="dialog">

        <!-- Modal content-->
        <div class="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">UPDATE INFORMATION OF <span id = "agentIdShow"></span></h4>
            </div>
            <div class="modal-body">
                <form action="" id="updateAgentInformation">
                    <div class="form-group">
                    <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">
                                        AGENT ID <span class="symbol required"></span>
                                    </label>
                                    <input type="text" class="form-control" name="upAgentId" id="agentId" value="" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">
                                        AGENT NAME <span class="symbol required"></span>
                                    </label>
                                    <input type="text" class="form-control" name="upAgentName" id="agentName" value="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">
                                        E-MAIL <span class="symbol required"></span>
                                    </label>
                                    <input type="text" class="form-control" name="upAgentEmail" id="agentEmail" value="">
                                </div>
                            </div>
                            <div class="col-md-4">
                            <label class="control-label">ASSIGN TO:<span class="symbol required"></span>
                                            </label>
                                            <select name="upAgentAssignTo" id="agentAssignTo" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" required>
                                                
                                                <?php 
                                                    $query2 = "SELECT * FROM user ORDER BY userId ASC";;
                                                    $selectstuff = $db->link->query($query2);
                                                    if ($selectstuff) {
                                                        while ($getstuff=$selectstuff->fetch_assoc()) 
                                                        { 
                                                            if(($getstuff['userId'] == '000000') ||  ($getstuff['userId'] == '190402')){
                                                            continue;
                                                        }else{
                                                ?>
                                                <option value="<?php echo $getstuff['userId']; ?>">
                                                    <?php echo $getstuff['name']; ?>
                                                </option>
                                                <?php }
                                                        }
                                                        }
                                                    
                                                        else{
                                                        
                                                    }
                                                ?>

                                            </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">
                                        CONTACT NO-1. <span class="symbol required"></span>
                                    </label>
                                    <input type="text" required class="form-control" name="upContact1" id="contact1" value="" disabled>
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
                    <input type="submit" value="UPDATE AGENT INFO" class="btn btn-sm btn-success btn-block">
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
