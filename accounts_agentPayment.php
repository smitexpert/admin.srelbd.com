<?php 
include('includes/header.php'); 

    $query_1 = "SELECT money_receipt_no FROM accounts order by id DESC limit 1";
    $result_1 = $db->link->query($query_1);

    if($result_1->num_rows > 0){
        $last_serial = $result_1 ->fetch_row();
        $last_serial = substr($last_serial[0],-3);
        if($last_serial <999){
            $last_serial++;
            $last_serial = sprintf("%03d",$last_serial);          
        }else{
            $last_serial = "001";
        }
    }else{
        $last_serial = "001";
    }

    $dayMonthYear = date('d').date('m').date('y');
	$serial = "AD".$dayMonthYear.$last_serial;

//select agent name from agent table
    $getAgent = "SELECT *FROM agent ORDER BY name ASC";
    $agentName = $db->link->query($getAgent);


?>

<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>


    <!-- start: PAGE -->
    <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container"><br>
            <div id="aleret_message" style="display:none">
                <div class="alert alert-success " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Operation Success!</strong>
                </div>
            </div>
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
                                            PAY TO AGENT BY CASH/CHEQUE/MOBILE BANKING
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="corporate_form_view">
                                                        <br>
                                                        <br>
                                                        <form method="POST" id="agent_accounts_debit">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Money Receipt No.<span class="symbol required"></span></label>
                                                                        <input type="text" name="money_receipt_no" id="money_receipt_no" class="form-control" value="<?=$serial ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Reference No:</label>
                                                                        <input type="text" class="form-control" name="reference_no" id="reference_no">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Date:</label>
                                                                        <input type="text" class="form-control" name="agent_date" id="agent_date" value="<?php echo date("d-m-Y"); ?>" required>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Agent Name:<span class="symbol required"></span></label>
                                                                        <select class="form-control" name="agent_id" required>
                                                                            <option value="" selected>Select Agent</option>
                                                                            <?php
                                                                                while($row = $agentName->fetch_assoc()){
                                                                                    ?>
                                                                            <option value="<?php
                                                                                    echo $row['id'];
                                                                                        ?>"><?php
                                                                                    echo $row['name'];
                                                                                        ?></option>
                                                                            <?php
                                                                                }
                                                                            ?>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Amount(BDT):<span class="symbol required"></span></label>
                                                                        <input type="number" step="any" class="form-control" name="agent_amount" id="agent_amount" min="1" required>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group" id="pay_mode">
                                                                        <label for=""><b>Payment Mode:</b></label>&nbsp;
                                                                        <label class="radio-inline"><input id="radio_cash" type="radio" name="payment_mode" value="cash" checked>Cash</label>
                                                                        <label class="radio-inline"><input id="radio_cheque" type="radio" name="payment_mode" value="cheque">Cheque</label>
                                                                        <label class="radio-inline"><input id="radio_mobile" type="radio" name="payment_mode" value="mobile_banking">Mobile Banking</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row" id="payment-mode-cheque" style="display: none" ;>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Cheque No.:<span class="symbol required"></span></label>
                                                                        <input type="text" class="form-control" name="cheque_no" id="cheque_no">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Bank Name:<span class="symbol required"></span></label>
                                                                        <input type="text" class="form-control" name="bank_name" id="bank_name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Mobile No.:<span class="symbol required"></span></label>
                                                                        <input type="text" class="form-control" name="mobile_no" id="mobile_no">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row" id="payment-mode-mobile" style="display: none" ;>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Mobile Account No.:<span class="symbol required"></span></label>
                                                                        <input type="text" class="form-control" name="mobile_account_no" id="mobile_account_no">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Transaction No.:<span class="symbol required"></span></label>
                                                                        <input type="text" class="form-control" name="transaction_no" id="transaction_no">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Company Name:</label>
                                                                        <select class="form-control" name="mobile_bank_name">
                                                                            <option value="N/A" selected>Select company</option>
                                                                            <option value="bKash">bKash</option>
                                                                            <option value="Rocket">Rocket</option>
                                                                            <option value="mCash">mCash</option>
                                                                            <option value="UCash">UCash</option>
                                                                            <option value="My Cash">My Cash</option>
                                                                            <option value="OK Mobile Banking">OK Mobile Banking</option>
                                                                            <option value="T-cash">T-cash</option>
                                                                            <option value="Sure Cash">Sure Cash</option>
                                                                            <option value="Nagad">Nagad</option>
                                                                        </select>
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
