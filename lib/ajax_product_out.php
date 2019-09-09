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

if(isset($_POST['product_id_info'])){
    $product_id = $_POST['product_id_info'];
    
    $check = "select *from product_stock where product_id = '$product_id'";
    $result = $db->link->query($check);
    
   while($row = $result->fetch_assoc()){
       ?>
<tbody>
    <tr>
        <th style="text-align:right">Chalan No.</th>
        <th style="text-align:center">:&nbsp;</th>
        <th><?php echo $row["chalanNo"];?>
            <input type="hidden" id="p_id" value="<?php echo $row["product_id"];?>">
            <input type="hidden" id="unit_buy_price" value="<?php echo $row["buy_price"];?>">
        </th>
    </tr>
    <tr>
        <th style="text-align:right">Available Stock</th>
        <th style="text-align:center">:&nbsp;</th>
        <th id="stock_quantity"><?php echo $row["quantity"] ."&nbsp;pieces"; ?></th>
    </tr>
    <!--
    <tr>id="p_id"
        <th style="text-align:right">Stock Value</th>
        <th style="text-align:center">:&nbsp;</th>
        <th id="total_price"><?php echo $row["quantity"] * $row["sale_price"];?></th>
    </tr>
-->
    <tr>
        <th style="text-align:right">Unit Price</th>
        <th style="text-align:center">&nbsp;:&nbsp;</th>
        <th id="sell_price" style="text-align:left;"><?php echo $row["sale_price"];?></th>
    </tr>
</tbody>

<?php
   }
    
}

if(isset($_POST['product_id'])){
    $pro_id = $_POST['product_id'];
    $buyerType = $_POST['buyerType'];
    $buyer_id = $_POST['agentNamePout'];
    $pro_quantity = $_POST['quantity'];    
    $customerName = $_POST['customerName'];
    $sale_price = $_POST['sale_price'];
    $grandTotalPrice = $_POST['submitGrandTotal'];
    $invoice_no = $_POST['invoiceNo'];
    
    //query for get branch name 
    $branchName = "SELECT branch_name FROM user WHERE userId = '$userStatusId'";
    $branch_Id = $db->link->query($branchName);
    $branchId = "";
    
    while($row = $branch_Id->fetch_assoc()){
        $branchId = $row['branch_name'];
    }
    
    //get agent name
    if($buyerType == "agent"){
        $getAgentName = "SELECT name FROM agent WHERE id = '$buyer_id'";
        $agentNameQuery = $db->link->query($getAgentName);
        $row = $agentNameQuery->fetch_row();
        $agentName = $row[0];
    }
    
    
    //for getting buyer name start code here
    $getBuyerName  = "SELECT *FROM agent where id='$buyer_id'";
    $buyerName = $db->link->query($getBuyerName);
    $buyerName2 = $buyerName->fetch_assoc();
    
    if($buyerType == "agent"){        
        $buyerName3 = $agentName;
    }else{
        $buyerName3 = $customerName;
    }
    
    
    //code close for getting buyer name
    
    $array_length = count($pro_id);
    
    for($i = 0;$i < $array_length; $i++){
                
        $product_id = $pro_id[$i];
        $sale_quantity = $pro_quantity[$i];
        $salePrice = $sale_price[$i];        
        $totalPrice = $sale_quantity * $salePrice;  
        
        //get buy price from product stock table
        
        $getbuyPrice = "SELECT buy_price FROM product_stock WHERE product_id = '$product_id'";
        $getPrice = $db->link->query($getbuyPrice);
        $buyPrice = 0;
        
        while($row = $getPrice->fetch_row()){
            $buyPrice = $row[0];
        }
        $total_buy_price = $sale_quantity * $buyPrice;       

        
        
        $sale_history = "insert into sale_history (product_id, buyer_type, buyer_id, buyer_name, quantity, unit_price,total_buy_price, total_price, invoice_no, entry_by, branch_id, sale_type) values ('$product_id','$buyerType','$buyer_id', '$buyerName3', '$sale_quantity','$salePrice','$total_buy_price','$totalPrice','$invoice_no', '$userStatusId', '$branchId', 'product_sale')";
        
        $insert_sale = $db->link->query($sale_history);
        
        if($insert_sale){
            $update_quantity = "update product_stock set quantity = quantity - '$sale_quantity' where product_id = '$product_id'";
            $result_quantity = $db->link->query($update_quantity);
        }
        

        
    }
    //insert into accounts as a credit balance
    if($totalPrice != 0){
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
        $today = date("d-m-Y");

        $moneyReceiptNumber_credit = "AC".$dayMonthYear.$last_serial;
        $moneyReceiptNumber_debit = "AD".$dayMonthYear.$last_serial;

            $insert_accounts = "INSERT INTO accounts (reference_no, money_receipt_no, payer_name,payment_mode, amount, description, receiver_id, transaction_type, transaction_date) VALUES ('$invoice_no', '$moneyReceiptNumber_credit', '$buyerName3', 'agent plant', '$grandTotalPrice', 'product_sale', '$userStatusId', 'credit','$today')";
    
            $query = $db->link->query($insert_accounts);
        
       
    }
    
     if($buyerType == "agent"){
         $add_agent_ladger = "insert into agent_ladger (agent_id, money_receipt_no, transaction_type, plant_no, goods_description, amount, entry_by, status) values ('$buyer_id', '$moneyReceiptNumber_debit','debit', '$invoice_no', 'buy_product' , '$grandTotalPrice','$userStatusId','1')";
        $add_agent_ladger = $db->link->query($add_agent_ladger);
     }
    
    $insert_invoice = "insert into invoice_no(invoice_no,status) values ('$invoice_no','1')";
    $result_query = $db->link->query($insert_invoice);  
    
    if($sale_history && $update_quantity && $insert_accounts && $insert_invoice){
        echo $invoice_no;
    }
    
}

?>
