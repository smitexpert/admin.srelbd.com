<?php 
include('includes/header.php'); 

$emplyeeList = "SELECT *FROM user WHERE status = '1'";
$empList = $db->link->query($emplyeeList);



?>

<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>


    <!-- start: PAGE -->
    <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container"><br>
            <!-- end: PAGE HEADER -->
            <!-- end: PAGE HEADER -->
            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-12">
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="viewarea">
                                <div class="viewsec" id="CORPORATEVIEW">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <i class="fa fa-external-link-square"></i>
                                            CREATE SALARY CERTIFICATE
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="corporate_form_view">
                                                        <br>
                                                        <br>
                                                        <form method="POST" id="accounts_credit" >
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Reference No:<span class="symbol required"></span></label>
                                                                        <input type="text" class="form-control" name="referenceno" id="referenceno" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4"></div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Date:</label>
                                                                        <input type="date" class="form-control" name="create_date" id="create_date" value="<?php echo date("Y-m-d"); ?>" required>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label for="">Employee Name:<span class="symbol required"></span></label>
                                                                        <select class="form-control" name="employee_name">
                                                                            <option value="" selected>Select Employee</option>
                                                                            <?php
                                                                            if($empList){
                                                                                while($row = $empList->fetch_assoc()){
                                                                                    ?>
                                                                                    <option value="<?php echo $row['userId']; ?>"><?php
                                                                                    echo $row['name'];    ?></option>
                                                                                    <?php
                                                                                }
                                                                            }else{
                                                                            }
                                                                            ?>        
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label for="">Basic Salary<span class="symbol required"></span></label>
                                                                        <input type="text" class="form-control" name="basicSalary" id="basicSalary" min="0" required>
                                                                    </div>
                                                                </div><div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label for="">House Rent<span class="symbol required"></span></label>
                                                                        <input type="text" class="form-control" name="basicSalary" id="basicSalary" min="0" required>
                                                                    </div>
                                                                </div><div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label for="">Medical<span class="symbol required"></span></label>
                                                                        <input type="text" class="form-control" name="basicSalary" id="basicSalary" min="0" required>
                                                                    </div>
                                                                </div><div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label for="">Transport<span class="symbol required"></span></label>
                                                                        <input type="text" class="form-control" name="basicSalary" id="basicSalary" min="0" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label for="">Gross Salary</label>
                                                                        <input type="text" class="form-control" name="grossSalary" id="grossSalary">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <br>
                                                                    <input type="hidden" name="payer_type" value="corporate">
                                                                    <input type="hidden" name="client_id" id="client_id">
                                                                    <button class="btn btn-green btn-block" type="submit">SUBMIT</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-1"></div>
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
