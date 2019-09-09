<?php 
include('includes/header.php'); 
//include('lib/Database.php');
error_reporting(E_ALL);

//if (isset($_POST['submit'])) {
//$createStuffs = $Stuffset->insertStuff($_POST);
//}

$db = new Database();
$branchId = "";
$userId = Session::get('adminId');

//get branch id
$selectBranch = "SELECT branch_name FROM user WHERE userId = '$userId'";
$getBranchId = $db->link->query($selectBranch);

while($row = $getBranchId->fetch_assoc()){
    $branchId = $row['branch_name'];
}

$db = new Database();

// Designation Query Start

$designationQuery = "SELECT * FROM user_rule WHERE status=1";
    
$ruleResult = $db->select($designationQuery);

$query = "SELECT id FROM user ORDER BY id DESC LIMIT 1";

$result = $db->select($query);

//$productName = "SELECT * FROM product_stock where quantity > 0";
$productName = "SELECT product_stock.*, product_name.name AS name FROM product_stock LEFT JOIN product_name ON product_stock.product_id = product_name.id WHERE quantity > '0' AND branch_id = '$branchId'";
$productQueryResult = $db->select($productName);

if($result){
    while($row = $result->fetch_assoc()){
    $lastId = $row['id']+1;
}
    
}

$yearMonth = date('y').date('m');

if($lastId < 10){
    $lastId = '0'.$lastId;
}

        $invoiceNo = "SELECT id FROM invoice_no ORDER BY id DESC LIMIT 1";
        $invoiceNo1 = $db->link->query($invoiceNo);

        while($row = $invoiceNo1->fetch_assoc()){
            $invoiceNo2 = $row['id'];
        }


    if($invoiceNo2){
        $invoiceNo2 = $invoiceNo2 + 1;
    }else{
        $invoiceNo2 = 1;
    }
    $invoiceNo2 = sprintf("%04d", $invoiceNo2);


// Select Agent Name



    $query = "SELECT * FROM agent ORDER BY name ASC";
    $agentList = $db->select($query);

/*
$creationMenuQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='creation-area'";
$creationMenuCount = $db->count($creationMenuQuery);

*/



?>

