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

//start code for add new plant

if(isset($_POST['agentOpenBalance'])){    

    $moneyReceiptNo = $_POST['agentOpenBalance'];   
    $create_date = $_POST['create_date'];   
    $referenceno = $_POST['referenceno'];   
    $agentId = $_POST['agentName'];   
    $amount = $_POST['amount']; 
    
    //GET payer name from agent table
    $getAgentName = "SELECT name from agent WHERE id = '$agentId'";
    $getName = $db->link->query($getAgentName);
    if($getName->num_rows > 0){
        $row = $getName->fetch_row();
        $agentName = $row[0];
        
        //echo $agentName;
        //insert into agent accounts
        $insert_agent_account = "INSERT INTO agent_ladger (money_receipt_no, agent_id, transaction_type, goods_description, amount, entry_by, status) VALUES('$moneyReceiptNo', '$agentId', 'credit', 'Opening Balance', '$amount', '$userStatusId', '1')";
        $insert = $db->link->query($insert_agent_account);
        
        if($insert){
            echo "Kaj HOise";
        }else{
            echo $db->link->error;
        }
        
        //insert into accounts
        $insert_into_accounts = "INSERT INTO accounts (money_receipt_no, payer_name, amount, description, receiver_id, transaction_type, transaction_date, reference_no) VALUES ('$moneyReceiptNo', '$agentName', '$amount', 'as opening balance', '$userStatusId','debit', '$create_date', '$referenceno')";
        $insert2 =$db->link->query($insert_into_accounts);
        
        if($insert2){
            echo 1;
        }else{
            echo $db->link->error;
        }
    }
    else{
        echo "Nothing!";
    }
    
    
}

if(isset($_POST['agentId'])){
    $id = $_POST['agentId'];
    
    //cheque duplicate entry in agent_ladger table
    $check_duplicate = "SELECT *FROM agent_ladger WHERE agent_id = '$id' AND goods_description = 'Opening Balance'";
    $getResult = $db->link->query($check_duplicate);
    $query = $getResult->num_rows;
    echo $query;
}


?>