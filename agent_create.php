<?php 
include('includes/header.php'); 
	
if (isset($_POST['submit'])) {
    
    $agent_name = $_POST['agent_name'];
    $agent_address = $_POST['agent_address'];
    $agent_email = $_POST['agent_email'];
    $agent_contact1 = $_POST['agent_contact1'];
    $agent_contact2 = $_POST['agent_contact2'];
    $assignTo = $_POST['corpoAssignTo'];
    $created_by = Session::get('adminId');
    
    $insert = "INSERT INTO agent (name, address, email, contact1, contact2, assignto, create_by) VALUES ('$agent_name', '$agent_address', '$agent_email', '$agent_contact1', '$agent_contact2', '$assignTo', '$created_by')";
    
    $query = $db->link->query($insert);
    
    if($query){
        header("location: agent_create.php");
    }else{
        header("location: agent_create.php");
    }
    // echo $db->link->error;
    
}

    $agentQuery = "SELECT * FROM agent ORDER BY id DESC limit 5";
    $agentQuery = $db->select($agentQuery);


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
                <div class="col-md-12">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            CREATE NEW AGENT
                        </div>
                        <div class="panel-body">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" role="form" id="#" method="POST">
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
                                                Agent Name<span class="symbol required"></span>
                                            </label>
                                            <input type="text" class="form-control" id="agent_name" name="agent_name" required>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label">
                                                Address<span class="symbol required"></span>
                                            </label>
                                            <input type="text" class="form-control" id="agent_address" name="agent_address" required>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label">
                                                Email Address
                                            </label>
                                            <input class="form-control" type="email" id="agent_email" name="agent_email">
                                        </div>




                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="control-label">
                                                Contact1 <i class="symbol required"></i><span style="text-align:right" id="validContact"></span>
                                            </label>
                                            <input type="text"  class="form-control checkContact" name="agent_contact1" id="agent_contact1" onkeyup="CheckAgentContact1(event)"  maxlength="11">
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label">
                                                Contact2
                                            </label>
                                            <input type="text" class="form-control" id="agent_contact2" name="agent_contact2">
                                        </div>

                                        <div class="form-group connected-group">
                                            <label class="control-label">Assign to :<span class="symbol required"></span>
                                            </label>
                                            <select name="corpoAssignTo" id="corpoAssignTo" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" required>
                                                <option value="">--</option>
                                                <?php 
                                                    $query2 = "SELECT * FROM user ORDER BY userId DESC";;
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
                                        </div><br>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="btn btn-md btn-green btn-block" type="submit" name="submit" value="submit" id="agentSubmit">
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
                <div class="col-md-12">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            LAST 05 AGENTS
                        </div>

                        <div class="panel-body">
                            <table id="agentTable2" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Contact1</th>
                                        <th>Contact2</th>
                                        <th>Create Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            if($agentQuery){
                                                $serial = 1;
                                                while($row = $agentQuery->fetch_assoc()){

                                                ?>

                                    <tr>
                                        <td style="text-align:center"><?php echo $serial; ?></td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['address'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td><?php echo $row['contact1'] ?></td>
                                        <td><?php echo $row['contact2'] ?></td>
                                        <td><?php echo $row['created_date'] ?></td>

                                    </tr>

                                    <?php
                                    $serial++;
                                            }}else{
                                                
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
        <!-- end: PAGE -->


    </div>
    <!-- end: MAIN CONTAINER -->


    <?php 
include('includes/footer.php');
?>