<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>

    <div class="main-content">

        <div class="container"><br><br>
            <div id="printSuccess"></div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-12">
                    <div id="printsuccess" style="position:absolute;z-index: 999;top: -25px;"></div>
                    <div class="panel panel-default">
                        <div class="panel-heading bdOrange">
                            <i class="fa fa-external-link-square"></i>PRODUCT SELL
                            <!--                                <div class="panel-tools"><a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a><a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal"><i class="fa fa-wrench"></i></a><a class="btn btn-xs btn-link panel-refresh" href="#"><i class="fa fa-refresh"></i></a><a class="btn btn-xs btn-link panel-expand" href="#"><i class="fa fa-resize-full"></i></a></div>-->
                        </div>


                        <div class="panel-body borderOrange">
                            <div class="row">
                                <div class=col-md-4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="productName" class="control-label">
                                                    Product Name <span class="symbol required"></span>
                                                </label>
                                                <select name="product_id" id="check_product_stock" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" required>
                                                    <option value="">Select Product</option>
                                                    <?php
                                                if($productQueryResult){ while($product = $productQueryResult->fetch_assoc()){
                                                     ?>

                                                    <option value="<?php echo $product['product_id']; ?>"><?php echo $product['name']; ?></option>
                                                    <?php
                                                             
                                                     }
                                                    
                                                }
                                                    ?>


                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="quantity" class="control-label">
                                                    Quantity <span class="symbol required"></span>
                                                </label>
                                                <input style="font-size:18px; height:33px; border-radius:3px !important; !important" type="number" class="form-control" name="quantity" id="quantity" value="" onkeyup="quanVal(event)" onclick="quanVal(event)" min="1" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="quantity" class="control-label">
                                                </label>
                                                <button style="margin-top:22px;" type="button" class="btn btn-green" id="add_product" disabled>ADD</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="product_details">
                                                <tbody>
                                                    <tr>
                                                        <th style="text-align:right">Chalan No.</th>
                                                        <th style="padding-left:50px;" id="p_id">:&nbsp;0</th>
                                                    </tr>
                                                    <tr>
                                                        <th style="text-align:right">Available Stock</th>
                                                        <th style="padding-left:50px;" id="stock_quantity">:&nbsp;0</th>
                                                    </tr>
                                                    <tr>
                                                        <th style="text-align:right">Unit Price</th>
                                                        <th style="padding-left:50px;" id="sell_price">:&nbsp;0</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <form action="#" role="form" id="product_submit" method="POST">
                                    <div class=col-md-8>
                                        <div class="row" style="text-align:center; font-weight:bold; letter-spacing: 3px;">INVOICE
                                            <hr style="border-top: 1px dashed;">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="customerType" class="control-label">
                                                    Customer Type <span class="symbol required"></span>
                                                </label>
                                                <select name="buyerType" id="buyerType" class="selectpicker" data-show-subtext="true" data-live-search="false">
                                                    <option value="agent" selected>Agent</option>
                                                    <option value="customer">Customer</option>
                                                </select>
                                            </div>
                                            <div class="col-md-5">
                                                <div id="customer" style="display: none;" class="form-group">
                                                    <label for="customerName" class="control-label">
                                                        Customer Name <span class="symbol required"></span>
                                                    </label>
                                                    <input type="text" name="customerName" id="customerName" class="form-control" onkeyup="enable_submit_button()" onchange="enable_submit_button()" value="">
                                                </div>
                                                <div id="agent" style="display: block;">
                                                    <label for="agentName" class="control-label">
                                                        Agent Name <span class="symbol required"></span>
                                                    </label>
                                                    <select name="agentNamePout" id="agentName" class="selectpicker" data-show-subtext="true" data-live-search="true" onchange="enable_submit_button()">
                                                        <option value="">Select Agent</option>
                                                        <?php
                                                 if($agentList){
                                                     while($row = $agentList->fetch_assoc()){
                                                     ?>

                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                        <?php
                                                             
                                                     }
                                                     
                                                 }
                                                    ?>


                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1" style="text-align:right; padding-right:0px !important">Date: </div>
                                            <div class="col-md-2" style="text-align:left; padding-left:0px !important; font-weight:bold">&nbsp;<?php echo date("d.m.Y"); ?> </div>
                                            <div class="col-md-1" style="text-align:right; padding-right:0px !important">invoice: </div>
                                            <div class="col-md-2" style="text-align:left; padding-left:0px !important; font-weight:bold">&nbsp;<?php echo $invoiceNo2; ?> </div>
                                            <input type="hidden" name="invoiceNo" id="invoiceNo" value="<?php echo $invoiceNo2; ?>">
                                            <input type="hidden" name="submitGrandTotal" id="submitGrandTotal" value="0">
                                        </div><br /><br />

                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="col-md-12">
                                                    <thead>
                                                        <tr style="border-bottom:1px dashed black; height:50px;">
                                                            <th style="text-align:center;">SL.</th>
                                                            <th style="text-align:center;">Product Name</th>
                                                            <th style="text-align:center;">Quantity</th>
                                                            <th style="text-align:center;">Unit Price</th>
                                                            <th style="text-align:center;">Total Price</th>
                                                            <th style="text-align:center;">Remove Item</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="item-list" id="item_list"></tbody>
                                                    <tfoot>
                                                        <tr style="border-top:1px dashed black; text-weight:bold">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td style="text-align:right; font-weight:bold">Grand Total:</td>
                                                            <td style="text-align:right; font-weight:bold" id="grTotal">0.00</td>
                                                            <td style="text-align:center;"></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                <!--<table class="col-md-12">
                                                    <tbody>
                                                        
                                                    </tbody>
                                                </table>-->
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group connected-group" style="padding-top:30px">
                                                    <input class="btn btn-md btn-green btn-block" id="productSubmit" type="submit" name="submit" value="PRINT" disabled>
                                                </div>
                                            </div>
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
<?php 
include('includes/footer.php');
?>
