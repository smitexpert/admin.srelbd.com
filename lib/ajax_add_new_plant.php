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

if(isset($_POST['plantDate'])){
    
    $plantDate = "";
    $plantId = "";
    $disbursementNo = "";
    $plantOwnerName = "";
    $nid = "";
    $dob = "";
    $contact = "";
    $district = "";
    
    $policeStation =  "";
    $union =    "";
    $village =  "";
    $others =  "";
    
    $plantAssignBy = "";
    $agentName = "";
    $offeredAmount_agent = "";
    $offeredAmount_staff = "";
    $offeredAmount_others = "";
    $stafftName = "";
    $othersName = "";
    $district_others = "";
    $othersMobile = "";
    
    $Name = "";
    $offeredAmount = "";   
    $district_others = "";   
//    $status = "1";  
    $user = Session::get('adminId');
    $transaction_type = "credit";
    $goods_description = "By Plant";
    $result  ="";  
    
    $status = "";
  
    
    $query_1 = "SELECT money_receipt_no FROM accounts ORDER BY id DESC LIMIT 1";
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

	$moneyReceiptNo_credit = "AC".$dayMonthYear.$last_serial;
	$moneyReceiptNo_debit = "AD".$dayMonthYear.$last_serial;
    
    $create_date = date('d-m-Y');
    
    
    $plantDate =  mysqli_real_escape_string($db->link, $_POST['plantDate']);    
    $plantId =  mysqli_real_escape_string($db->link, $_POST['plantId']);    
    $disbursementNo =  mysqli_real_escape_string($db->link, $_POST['disbursementNo']);
    $plantOwnerName =  mysqli_real_escape_string($db->link, $_POST['plantOwnerName']);    
    $nid =  mysqli_real_escape_string($db->link, $_POST['nid']);
    $dob =  mysqli_real_escape_string($db->link, $_POST['dob']);
    $contact =  mysqli_real_escape_string($db->link, $_POST['contact']);
    $district =  mysqli_real_escape_string($db->link, $_POST['district']);
    $policeStation =  mysqli_real_escape_string($db->link, $_POST['policeStation']);
    $union =  mysqli_real_escape_string($db->link, $_POST['union']);
    $village =  mysqli_real_escape_string($db->link, $_POST['village']);
    $others =  mysqli_real_escape_string($db->link, $_POST['others']);
    $status =  mysqli_real_escape_string($db->link, $_POST['plantStatus']);
    
    //Plant assigned by agent/staff/others
    $plantAssignBy =  mysqli_real_escape_string($db->link, $_POST['plantAssignBy']);
    
        
    
    if($plantAssignBy == "agent"){       
        $Name =  mysqli_real_escape_string($db->link, $_POST['agentName2']);
        $offeredAmount =  mysqli_real_escape_string($db->link, $_POST['offeredAmount_agent']);
    }else if($plantAssignBy == "companyStaff"){
        $Name =  mysqli_real_escape_string($db->link, $_POST['stafftName']);
        $offeredAmount =  mysqli_real_escape_string($db->link, $_POST['offeredAmount_staff']);
    }else if($plantAssignBy == "others"){
        $Name =  mysqli_real_escape_string($db->link, $_POST['othersName']);
        $othersMobile =  mysqli_real_escape_string($db->link, $_POST['othersMobile']);
        $district_others =  mysqli_real_escape_string($db->link, $_POST['district_others']);
        $offeredAmount =  mysqli_real_escape_string($db->link, $_POST['offeredAmount_others']);
    }
    
      
    
    
    $add_new_plant = "INSERT INTO biogas_plant (plant_no, disbursement_no, plant_owner_name, nid, dob, contact_no, district, police_station, union1, village, others,  assignee_type, assigned_by, onthers_mobile, others_district, offered_amount, plant_date, entry_by, status) VALUE ('$plantId','$disbursementNo', '$plantOwnerName','$nid', '$dob', '$contact','$district','$policeStation', '$union', '$village', '$others', '$plantAssignBy', '$Name', '$othersMobile', '$district_others', '$offeredAmount', '$plantDate', '$user', '$status')"; 
    
    $add_new_plant = $db->link->query($add_new_plant);
    if($add_new_plant != true){
    echo $db->link->error;
}
    
//    echo "biogas plant->".$add_new_plant."\n";
//    $result = "Add Plant";
    
    if($plantAssignBy == "agent"){
        $add_agent_plant = "INSERT INTO agent_ladger (money_receipt_no, agent_id, transaction_type, plant_no, goods_description, amount, entry_by, status) VALUE ('$moneyReceiptNo_credit', '$Name', '$transaction_type', '$plantId', '$goods_description', '$offeredAmount', '$user','$status')";  
        
        $add_agent_plant = $db->link->query($add_agent_plant);
        if($add_agent_plant != true){
    echo $db->link->error;
}
        //get agent name from agent table
        $getAgentName = "SELECT name FROM agent WHERE  id = '$Name'";
        $getName = $db->link->query($getAgentName);
        $row = $getName->fetch_row();
        
        $agentName = $row[0];

        
        $add_to_acounts = "INSERT INTO accounts (reference_no, 	money_receipt_no, payer_name, amount, description, receiver_id, transaction_type, transaction_date) VALUES ('$plantId','$moneyReceiptNo_debit', '$agentName', '$offeredAmount', '$goods_description', '$user','debit', '$create_date')";
    
        $add_to_accounts = $db->link->query($add_to_acounts);
        
//        if($add_to_acounts){            
//        echo "accounts->".$add_to_acounts."\n";
//        }else{
//            echo $db->link->error;
//        }
if($add_to_accounts != true){
    echo $db->link->error;
}
    }
    
    if($add_new_plant && $add_agent_plant && $add_to_accounts){
        echo 1;
    }else{
        echo "Test";
    }
}

//end code for add new plant

//php end
?>
