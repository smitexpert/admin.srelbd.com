<?php 
ob_start();
require __DIR__."/classes/Admin.php";
$objadmin=new Admin();

if (isset($_POST['submit'])) {
	 $userId=$_POST['userid'];
    
    if (!filter_var($userId, FILTER_VALIDATE_EMAIL)) {
         $password = md5($_POST['password']);
         $adminlog = $objadmin->adminLogin($userId, $password);
        }else{
            $password = md5($_POST['password']);
            $adminlog = $objadmin->clientLogin($userId, $password);
        }
    
    
}
?>
<!DOCTYPE html>
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- start: HEAD -->

<head>
    <title>Success Reneable Energy Ltd</title>
    <!-- start: META -->
    <meta charset="utf-8" />
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- end: META -->
    <!-- start: MAIN CSS -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/style.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- <link rel="stylesheet" href="assets/css/main-responsive.css"> -->
    <link rel="stylesheet" href="assets/plugins/iCheck/skins/all.css">
    <!-- <link rel="stylesheet" href="assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css"> -->
    <!-- <link rel="stylesheet" href="assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
		<link rel="stylesheet" href="assets/css/theme_light.css" type="text/css" id="skin_color">
		<link rel="stylesheet" href="assets/css/print.css" type="text/css" media="print"/> -->
    <!--[if IE 7]>
		<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
		<![endif]-->
    <!-- end: MAIN CSS -->
    <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
    <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
</head>

<body class="login example2">
    <div class="main-login col-sm-4 col-sm-offset-4">
        <div style="font-size: 20px" class="logo"><i class="clip-clip"></i> Success Biogas
        </div>
        <!-- start: LOGIN BOX -->
        <div class="box-login">
            <h3 style="margin-top: 10px;" class="text-center">Login</h3>
            <!-- <p>
					Please enter your name and password to go dashboard.
				</p> -->
            <form method="POST" class="form-login" action="index.php">
                <div class="errorHandler alert alert-danger no-display">
                    <i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
                </div>

                <?php if (isset($adminlog)){ ?>
                <div class="login-erro" style="color: #f00; font-size: 12px;  text-align: center">
                    <?php echo $adminlog;  ?>
                </div>
                <?php } ?>

                <fieldset>
                    <div class="form-group">
                        <span class="input-icon">
                            <input style="font-size: 12px; padding-left: 24px !important;" type="text" class="form-control" name="userid" placeholder="Userid" required>
                            <i class="fa fa-user" style="margin-top: -5px;"></i> </span>
                    </div>
                    <div class="form-group form-actions">
                        <span class="input-icon">
                            <input style="font-size: 12px; padding-left: 24px !important;" type="password" required class="form-control password" name="password" placeholder="Password">
                            <i class="fa fa-lock" style="margin-top: -5px;"></i>
                            <!--<a class="forgot" href="#">
                                                            Forgot Password?
                                                        </a> --></span>
                    </div>
                    <div class="form-actions">
                        <!--<label for="remember" class="checkbox-inline">
								<input type="checkbox" class="grey remember" id="remember" name="remember">
								Keep me signed in
							</label>-->
                        <button type="submit" name="submit" class="btn btn-success pull-right" style="width: 30%;">
                            Login<!--  <i class="fa fa-arrow-circle-right"> </i>-->
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>
        <!-- end: LOGIN BOX -->
        <!-- start: FORGOT BOX -->
        <div class="box-forgot">
            <h3>Forget Password?</h3>
            <p>
                Enter your e-mail address below to reset your password.
            </p>
            <form class="form-forgot">
                <div class="errorHandler alert alert-danger no-display">
                    <i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
                </div>
            </form>
        </div>

        <div class="copyright"><?php echo date('Y') ?> &copy; Success Renewable Energy Ltd 
        </div>
        <!-- end: COPYRIGHT -->
    </div>
    <!-- start: MAIN JAVASCRIPTS -->
    <!--[if lt IE 9]>
		<script src="assets/plugins/respond.min.js"></script>
		<script src="assets/plugins/excanvas.min.js"></script>
		<script type="text/javascript" src="assets/plugins/jQuery-lib/1.10.2/jquery.min.js"></script>
		<![endif]-->
    <!--[if gte IE 9]><!-->
    <script src="assets/plugins/jQuery-lib/2.0.3/jquery.min.js"></script>
    <!--<![endif]-->
    <script src="assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script> -->
    <!-- <script src="assets/plugins/blockUI/jquery.blockUI.js"></script> -->
    <script src="assets/plugins/iCheck/jquery.icheck.min.js"></script>
    <!-- <script src="assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script> -->
    <script src="assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
    <!-- <script src="assets/plugins/less/less-1.5.0.min.js"></script> -->
    <script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>
    <!-- <script src="assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script> -->
    <script src="assets/js/main.js"></script>
    <!-- end: MAIN JAVASCRIPTS -->
    <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script src="assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="assets/js/login.js"></script>
    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script>
        jQuery(document).ready(function() {
            Main.init();
            Login.init();
        });

    </script>
</body>
<!-- end: BODY -->

</html>
