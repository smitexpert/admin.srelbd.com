<?php 
include('includes/header.php');
	$query = "SELECT * FROM accounts ORDER BY id ASC";
    $result = $db->select($query);

    $id = 1;
?>
<!-- start: MAIN CONTAINER -->
<div class="main-container">
    <?php include('includes/sidebar-menu.php'); ?>
    <!-- start: PAGE -->
    <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container"><br><br>
            <!-- end: PAGE HEADER -->
            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            INCOME STATEMENT WINDOW
                        </div>

                        <div class="panel-body">
                            <table id="totalStatement" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">SL</th>
                                        <th style="text-align:center">Trn. Date</th>
                                        <th style="text-align:center">Money Receipt No.</th>
                                        <th style="text-align:center">Reference No.</th>
                                        <th style="text-align:center">Name</th>
                                        <th style="text-align:center">Description</th>
                                        <th style="text-align:center">Payment Mode</th>
                                        <th style="text-align:center">Credit</th>
                                        <th style="text-align:center">Debit</th>
                                        <th style="text-align:center">Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            $balance = 0;
                                            if($result){
                                                while($row = $result->fetch_assoc()){
                                                
                                                if($row['transaction_type'] == "credit"){
                                                    $balance = $balance + $row['amount'];
                                                }else{                                                    
                                                    $balance = $balance - $row['amount'];
                                                }
                                            ?>

                                    <tr>
                                        <td style="text-align:center"><?php echo $id; ?></td>
                                        <td style="text-align:center"><?php echo $row['transaction_date'] ?></td>
                                        <td style="text-align:center"><?php echo $row['money_receipt_no'] ?></td>
                                        <td style="text-align:center"><?php echo $row['reference_no'] ?></td>
                                        <td style="text-align:center"><?php echo $row['payer_name'] ?></td>
                                        <td style="text-align:center"><?php echo $row['description'] ?></td>
                                        <td style="text-align:center"><?php echo $row['payment_mode'] ?></td>

                                        <?php
                                            if($row['transaction_type'] == "credit"){
                                        ?>
                                        <td style="text-align:right"><?php echo number_format($row['amount'], 2); ?></td>
                                        <td style="text-align:center"><?php echo "---" ?></td>
                                        <?php
                                            }else{?>
                                        <td style="text-align:center"><?php echo "---"; ?></td>
                                        <td style="text-align:right"><?php echo number_format($row['amount'], 2); ?></td>
                                        <?php
                                        }
                                                if($balance < 0){
                                        ?>

                                        <td style="text-align:right; color:red;font-weight:bold"><?php echo number_format($balance, 2); ?></td>
                                        <?php
                                            }else{
                                        ?>
                                        <td style="text-align:right; font-weight:bold"><?php echo number_format($balance, 2); ?></td>
                                        <?php
                                                }
                                        ?>
                                    </tr>

                                    <?php
                                                $id++;
                                            }
                                                
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
        <!-- end: PAGE CONTENT-->
    </div>
</div>
<!-- end: PAGE -->



<!-- end: MAIN CONTAINER -->


<?php 
include('includes/footer.php');
?>
