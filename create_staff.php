<?php include('includes/header.php'); 
error_reporting(E_ALL);

//if (isset($_POST['submit'])) {
//$createStuffs = $Stuffset->insertStuff($_POST);
//}

$getUserId = new Database();

$db = new Database();

// Designation Query Start

$designationQuery = "SELECT * FROM user_rule WHERE status=1";    
$ruleResult = $db->select($designationQuery);

// $employeeList = "SELECT *FROM user  WHERE status = '1' ORDER BY id DESC LIMIT 5";
$employeeList = "SELECT user.*, user_rule.ruleName FROM user INNER JOIN user_rule ON user.rule = user_rule.ruleId WHERE user.status = '1' ORDER BY user.id DESC LIMIT 5";
$employeeListResult = $db->link->query($employeeList);


//$query = "SELECT id FROM user ORDER BY id DESC LIMIT 1";
//$result = $getUserId->select($query);
//
//while($row = $result->fetch_assoc()){
//    $lastId = $row['id']+1;
//}
//
//$yearMonth = date('y').date('m');
//$companyId = "SC";
//
//if($lastId < 10){
//    $lastId = '0'.$lastId;
//}

$branch = "SELECT * FROM tbl_branch";
$branchList = $db->select($branch);


// Designation Query End


/*
$dashboardMenuQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='dashboard'";
$dashboardMenuCount = $db->count($dashboardMenuQuery);


$creationMenuQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='creation-area'";
$creationMenuCount = $db->count($creationMenuQuery);

*/


?>

<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>

    <div class="main-content">

        <div class="container"><br><br>
            <div id="printSuccess"></div>
            <form action="#" role="form" id="staff_form" method="POST">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-12">

                        <div class="panel panel-default">
                            <div class="panel-heading bdOrange">
                                <i class="fa fa-external-link-square"></i> CREATE NEW STAFF
                                <!--                                <div class="panel-tools"><a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a><a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal"><i class="fa fa-wrench"></i></a><a class="btn btn-xs btn-link panel-refresh" href="#"><i class="fa fa-refresh"></i></a><a class="btn btn-xs btn-link panel-expand" href="#"><i class="fa fa-resize-full"></i></a></div>-->
                            </div>


                            <div class="panel-body borderOrange">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="userid" class="control-label">
                                                Date of Joining <span class="symbol required"></span>
                                            </label>
                                            <input type="text" required class="form-control" name="joinDate" id="joinDate" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="userid" class="control-label">
                                                Employee ID <span class="symbol required"></span>
                                            </label>
                                            <input type="text" required class="form-control" name="staffRegId" id="userid2" value="">
<!--                                            <input type="hidden" class="form-control" name="staffRegId" id="userid" value="">-->
                                        </div>
                                    </div>


                                </div>



                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="userRegName" class="control-label">
                                                Employee Name <span class="symbol required"></span>
                                            </label>
                                            <input type="text" class="form-control" name="userRegName" id="userRegName" value="" required>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="usermail" class="control-label">
                                                Employee Email <span class="symbol required"></span>
                                            </label>
                                            <input type="email" class="form-control" name="usermail" id="usermail" value="" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="address" class="control-label">
                                                Employee Address <span class="symbol required"></span>
                                            </label>
                                            <input type="text" name="address" id="address" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">
                                                Employee Contact1<span class="symbol required"></span>
                                            </label>
                                            <input type="number" required class="form-control" name="contactOne" id="stuffcontact1" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">
                                                Employee Contact2<span class="symbol"></span>
                                            </label>
                                            <input type="number" class="form-control" name="contactTwo" id="stuffcontact2" value="">
                                        </div>
                                    </div>
                                
                                    <div class="col-md-3">
                                        <div class="form-group connected-group">
                                            <label class="control-label">Password <span class="symbol required"></span>
                                            </label>
                                            <input type="Password" name="stuffPassword" id="userPassword" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">
                                                Designation <span class="symbol required"></span>
                                            </label>
                                            <select name="stuffRole" id="stuffRole" class="form-control" required>
                                                <option value="">Select Rule</option>
                                                <?php
                                                 while($ruleRow = $ruleResult->fetch_assoc()){

                                                     if(($ruleRow['ruleId'] != 1) && ($ruleRow['ruleId'] != 2))
                                                     {
                                                     ?>

                                                <option value="<?php echo $ruleRow['ruleId']; ?>"><?php echo $ruleRow['ruleName']; ?></option>
                                                <?php
                                                             }
                                                     }
                                                    ?>


                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">
                                                Branch Name<span class="symbol required"></span>
                                            </label>
                                            <select name="branchName" id="branchName" class="form-control" required>
                                                <option value="0" selected>N/A</option>
                                                <?php
                                                 while($row = $branchList->fetch_assoc()){
                                                ?>

                                                <option value="<?php echo $row['branch_id']; ?>"><?php echo $row['branch_name']; ?></option>
                                                <?php                                                           
                                                 }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                </div><br>

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
            </form>

            <div class="row">
                <div class="col-md-12">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            LAST 05 EMPLOYEES
                        </div>

                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover table-full-width" id="brnachtbl">

                                <thead>
                                    <tr>
                                        <th>EMPLOYEE ID</th>
                                        <th>NAME</th>
                                        <th>DESIGNATION</th>
                                        <th>EMAIL</th>
                                        <th>CONTACT</th>
                                        <th>JOINING DATE</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php $i=0; if ($employeeListResult) { while ($row=$employeeListResult->fetch_assoc()) {
                                          ?>
                                    <tr>
                                        <td><?php echo $row['userId']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['ruleName']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['contact1']; ?></td>
                                        <td><?php echo $row['joining_date']; ?></td>
                                    </tr>
                                    <?php } } ?>

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
<!--
<script type="text/javascript">
    jQuery(document).ready(function($) {

        // data table with pdf csv excel print copy
        table = $('#stufftbl').DataTable({

            // paging: false,
            // info: false,
            //  dom: 'Bfrtip',
            //       buttons: [
            //           'copy', 'csv', 'excel', 'pdf', 'print'
            //       ]
        });


    })

</script>
-->
