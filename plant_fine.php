<?php include('includes/header.php'); 
error_reporting(E_ALL);
    
    $agentName = "SELECT *FROM agent ORDER BY name ASC";
    $agentName2 = $db->link->query($agentName);

    $stafftName = "SELECT *FROM user where status = '1' ORDER BY name ASC";
    $staffName2 = $db->link->query($stafftName);

    $query = "SELECT *FROM districts ORDER BY name ASC";
    $district = $db->link->query($query);
    $district2 = $db->link->query($query);

    $query2 = "SELECT *FROM police_station ORDER BY name ASC";
    $policeStation = $db->link->query($query2);
    

    $query2 = "SELECT * FROM  biogas_plant WHERE status = '1' ORDER BY id DESC limit 5";
    $plantList = $db->link->query($query2);

    //last id from biogas plant
    $getLastId = "SELECT id FROM biogas_plant ORDER BY id DESC LIMIT 1";
    $getId = $db->link->query($getLastId);
    $row = $getId->fetch_row();

    $lastPlantTableId = $row[0];
    $lastPlantId = $lastPlantTableId + 1;


?>
<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>
    <div class="main-content">
        <div class="container"><br><br>
            <div class="row">
                <div class="col-md-12">
                    <form action="#" id="add_new_plant2" method="POST">
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
                                    <div>
                                        <a href="#" class="close" data-dismiss="alert"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="col-md-12 center-block">
                                    <div class="panel panel-default">
                                        <div class="panel-heading bdOrange">
                                            <i class="fa fa-external-link-square"></i>FINE A PLANT FOR INCOMPLETE
                                            <div class="panel-tools"><a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a><a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal"><i class="fa fa-wrench"></i></a><a class="btn btn-xs btn-link panel-refresh" href="#"><i class="fa fa-refresh"></i></a><a class="btn btn-xs btn-link panel-expand" href="#"><i class="fa fa-resize-full"></i></a></div>
                                        </div>

                                        <div class="panel-body borderOrange">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Plant Date <span class="symbol required"></span>
                                                            </label>
                                                            <input type="date" required class="form-control" name="plantDate" id="plantDate" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Plant ID <span class="symbol required"></span>
                                                            </label>
                                                            <input type="text" class="form-control" name="plantId" id="plantId" value="<?= $lastPlantId; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Disbursement No.
                                                            </label>
                                                            <input type="text" class="form-control" name="disbursementNo" id="disbursementNo" value="">
                                                        </div>
                                                    </div>


                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Plant Owner Name <span class="symbol required"></span>
                                                            </label>
                                                            <input type="text" required class="form-control" name="plantOwnerName" id="plantOwnerName" placeholder="owner of plant">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                NID
                                                            </label>
                                                            <input type="text" class="form-control" name="nid" id="nid">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                DOB
                                                            </label>
                                                            <input type="date" class="form-control" name="dob" id="dob">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Contact No. <span class="symbol required"></span>
                                                            </label>
                                                            <input type="text" required class="form-control" name="contact" id="contact">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                District
                                                            </label>
                                                            <select name="district" id="district" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                                <option>--</option>
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

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Police Station
                                                            </label>
                                                            <select name="policeStation" id="policeStation" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                                <option value="">--</option>
                                                                <?php
                                                                        while($row = $policeStation->fetch_assoc()){
                                                                        ?>
                                                                <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                                                                <?php
                                                                        }
                                                                        ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Union
                                                            </label>
                                                            <input type="text" class="form-control" name="union" id="union">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Village
                                                            </label>
                                                            <input type="text" class="form-control" name="village" id="village">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Others
                                                            </label>
                                                            <input type="text" class="form-control" name="others" id="others">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Plant Assigned By <span class="symbol required"></span>
                                                            </label>
                                                            <select name="plantAssignBy" id="plantAssignByChange" class="form-control" data-show-subtext="false" data-live-search="false" required>
                                                                <option value="" selected>--</option>
                                                                <option value="agent">Agent</option>
                                                                <option value="companyStaff">Company Staff</option>
                                                                <option value="self">Self</option>
                                                                <option value="others">Others</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div id="agentSection" style="display:none">
                                                        <div class="col-md-3">
                                                            <div class="form-group" id="selectPlantAssignee">
                                                                <label class="control-label">
                                                                    Select Agent Name <span class="symbol required"></span>
                                                                </label>
                                                                <select name="agentName2" id="agentName" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                                    <option value="">--</option>

                                                                    <?php
                                                                        while($row = $agentName2->fetch_assoc()){
                                                                        ?>
                                                                    <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                                                                    <?php
                                                                        }
                                                                        ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Offered Ammount <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" name="offeredAmount_agent" id="offeredAmount_agent">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="staffSection" style="display:none">
                                                        <div class="col-md-2">
                                                            <div class="form-group" id="selectPlantAssignee">
                                                                <label class="control-label">
                                                                    Select Staff Name <span class="symbol required"></span>
                                                                </label>
                                                                <select name="stafftName" id="stafftName" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                                    <option value="">--</option>

                                                                    <?php
                                                                        while($row = $staffName2->fetch_assoc()){
                                                                            if($row['id'] == '1' or $row['id'] == '2')
                                                                                continue;
                                                                        ?>
                                                                    <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                                                                    <?php
                                                                        }
                                                                        ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Offered Ammount <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" name="offeredAmount_staff" id="offeredAmount_staff">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" id="selfSection" style="display:none">
                                                        <!--
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">
                                                                        Offered Ammount <span class="symbol required"></span>
                                                                    </label>
                                                                    <input type="text" class="form-control" name="offeredAmount_self" id="offeredAmount_self">
                                                                </div>
                                                            </div>
