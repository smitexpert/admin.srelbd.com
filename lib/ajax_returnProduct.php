<?php
    require __DIR__.'/Session.php';
require __DIR__.'/Database.php';

Session::checkSession();



$db = new Database;
$ndb = new Database;

$userStatusId = Session::get('adminId');

$userStatusQuery = "SELECT * FROM user WHERE userId = '$userStatusId'";

$userStatusResult = $db->select($userStatusQuery);

while($userStatusRow = $userStatusResult->fetch_assoc()){
    $userStatus = $userStatusRow['status'];
    $branchId = $userStatusRow['branch_name'];
}

if($userStatus == 0){
    header('location: logout.php');
}
//-------------------


//Check invoice is valid or not
if(isset($_POST['saleReturnInvoiceCheck'])){
    $saleReturnInvoiceNo = $_POST['saleReturnInvoiceCheck'];
    
    $checkInvoice = "SELECT *FROM sale_history where invoice_no = '$saleReturnInvoiceNo' AND branch_id = '$branchId'";
    $checkInvoice = $db->link->query($checkInvoice);
    
//    $checkInvoice = $checkInvoice->fetch_row();
    
    if($checkInvoice->num_rows>0){
        echo 1;
    }else{
        echo 0;
    }   
    
}
//start this code for only show old invoice data
if(isset($_POST['saleReturnInvoiceNo'])){
    $saleReturnInvoiceNo = $_POST['saleReturnInvoiceNo'];
    
//    $saleInvoice = "SELECT *FROM sale_history where invoice_no = '$invoiceNo'";
    $saleInvoice = "SELECT sale_history.*, product_name.name as product FROM sale_history LEFT JOIN product_name ON sale_history.product_id = product_name.id WHERE sale_history.invoice_no  = '$saleReturnInvoiceNo'";
    $saleInvoice_r = $db->link->query($saleInvoice);
    
    $sl = "1";
    
    while($row = $saleInvoice_r->fetch_assoc()){       
    
    ?>
<tr>
    <td style="text-align: center;" width="84">
        <p><?php echo $sl; ?></p>
    </td>
    <td style="text-align: center;" width="167">
        <p><?php echo $row['product'];?></p>
        <input type="hidden" name="productId[]" value="<?php echo $row['product_id']?>">
        <input type="hidden" name="buyer_type" value="<?php echo $row['buyer_type']?>">
        <input type="hidden" name="buyer_id" value="<?php echo $row['buyer_id']?>">
        <input type="hidden" name="buyer_name" value="<?php echo $row['buyer_name']?>">
        <input type="hidden" name="branch_id" value="<?php echo $row['branch_id']?>">
    </td>
    <td style="text-align: center;" width="125">
        <input class="returnQuantity" onchange="quantity(event)" onkeyup="quantity(event)" type="number" value="<?php echo $row['quantity'];?>" min="1" max="<?php echo $row['quantity'];?>">
        <input type="hidden" class="quantityMain" value="<?php echo $row['quantity'];?>">
        <input type="hidden" class="quantityChange" name="quantityChange[]" value="0">
    </td>
    <td class="unite_price" style="text-align: right;" width="125">
        <?php echo number_format($row['unit_price'],2);?>
        <input type="hidden" name="unitePrice[]" value="<?php echo $row['unit_price'];?>">
    </td>
    <td class="quntity_total" style="text-align: right;" width="125">
        <?php echo number_format($row['total_price'],2);?>
        <input type="hidden" name="totalPrice[]" value="<?php echo $row['total_price'];?>">
    </td>
    <td style="text-align:center;"><span class="remove_product" onclick="remove_product(event)">X</span></td>
</tr>


<?php
      $sl++;  
    }
}
//end this code for only show old invoice data
//-------------------------------------------
if(isset($_POST['saleReturnOldInvoiceNoData'])){
    $invoiceNo = $_POST['saleReturnOldInvoiceNoData'];
    
//    $saleInvoice = "SELECT *FROM sale_history where invoice_no = '$invoiceNo'";
//    $saleInvoice = "SELECT SUM(total_price) AS grandTotal, buyer_id, buyer_name, DATE(sale_date) AS sale_date,invoice_no,branch_id FROM sale_history where invoice_no = '$invoiceNo'";
    
    $saleInvoice = "SELECT SUM(sale_history.total_price) AS grandTotal, sale_history.buyer_id, sale_history.buyer_name, DATE(sale_history.sale_date) AS sale_date,sale_history.invoice_no, sale_history.reference_invoice, tbl_branch.branch_name FROM sale_history LEFT JOIN tbl_branch ON sale_history.branch_id = tbl_branch.branch_id where invoice_no = '$invoiceNo'";
    $saleInvoice = $db->link->query($saleInvoice);
    
    $result = $saleInvoice->fetch_array();
    echo json_encode($result);
}



