<?php 
include('includes/header.php'); 

//query for idcol subsidy

$idcolSubsidy = "SELECT SUM(amount) from accounts WHERE description = 'IDCOL'";
$getSubsidy = $db->link->query($idcolSubsidy);
$getTotal = $getSubsidy->fetch_row();

$idcolSubsidyTotal = $getTotal[0];


?>


<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>

    <br>
    <!-- start: PAGE -->
    <div class="main-content">
        <div class="container">
            <!-- start: PAGE HEADER -->
            <div class="row">
                <div class="col-sm-12">

                    <!-- start: PAGE TITLE & BREADCRUMB -->
                    
                    <div class="page-header" style="text-align: center;">
                        <h2 style="font-weight: bold">ACCOUNTS AT A GLANCE</h2>
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
                                    <strong></strong>
                                    IDCOL SUBSIDY<br><strong><?php echo number_format($idcolSubsidyTotal,2); ?></strong>
                                </div>
                            </li>

                            <li class="col-sm-4">
                                <div class="sparkline_bar_bad">
                                    <!-- <span>4,6,10,8,12,21,11</span>+50% -->
                                    <i class="clip-user-2 circle-icon circle-green"></i>
                                </div>
                                <div class="values">
                                    <strong></strong>
                                    PRODUCT SELL
                                </div>
                            </li>
                            <li class="col-sm-4">
                                <div class="sparkline_bar_neutral">
                                    <!-- <span>20,15,18,14,10,12,15,20</span>0% -->
                                    <i class="clip-user-5 circle-icon circle-green"></i>
                                </div>
                                <div class="values">
                                    <strong></strong>
                                    FINES / PENALTY
                                </div>
                            </li>

                        </ul>




                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
            <hr>
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
                                    <strong></strong>

                                    <strong></strong>
                                    TOTAL INCOME
                                </div>
                            </li>
                            <li class="col-sm-4">
                                <div class="sparkline_bar_neutral">
                                    <!-- <span>20,15,18,14,10,12,15,20</span>0% -->
                                    <i class="clip-user-5 circle-icon circle-green"></i>
                                </div>
                                <div class="values">
                                    <strong></strong>
                                    TOTAL COST
                                </div>
                            </li>
                            <li class="col-sm-4">
                                <div class="sparkline_bar_bad">
                                    <!-- <span>4,6,10,8,12,21,11</span>+50% -->
                                    <i class="clip-user-2 circle-icon circle-green"></i>
                                </div>
                                <div class="values">
                                    <strong></strong>
                                    BALANCE
                                </div>
                            </li>
                        </ul>




                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
            <hr>


            <!-- SUMMERY PORTION END -->



            <!-- end: PAGE CONTENT-->
        </div>
    </div>
    <!-- end: PAGE -->
</div>
<!-- end: MAIN CONTAINER -->


<?php 
include('includes/footer.php');
?>
