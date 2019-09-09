<?php 
include('includes/header.php'); 
//include('classes/Agent.php'); 
error_reporting(E_ALL);
    
//    $agentName = "SELECT *FROM agent";
//    $agentName2 = $db->link->query($agentName);
//
//    $stafftName = "SELECT *FROM user where status = '1'";
//    $staffName2 = $db->link->query($stafftName);
//
    $query = "SELECT *FROM districts order by name ASC";
    $district = $db->link->query($query);
//
//    $query2 = "SELECT *FROM districts order by district_name ASC";
//    $district2 = $db->link->query($query2);
    

    $query2 = "SELECT * FROM  biogas_plant order by id DESC";
    $plantList = $db->link->query($query2);

?>
<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>

    <div class="main-content">

        <div class="container"><br><br>

            <div class="row">
                <div class="col-md-12">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            BIO-GAS PLANT LIST
                        </div>

                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover table-full-width" id="plantTable">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">PLANT ID.</th>
                                        <th style="text-align:center">DISBURSEMENT No.</th>
                                        <th style="text-align:center">OWNER NAME</th>
                                        <th style="text-align:center">NID</th>
                                        <th style="text-align:center">DOB</th>
                                        <th style="text-align:center">AMOUNT</th>
                                        <th style="text-align:center">DATE</th>
                                        <th style="text-align:center">UPDATE</th>
                                        <th style="text-align:center">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                                    $i = 1;
                                    while ($row = $plantList->fetch_assoc()) 
                                        {
                                    ?>
                                    <tr>
                                        <td style="text-align:center"><?php echo $row['plant_no']; ?></td>
                                        <td style="text-align:center"><?php echo $row['disbursement_no']; ?></td>
                                        <td style="text-align:center"><?php echo $row['plant_owner_name']; ?></td>
                                        <td style="text-align:center"><?php echo $row['nid']; ?></td>
                                        <td style="text-align:center"><?php echo $row['dob']; ?></td>
                                        <td style="text-align:center"><?php echo $row['offered_amount']; ?></td>
                                        <td style="text-align:center"><?php echo $row['entry_date']; ?></td>

                                        <?php $st =  $row['status']; 
                                        
                                            if($st == 0){
                                                $status = "Rejected";
                                                ?>
                                        <td style="text-align:center" ;><button type="button" class="btn btn-xs btn-teal editPlantBtn" data-toggle="modal" data-target="#plantEditModal" id="<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></button>
                                        </td>
                                        <?php
                                            }else if($st == 1){
                                                $status = "Under Construction";
                                                ?>
                                        <td style="text-align:center" ;><button type="button" class="btn btn-xs btn-teal editPlantBtn" data-toggle="modal" data-target="#plantEditModal" id="<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></button>
                                        </td>
                                        <?php
                                                
                                            }else if($st == 2){
                                                $status = "Report Submitted";
                                                ?>
                                        <td style="text-align:center" ;><button type="button" class="btn btn-xs btn-teal editPlantBtn" data-toggle="modal" data-target="#plantEditModal" id="<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></button>
                                        </td>
                                        <?php
                                            }else if($st == 3){
                                                $status = "Completed";
                                                ?>
                                        <td style="text-align:center" ;><button type="button" class="btn btn-xs btn-teal editPlantBtn" data-toggle="modal" data-target="#plantEditModal" id="<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></button>
                                        </td>
                                        <?php
                                            }
                                        
                                        ?>
                                        <td style="text-align:center"><?php echo $status; ?></td>
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

                <!-- end: FORM VALIDATION 1 PANEL -->
            </div>
        </div>
    </div>

</div>
<!--Start Modal code for editing Plant information-->
<div class="">
    <div class="modal modal-dialog modal-lg fade" id="plantEditModal" role="dialog">

        <!-- Modal content-->
        <div class="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Plant Information</h4>
            </div>
            <div class="modal-body">
                <form action="" id="updatePlantInformation">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">
                                        Plant Date <span class="symbol required"></span>
                                    </label>
                                    <input type="text" required class="form-control" name="modalPlantDateName" id="modalPlantDateId" value="" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">
                                        Plant ID
                                    </label>
                                    <input type="text" class="form-control" name="modalPlantIdName" id="modalPlantId" value="">
                                    <input type="hidden" class="form-control" name="hiddenModalPlantTableIdName" id="hiddenModalPlantTableId" value="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">
                                        Dis. No.
                                    </label>
                                    <input type="text" class="form-control" name="modalDisbursementNoName" id="modalDisbursementNoId" value="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">
                                        Name
                                    </label>
                                    <input type="text" required class="form-control" name="modalPlantOwnerName" id="modalPlantOwnerId" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">
                                        NID
                                    </label>
                                    <input type="text" class="form-control" name="modalNidName" id="modalNidId">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">
                                        DOB
                                    </label>
                                    <input type="date" class="form-control" name="modalDobName" id="modalDobId" value="">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">
                                        Contact No.
                                    </label>
                                    <input type="text" required class="form-control" name="modalContactName" id="modalContactId">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">
                                        District
                                    </label>
                                    <select name="modalDistrictName" id="modalDistrictId" class="form-control" data-show-subtext="true" data-live-search="true" disabled>
                                        <option value="">--</option>
                                        <?php
                                                                        while($row = $district->fetch_assoc()){
                                                                        ?>
                                        <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                                        <?php
                                                                        }
                                                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">
                                        Assigned By <span class="symbol required"></span>
                                    </label>
                                    <select name="modalPlantAssignByName" id="modalPlantAssignById" class="form-control" data-show-subtext="true" data-live-search="true" disabled>
                                        <option value="" selected>--</option>
                                        <option value="agent">Agent</option>
                                        <option value="companyStaff">Company Staff</option>
                                        <option value="self">Self</option>
                                        <option value="others">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div id="agentSection" style="display:block">
                                <div class="col-md-3">
                                    <div class="form-group" id="selectPlantAssignee">
                                        <label class="control-label">
                                            Name <span class="symbol required"></span>
                                        </label>
                                        <input type="text" class="form-control" name="modalAgentName" id="modalAgentId" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">
                                            Offered Ammount <span class="symbol"></span>
                                        </label>
                                        <input type="text" class="form-control" name="modalOfferedAmountName" id="modalOfferedAmountId" disabled>
                                    </div>
                                </div>
                            </div>




                            <!--Others section-->
                            <div id="othersSection" style="display:block">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">
                                            Update Status <span class="symbol required"></span>
                                        </label>
                                        <select name="modalUpdateStatusName" id="modalUpdateStatusId" class="form-control" data-show-subtext="true" data-live-search="true">
                                            <option value="1">Under Construction</option>
                                            <option value="2">Report Submitted</option>
                                            <option value="3">Completed</option>
                                            <option value="0">Reject</option>
                                        </select>
                                    </div>
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
