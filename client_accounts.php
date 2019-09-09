<?php include('includes/clientheader.php'); 
error_reporting(E_ALL);
/*if (isset($_POST['submit'])) {
$createStuffs = $Stuffset->insertStuff($_POST);
}*/

if(isset($_POST['clientname'])){
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
            <div class="row">
                <div class="col-sm-12">

                    <!-- start: PAGE TITLE & BREADCRUMB -->
                    
                    <div class="page-header" style="text-align: center;">
                        <h1 style="font-weight: bold">Accounts At Glance</h1>
                    </div>
                    <!-- end: PAGE TITLE & BREADCRUMB -->
                </div>
            </div>
            <!-- end: PAGE HEADER -->
            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-sm-8">
                    <div class="row space12">


                        <ul class="mini-stats col-sm-12">
                            <li class="col-sm-4">
                                <div class="sparkline_bar_good">
                                    <!-- <span>3,5,9,8,13,11,14</span>+10% -->
                                    <i class="clip-user-4 circle-icon circle-green"></i>
                                </div>
                                <div class="values">
                                    <strong>0</strong>
                                    Total Consignment
                                </div>
                            </li>

                            <li class="col-sm-4">
                                <div class="sparkline_bar_bad">
                                    <!-- <span>4,6,10,8,12,21,11</span>+50% -->
                                    <i class="clip-user-2 circle-icon circle-green"></i>
                                </div>
                                <div class="values">
                                    <strong>0</strong>
                                    Total Delivered
                                </div>
                            </li>
                            <li class="col-sm-4">
                                <div class="sparkline_bar_neutral">
                                    <!-- <span>20,15,18,14,10,12,15,20</span>0% -->
                                    <i class="clip-user-5 circle-icon circle-green"></i>
                                </div>
                                <div class="values">
                                    <strong>0</strong>
                                    Total Consignments Charge
                                </div>
                            </li>

                        </ul>




                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-sm-8">
                    <div class="row space12">


                        <ul class="mini-stats col-sm-12">
                            <li class="col-sm-4">
                                <div class="sparkline_bar_good">
                                    <!-- <span>3,5,9,8,13,11,14</span>+10% -->
                                    <i class="clip-user-4 circle-icon circle-green"></i>
                                </div>
                                <div class="values">
                                    <strong>0</strong>
                                    Total Consignment
                                </div>
                            </li>

                            <li class="col-sm-4">
                                <div class="sparkline_bar_bad">
                                    <!-- <span>4,6,10,8,12,21,11</span>+50% -->
                                    <i class="clip-user-2 circle-icon circle-green"></i>
                                </div>
                                <div class="values">
                                    <strong>0</strong>
                                    Total Delivered
                                </div>
                            </li>
                            <li class="col-sm-4">
                                <div class="sparkline_bar_neutral">
                                    <!-- <span>20,15,18,14,10,12,15,20</span>0% -->
                                    <i class="clip-user-5 circle-icon circle-green"></i>
                                </div>
                                <div class="values">
                                    <strong>0</strong>
                                    Total Consignments Charge
                                </div>
                            </li>

                        </ul>




                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>

</div>



<?php 
include('includes/clientfooter.php');
?>
