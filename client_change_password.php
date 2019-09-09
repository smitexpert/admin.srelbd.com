<?php include('includes/clientheader.php'); 
error_reporting(E_ALL);
/*if (isset($_POST['submit'])) {
$createStuffs = $Stuffset->insertStuff($_POST);
}*/

if(isset($_POST['currentpass'])){
    $currentpass = md5($_POST['currentpass']);
    $newpass = $_POST['newpass'];
    $confirmpass = $_POST['confirmpass'];
    
    $client_id = Session::get('ClientID');
    $self = $_SERVER['PHP_SELF'];
    $sl = "SELECT password FROM corporate_clients WHERE id='$client_id'";
    $rl = $db->link->query($sl);
    $pasRow = $rl->fetch_row();
    $pass = $pasRow[0];
    if($pass == $currentpass){
        if($newpass == $confirmpass){
            $uppass = md5($newpass);
            $sql = "UPDATE corporate_clients SET password='$uppass' WHERE id='$client_id'";
            $result = $db->link->query($sql);
            if($result){
                header("location: ".$self."?success=Password Updated!");
            }
        }else{
            header("location: ".$self."?error=Wrong Confirm Password");
        }
    }else{
        header("location: ".$self."?error=Wrong Password");
    }
}

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

    <?php include('includes/client-sidebar-menu.php'); ?>

    <div class="main-content">

        <div class="container"><br><br>

            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" role="form" id="staff_form" method="POST">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">

                        <div class="row">
                            <?php
                                        if(isset($_GET['success'])){
                                            ?>
                            <div class="alert alert-success">
                                <strong>Success!</strong> <?php echo $_GET['success']; ?>
                            </div>
                            <?php
                                        }else if(isset($_GET['error'])){
                                             ?>
                            <div class="alert alert-danger">
                                <strong>Error!</strong> <?php echo $_GET['error']; ?>
                            </div>
                            <?php
                                        }
                                    ?>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading bdOrange">
                                Password Update Form
                            </div>


                            <div class="panel-body">



                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="userid" class="control-label">
                                                Current Password
                                            </label>
                                            <input minlength="6" type="password" required class="form-control" name="currentpass" id="currentpass" value="" placeholder="Current Password">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="userRegName" class="control-label">
                                                New Password <span class="symbol required"></span>
                                            </label>
                                            <input minlength="6" type="password" class="form-control" name="newpass" id="newpass" value="" placeholder="New Password" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="userRegName" class="control-label">
                                                Confirm Password <span class="symbol required"></span>
                                            </label>
                                            <input minlength="6" type="password" class="form-control" name="confirmpass" id="confirmpass" value="" placeholder="Confirm Password" required>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                </div><br>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group connected-group">
                                            <input class="btn btn-lg btn-warning btn-block" type="submit" name="submit" value="submit">
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>

                    </div>
                    <div class="col-md-2"></div>
                </div>
            </form>
        </div>
    </div>

</div>



<?php 
include('includes/clientfooter.php');
?>