-->
                                                    </div>


                                                    <!--Others section-->
                                                    <div id="othersSection" style="display:none">
                                                        <div class="col-md-2">
                                                            <div class="form-group" id="selectPlantAssignee">
                                                                <label class="control-label">
                                                                    Enter Name <span class="symbol required"></span>
                                                                </label>
                                                                <input class="form-control" type="text" name="othersName" id="otherName"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group" id="selectPlantAssignee">
                                                                <label class="control-label">
                                                                    Mobile No.
                                                                </label>
                                                                <input class="form-control" type="text" name="othersMobile" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    District
                                                                </label>
                                                                <select name="district_others" id="district_others" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                                    <option value="">--</option>
                                                                    <?php
                                                                        while($row = $district2->fetch_assoc()){
                                                                        ?>
                                                                    <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                                                                    <?php
                                                                        }
                                                                        ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Offered Ammount <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" name="offeredAmount_others" id="offeredAmount_others">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            RECENT PLANT LIST
                        </div>

                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover table-full-width" id="brnachtbl">

                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th>plant_no</th>
                                        <th>plant_owner_name</th>
                                        <th>contact_no</th>
                                        <th>district</th>
                                        <th>assignee_type</th>
                                        <th>assigned_by</th>
                                        <th>offered_amount</th>
                                        <th>entry_date</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                                    $i = 1;
                                    while ($row = $plantList->fetch_assoc()) 
                                        {
                                    ?>
                                    <tr>
                                        <td class="center"><?php echo $i; ?></td>
                                        <td><?php echo $row['plant_no']; ?></td>
                                        <td><?php echo $row['plant_owner_name']; ?></td>
                                        <td><?php echo $row['contact_no']; ?></td>
                                        <td><?php echo $row['district']; ?></td>
                                        <td><?php echo $row['assignee_type']; ?></td>
                                        <td><?php echo $row['assigned_by']; ?></td>
                                        <td><?php echo $row['offered_amount']; ?></td>

                                        <td><?php echo $row['entry_date']; ?></td>
                                        <td>
                                            <a href="#" rel="nofollow" target="_blank">
                                                <?php echo $row['status']; ?>
                                            </a></td>
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



<?php 
include('includes/footer.php');
?>
