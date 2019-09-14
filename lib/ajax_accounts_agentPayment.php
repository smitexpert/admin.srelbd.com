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

//receive data from accounts_agentPayment.php
if(isset($_POST['money_receipt_no'])){
    $money_receipt_no = $_POST['money_receipt_no'];
    $reference_no = $_POST['reference_no'];
    $agent_date = $_POST['agent_date'];
    $agent_id = $_POST['agent_id'];
    $agent_amount = $_POST['agent_amount'];
    
    $payment_mode = $_POST['payment_mode'];
    
    
    $cheque_no = $_POST['cheque_no'];   
    $bank_name = $_POST['bank_name'];   
    $mobile_no = $_POST['mobile_no']; 
    
    
    $mobile_account_no = $_POST['mobile_account_no'];    
    $transaction_no = $_POST['transaction_no'];    
    $mobile_bank_name = $_POST['mobile_bank_name']; 
    
    //get agent name from agent table using agent id
    $getAgentName = "SELECT name FROM agent WHERE id = '$agent_id'";
    $getName = $db->link->query($getAgentName);
    
    $name = $getName->fetch_row();
    $agentName = $name[0];
    
    
    //insert into accounts
    if($money_receipt_no){
        $insert_accounts = "INSERT INTO accounts (money_receipt_no, reference_no, payer_name, amount, description, payment_mode, cheque_no, bank_name, mobile_no, mobile_account_no, transaction_no, mobile_bank_name,  receiver_id, transaction_type, transaction_date) VALUES ('$money_receipt_no', '$reference_no', '$agentName', '$agent_amount', 'agent payment', '$payment_mode', '$cheque_no', '$bank_name', '$mobile_no', '$mobile_account_no', '$transaction_no', '$mobile_bank_name','$userStatusId', 'debit','$agent_date')";
    
        $query = $db->link->query($insert_accounts);
        
        $add_agent_ladger = "insert into agent_ladger (money_receipt_no, agent_id, transaction_type, goods_description, amount, entry_by, status) values ('$money_receipt_no', '$agent_id','debit', 'cash receive' , '$agent_amount','$userStatusId','1')";
        
        $add_agent_ladger = $db->link->query($add_agent_ladger);
        
        if($add_agent_ladger && $query){
            echo $add_agent_ladger;
        }
        
    }
    
    //insert into agent accounts
        
//    echo $query;
} 

if(isset($_POST['getMoneyreceiptNo'])){
    
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
    echo $serial;
}

?>