//Code for Submit Return Product List

if(isset($_POST['saleRInvoice'])){
//    echo $_POST['saleRInvoice'];
    $old_invoice = $_POST['saleRInvoice']; 
    
//Generate new invoice 
    $invoiceNo = "SELECT id FROM invoice_no ORDER BY id DESC LIMIT 1";
        $invoiceNo2 = $db->link->query($invoiceNo);
        $invoice_no = "";
        while($row = $invoiceNo2->fetch_assoc()){
            $invoice_no = $row['id'];
        }


    $invoiceNo = $invoice_no + 1;
    $invoiceNo = sprintf("%04d", $invoiceNo );
    
    $insert_invoice = "insert into invoice_no(invoice_no,status) values ('$invoiceNo','1')";
    $insert_invoice = $db->link->query($insert_invoice);  
    //end of code for generate new invoice no
    
    //Receive informatio from new submitted from    
    $productId = $_POST['productId'];
    $quantityChange = $_POST['quantityChange'];
    $unitePrice = $_POST['unitePrice'];
    $totalPrice = 0;
    
    $buyerType = $_POST['buyer_type'];
    $buyer_id = $_POST['buyer_id'];
    $buyerName = $_POST['buyer_name'];
    $branchId = $_POST['branch_id'];
    
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

	$moneyReceiptNumber = "AD".$dayMonthYear.$last_serial;
    
    
    
        
    $grantTotal = 0;
    $status = "no action";
    
    foreach($productId as $out => $data){
        $product_id = $data;
        $change_quantity = $quantityChange[$out];
        $salePrice = $unitePrice[$out];
        $totalPrice = ($change_quantity * $salePrice);
        
        $grantTotal = $grantTotal + $totalPrice;
        
        //get buy price from product stock
        $getBuyPrice = "SELECT buy_price FROM product_stock where product_id = '$product_id' and branch_id = '$branchId'";
        $getPrice = $db->link->query($getBuyPrice);
        
        $row = $getPrice->fetch_row();
        
        $unit_buy_price = $row[0];
        
        $total_buy_price = $unit_buy_price * $change_quantity;
        

        
        if($change_quantity != 0){
            $return_sale = "INSERT INTO sale_history (product_id, buyer_type, buyer_id, buyer_name, quantity, unit_price,total_buy_price, total_price, invoice_no, reference_invoice, entry_by, branch_id, sale_type) VALUES ('$product_id','$buyerType','$buyer_id', '$buyerName', '$change_quantity','$salePrice', '$total_buy_price','$totalPrice','$invoiceNo', '$old_invoice', '$userStatusId', '$branchId', 'return')";
        
            $return_sale = $db->link->query($return_sale);     
                        
            $updateStock = "update product_stock set quantity = quantity + '$change_quantity' WHERE branch_id = '$branchId' AND product_id = '$product_id'";
            $updateStock = $db->link->query($updateStock);
            
        
        }    
        
     }
    
    if($grantTotal != 0){
        $insert_accounts = "INSERT INTO accounts (money_receipt_no, reference_no, payer_name, amount, description, receiver_id, transaction_type) VALUES ('$moneyReceiptNumber', '$invoiceNo', '$buyerName', '$grantTotal', 'sale return', '$userStatusId', 'debit')";
    
        $query = $db->link->query($insert_accounts);
        

    }
    //insert into agent ladger
        
        if($buyerType == "agent"){
         $add_agent_ladger = "insert into agent_ladger (money_receipt_no, agent_id, transaction_type, plant_no, goods_description, amount, entry_by, status) values ('$moneyReceiptNumber', '$buyer_id','credit', '$invoiceNo', 'sale return' , '$grantTotal','$userStatusId','1')";
            
        $add_agent_ladger = $db->link->query($add_agent_ladger);
        

    }
 if($insert_invoice && $return_sale && $updateStock && $query && $add_agent_ladger){
     echo $invoiceNo;
 }  
}
?>
