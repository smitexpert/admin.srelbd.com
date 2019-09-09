<?php 
include('includes/header.php'); 
    $query = "SELECT *FROM debit_item";
    $result = $db->select($query);

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


if (isset($_POST['referenceno'])) {
     
    
    $reference_no = $_POST['referenceno'];
    $payer_name = $_POST['payer_name'];
    $create_date = $_POST['create_date'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $payment_mode = $_POST['payment_mode'];
    $mobile_no = $_POST['mobile_no']; 
    $mobile_account_no = $_POST['mobile_account_no'];
    $mobile_bank_name = $_POST['mobile_bank_name'];
    $transaction_no = $_POST['transaction_no'];
    $cheque_no = $_POST['cheque_no'];
    $bank_name = $_POST['bank_name'];
    $transaction_type = "Debit";
    $created_by = Session::get('adminId');
    
    $insert = "INSERT INTO accounts (reference_no,money_receipt_no, payer_name, amount, description, payment_mode, cheque_no, bank_name,mobile_no,mobile_account_no, transaction_no, mobile_bank_name, receiver_id,transaction_type,transaction_date) VALUES ('$reference_no', '$serial','$payer_name','$amount','$description','$payment_mode','$cheque_no','$bank_name','$mobile_no','$mobile_account_no','$transaction_no','$mobile_bank_name','$created_by','$transaction_type','$create_date')";
    
    $query = $db->link->query($insert);
    
    if($query){
        header("location: http://admin.srelbd.com/accounts_debit.php");
    }else{
//        header("location: ".$_SERVER['PHP_SELF']."?success=false");
        echo $db->link->error;
    }
    
}




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
                                            CREATE DEBIT VOUCHER
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
                                                                        <label for="">Money Receipt No.<span class="symbol required"></span></label>
                                                                        <input type="text" class="form-control" value="<?=$serial ?>" disabled>
                                                                    </div>
                                                                </div>
                                                                   <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Reference No:<span class="symbol required"></span></label>
                                                                        <input type="text" class="form-control" name="referenceno" id="referenceno" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Date:</label>
                                                                        <input type="text" class="form-control" name="create_date" id="create_date" value="<?php echo date("Y-m-d"); ?>" required>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Recipient Name:<span class="symbol required"></span></label>
                                                                        <input type="text" class="form-control" name="payer_name" id="payer_name" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Amount(BDT):<span class="symbol required"></span></label>
                                                                        <input type="number" step="any" class="form-control" name="amount" id="amount" min="0" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Expenditure:</label> 
                                                                        <select class="form-control" name="description" required>
                                                                            <option value="" selected>Select Item</option>
                                                                            <?php
                                                                                while($row = $result->fetch_assoc()){
                                                                                    ?>
                                                                                    <option value="<?php echo $row['item_name'] ?>"><?php echo $row['item_name'] ?></option>
                                                                             <?php
                                                                                
                                                                                }
                                                                            ?>
                                                                            <option value="Others">Others</option>
                                                                        </select>
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
                                                                    <button class="btn btn-warning btn-block" type="submit">SUBMIT</button>
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
