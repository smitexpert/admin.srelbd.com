<?php 
include('includes/header_change_pass.php'); 

function getName($id){
    $db = new Database();
    //get user name using employee id
    $getEmployeeName = "SELECT name, rule FROM user where userId = '$id'";
    $getName1 = $db->link->query($getEmployeeName);
    
    $row = $getName1->fetch_row();
    return $row[0];
}

?>


<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>

    <br>
    <!-- start: PAGE -->
    <div class="main-content">
        <div class="container">
            <form action="#" id="submitButtonForm">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3" style="margin-top:80px">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-external-link-square"></i>
                                CHANGE PASSWORD OF <strong><?php echo getName($userId); ?></strong>
                            </div>
                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="" class="control-label">OLD PASSWORD:<span class="symbol required"></span></label>
                                            <input type="password" class="form-control" name="oldPass" id="oldPass" required>
                                            <div id="checkMark" style="position: absolute;top: 27px;right: 22px;color: green; display:none"><span class="fa fa-check"></span></div>
                                            <div id="closeMark" style="position: absolute;top: 27px;right: 22px;color: red; display:none"><span class="fa fa-times"></span></div>
                                        </div>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="">NEW PASSWORD:<span class="symbol required"></span></label>
                                            <input type="password" class="form-control" name="newPass" id="newPass" required>
                                            <span id="checkNewPass"></span>
                                            <div id="checkMarkNew" style="position: absolute;top: 27px;right: 22px;color: green; display:none"><span class="fa fa-check"></span></div>
                                            <div id="closeMarkNew" style="position: absolute;top: 27px;right: 22px;color: red; display:none"><span class="fa fa-times"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="">CONFIRM PASSWORD:<span class="symbol required"></span></label>
                                            <input type="password" class="form-control" name="confirmPass" id="confirmPass" required>
                                            <div id="checkMarkConfirm" style="position: absolute;top: 27px;right: 22px;color: green; display:none"><span class="fa fa-check"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="text-align:center; color:green">
                                    <div id="success" style="dispaly:none">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4" style="float:right">
                                        <br>
                                        <button id="submitButton" class="btn btn-green btn-block" type="submit" disabled>SUBMIT</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end: PAGE -->
<!-- end: MAIN CONTAINER -->


<?php 
include('includes/footer.php');
?>
