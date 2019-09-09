<?php include('includes/header.php'); 



/*if (isset($_POST['submit'])) {
$createStuffs = $Stuffset->insertStuff($_POST);
}*/

/*if(isset($_POST['clientname'])){
    $clientname = $_POST['clientname'];
    $clientID = Session::get('ClientID');
    $upSQL = "UPDATE corporate_clients SET name='$clientname' WHERE id='$clientID'";
    $upResult = $db->link->query($upSQL);
    $self = $_SERVER['PHP_SELF'];
    if($upResult){
        Session::set('ClientName', $clientname);
        header('location: '.$self.'?success');
    }else{
        header('location: '.$self.'?error');
    }
}*/

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

            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" role="form" id="staff_form" method="POST">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">

                        <div class="row">
                            <?php
                                        if(isset($_GET['success'])){
                                            ?>
                            <div class="alert alert-success">
                                <strong>Success!</strong> Your Name is Update!
                            </div>
                            <?php
                                        }else if(isset($_GET['error'])){
                                             ?>
                            <div class="alert alert-danger">
                                <strong>Error!</strong> Something Error!
                            </div>
                            <?php
                                        }
                                    ?>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading bdOrange">
                                Name Update Form
                            </div>


                            <div class="panel-body">



                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="userid" class="control-label">
                                                Current Name
                                            </label>
                                            <input type="text" required class="form-control" name="staffRegId" id="userid" value="<?php echo Session::get('ClientName'); ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="userRegName" class="control-label">
                                                New Name <span class="symbol required"></span>
                                            </label>
                                            <input type="text" class="form-control" name="clientname" id="clientname" value="" required>
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
include('includes/footer.php');
?>
