<?php

require __DIR__.'/Session.php';
require __DIR__.'/Database.php';

Session::checkSession();



$db = new Database;
$ndb = new Database;

$userStatusId = Session::get('adminId');

$userStatusQuery = "SELECT status FROM user WHERE userId = '$userStatusId'";

$userStatusResult = $db->select($userStatusQuery);

while($userStatusRow = $userStatusResult->fetch_assoc()){
    $userStatus = $userStatusRow['status'];
}

if($userStatus == 0){
    header('location: logout.php');
}

//Start Staff section

//create new employee
if(isset($_POST['userRegName'])){
    
    $userTblIndexMsg = "done";
    $checkUserTableMsg = "done";
    
    $query = "SELECT id FROM user ORDER BY id DESC LIMIT 1";

    $result = $db->select($query);
    
    $lastId = "";

    while($row = $result->fetch_assoc()){
        $lastId = $row['id']+1;
    }
    
//    $yearMonth = date('y').date('m');
//
//    if($lastId < 10){
//        $lastId = '0'.$lastId;
//    }
    
//    $userId = $yearMonth.$lastId;
    $userId = mysqli_real_escape_string($db->link, $_POST['staffRegId']);
    $name = mysqli_real_escape_string($db->link, $_POST['userRegName']);
    $email = mysqli_real_escape_string($db->link, $_POST['usermail']);
    $address = mysqli_real_escape_string($db->link, $_POST['address']);
    $contactOne = mysqli_real_escape_string($db->link, $_POST['contactOne']);
    $contactTwo = mysqli_real_escape_string($db->link, $_POST['contactTwo']);
    $password = md5($_POST['stuffPassword']);
    $rule = mysqli_real_escape_string($db->link, $_POST['stuffRole']);
    $branchName = mysqli_real_escape_string($db->link, $_POST['branchName']);
    $joiningDate = mysqli_real_escape_string($db->link, $_POST['joinDate']);
    $status = "1";
    
    /*$creation_area = '';*/
    
    $in_user_data = "INSERT INTO user (id, userId, name, rule, email, password, contact1, contact2, address, branch_name,joining_date, status) VALUE ('$lastId', '$userId', '$name', '$rule', '$email', '$password', '$contactOne', '$contactTwo', '$address', '$branchName', '$joiningDate', '$status')";
    
    $in_user_result = $db->link->query($in_user_data);
    
    
    if($in_user_result === TRUE){
        $userId = strtolower($userId);
        
        $createUserMenu = "CREATE TABLE IF NOT EXISTS menu_$userId (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            menuName VARCHAR(100) NOT NULL,
            menuUrl VARCHAR(100) NOT NULL,
            menuIndex VARCHAR(100) NOT NULL
        )";

        if($db->link->query($createUserMenu) === TRUE){
            $checkUserTableMsg = 'done';
        }else{
            $checkUserTableMsg = 'error';
        }
        
        echo $userTblIndexMsg.$checkUserTableMsg;

        
    }else{
        echo 'Email Already Exist! '.$db->link->error;
    }
    
    /*echo $userId." ".$name." ".$email." ".$address." ".$contactOne." ".$contactTwo." ".$password." ".$rule." ".$status;*/
    
    /*print_r($creation_area);*/
    
}


//End Staff section

//Start Plant Management section
//if(isset($_POST['plantDate'])){
//    
//    $plantDate = "";
//    $plantId = "";
//    $disbursementNo = "";
//    $plantOwnerName = "";
//    $nid = "";
//    $dob = "";
//    $contact = "";
//    $district = "";
//    
//    $policeStation =  "";
//    $union =    "";
//    $village =  "";
//    $others =  "";
//    
//    $plantAssignBy = "";
//    $agentName = "";
//    $offeredAmount_agent = "";
//    $offeredAmount_staff = "";
//    $offeredAmount_others = "";
//    $stafftName = "";
//    $othersName = "";
//    $district_others = "";
//    $othersMobile = "";
//    
//    $Name = "";
//    $offeredAmount = "";   
//    $district_others = "";   
//    $status = "1";  
//    $user = Session::get('adminId');
//    $transaction_type = "Credit";
//    $goods_description = "By Plant";
//    $result  ="";  
//  
//    
//    $query_1 = "SELECT serial FROM accounts order by id DESC limit 1";
//    $result_1 = $db->link->query($query_1);
//
//    if($result_1->num_rows > 0){
//        $last_serial = $result_1 ->fetch_row();
//        $last_serial = substr($last_serial[0],-3);
//        if($last_serial <999){
//            $last_serial++;
//            $last_serial = sprintf("%03d",$last_serial);          
//        }else{
//            $last_serial = "001";
//        }
//    }else{
//        $last_serial = "001";
//    }
//
//    $dayMonthYear = date('d').date('m').date('y');
//
//	$serial = "AD".$dayMonthYear.$last_serial;
//    
//    $create_date = date('Y-m-d');
//    
//    
//    $plantDate =  mysqli_real_escape_string($db->link, $_POST['plantDate']);    
//    $plantId =  mysqli_real_escape_string($db->link, $_POST['plantId']);    
//    $disbursementNo =  mysqli_real_escape_string($db->link, $_POST['disbursementNo']);
//    $plantOwnerName =  mysqli_real_escape_string($db->link, $_POST['plantOwnerName']);    
//    $nid =  mysqli_real_escape_string($db->link, $_POST['nid']);
//    $dob =  mysqli_real_escape_string($db->link, $_POST['dob']);
//    $contact =  mysqli_real_escape_string($db->link, $_POST['contact']);
//    $district =  mysqli_real_escape_string($db->link, $_POST['district']);
//    $policeStation =  mysqli_real_escape_string($db->link, $_POST['policeStation']);
//    $union =  mysqli_real_escape_string($db->link, $_POST['union']);
//    $village =  mysqli_real_escape_string($db->link, $_POST['village']);
//    $others =  mysqli_real_escape_string($db->link, $_POST['others']);
//    
//    //Plant assigned by agent/staff/others
//    $plantAssignBy =  mysqli_real_escape_string($db->link, $_POST['plantAssignBy']);
//    
//        
//    
//    if($plantAssignBy == "agent"){       
//        $Name =  mysqli_real_escape_string($db->link, $_POST['agentName2']);
//        $offeredAmount =  mysqli_real_escape_string($db->link, $_POST['offeredAmount_agent']);
//    }else if($plantAssignBy == "companyStaff"){
//        $Name =  mysqli_real_escape_string($db->link, $_POST['stafftName']);
//        $offeredAmount =  mysqli_real_escape_string($db->link, $_POST['offeredAmount_staff']);
//    }else if($plantAssignBy == "others"){
//        $Name =  mysqli_real_escape_string($db->link, $_POST['othersName']);
//        $othersMobile =  mysqli_real_escape_string($db->link, $_POST['othersMobile']);
//        $district_others =  mysqli_real_escape_string($db->link, $_POST['district_others']);
//        $offeredAmount =  mysqli_real_escape_string($db->link, $_POST['offeredAmount_others']);
//    }
//    
//      
//    
//    
//    $add_new_plant = "INSERT INTO biogas_plant (plant_no, disbursement_no, plant_owner_name, nid, dob, contact_no, district, police_station, union1, village, others,  assignee_type, assigned_by, onthers_mobile, others_district, offered_amount, plant_date, entry_by, status) VALUE ('$plantId','$disbursementNo', '$plantOwnerName','$nid', '$dob', '$contact','$district','$policeStation', '$union', '$village', '$others', '$plantAssignBy', '$Name', '$othersMobile', '$district_others', '$offeredAmount', '$plantDate', '$user', '$status')"; 
//    
//    $add_new_plant = $db->link->query($add_new_plant);
////    $result = "Add Plant";
//    
//    if($plantAssignBy == "agent"){
//        $add_agent_plant = "INSERT INTO agent_ladger (agent_id, transaction_type, plant_no, goods_description, amount, entry_by,status) VALUE ('$Name', '$transaction_type', '$plantId', '$goods_description', '$offeredAmount', '$user','$status')";  
//        
//        $add_agent_plant = $db->link->query($add_agent_plant);
//        
//        $add_to_acounts = "INSERT INTO accounts (reference_no,serial, payer_name, amount, description, receiver_id, transaction_type, transaction_date) VALUES ('$plantId','$serial', '$Name', '$offeredAmount', '$goods_description', '$user','Debit','$create_date')";
//    
//        $add_to_acounts = $db->link->query($add_to_acounts);
////        $result = "Agent entry success";
//    }else{
//        $add_agent_plant = true;
//        $add_to_acounts = true;
//    }
//    
//    $entryResult = 0;
//    
//    if($add_new_plant){        
//        $entryResult++;        
//    }
//    if($add_agent_plant){
//        $entryResult++; 
//    }
//    if($add_to_acounts){
//        $entryResult++; 
//    }
//    echo $entryResult;
//}
//End Plant Management section


if(isset($_POST['ruleId'])){
    $qId = $_POST['ruleId'];
    $query = "SELECT ruleName, status FROM user_rule WHERE ruleId='$qId'";
    $result = $db->select($query);
    $row =  $result->fetch_array();
    echo json_encode($row);
}

//Designation update
if(isset($_POST['designationTitleUp'])){
    $qId = $_POST['ruleIdUp'];
    $title = $_POST['designationTitleUp'];
    $status = $_POST['designationStausUp'];
    
    $title = mysqli_real_escape_string($db->link, $title);
    
    $query = "UPDATE user_rule SET ruleName='$title', status='$status' WHERE ruleId='$qId'";
    
    $result = $db->update($query);
    
    echo $result;
}

if(isset($_POST['branchId'])){
    $branchId = $_POST['branchId'];
    
//    $branchDetails = "SELECT *FROM tbl_branch WHERE branch_id = '$branchId'";
    $branchDetails = "SELECT tbl_branch.*, branch_managers.manager_id FROM tbl_branch LEFT JOIN branch_managers ON tbl_branch.branch_id = branch_managers.branch_id WHERE tbl_branch.branch_id = '$branchId'";
    $branchDetails = $db->link->query($branchDetails);
    $branchDetails = $branchDetails->fetch_array();
    
    echo json_encode($branchDetails); 
}

if(isset($_POST['reopenBranch'])){
    $branchId = $_POST['reopenBranch'];
    
//    $branchDetails = "SELECT *FROM tbl_branch WHERE branch_id = '$branchId'";
    $branchDetails = "SELECT tbl_branch.*, branch_managers.manager_id FROM tbl_branch LEFT JOIN branch_managers ON tbl_branch.branch_id = branch_managers.branch_id WHERE tbl_branch.branch_id = '$branchId'";
    $branchDetails = $db->link->query($branchDetails);
    $reopenBranchDetails = $branchDetails->fetch_array();
    
    echo json_encode($reopenBranchDetails); 
}

if(isset($_POST['upBranchId'])){
    $branchId = $_POST['upBranchId'];
    
    $upBranchManager = $_POST['upBranchManager'];
    $upContact = $_POST['upContact'];
    $upEmail = $_POST['upEmail'];    
    $upAddress = $_POST['upAddress'];    
    $upBranchAbout = $_POST['upBranchAbout'];    
    $upStatus = $_POST['upStatus'];
    
    $upQuery = "update tbl_branch  set branch_contact ='$upContact', branch_email ='$upEmail', branch_address = '$upAddress', branch_about = '$upBranchAbout', branch_status = '$upStatus' where branch_id = '$branchId'";
    $updateQuery = $db->link->query($upQuery);
    
    $deleteManager = "DELETE FROM branch_managers WHERE branch_id = '$branchId'";
    $deleteMan = $db->link->query($deleteManager);
    
    $insertManager = "INSERT INTO branch_managers (branch_id, manager_id, status) VALUE('$branchId','$upBranchManager','1')";
    $insertManager = $db->link->query($insertManager);
    
    if($insertManager){
        echo 1;
    }else{
        echo 0;
    }
}

if(isset($_POST['hiddenReopenName'])){
    $branchId = $_POST['hiddenReopenName'];
    
//    $upBranchManager = $_POST['upBranchManager'];
//    $upContact = $_POST['upContact'];
//    $upEmail = $_POST['upEmail'];    
//    $upAddress = $_POST['upAddress'];    
//    $upBranchAbout = $_POST['upBranchAbout'];    
    $upStatus = $_POST['reopenBranchStatusName'];
    
    $upQuery = "update tbl_branch  set branch_status = '$upStatus' where branch_id = '$branchId'";
    $updateQuery = $db->link->query($upQuery);
    
    
    
    if($upQuery){
        echo 1;
    }else{
        echo 0;
    }
}
if(isset($_POST['menu-area'])){
    
    $userId = $_POST['userId'];
    
    $sql = "TRUNCATE TABLE menu_$userId";
    
    $result = $db->link->query($sql);
    
    if($result === TRUE){
        $menu_area = $_POST['menu-area'];

        for($i=0; $i<count($menu_area); $i++){
            $j = $menu_area;

            $sql_ma = "SELECT * FROM menu_sidebar WHERE id=$j[$i]";
            $result_ma = $db->select($sql_ma);
            $row_ma = $result_ma->fetch_assoc();

            $ma_menu_name = mysqli_real_escape_string($db->link, $row_ma['menuName']);
            $ma_menu_url = mysqli_real_escape_string($db->link, $row_ma['menuUrl']);
            $ma_menu_index = mysqli_real_escape_string($db->link, $row_ma['menuIndex']);

            if($i==0){
                $ma_sql = "INSERT INTO menu_$userId (menuName, menuUrl, menuIndex) VALUES ('$ma_menu_name', '$ma_menu_url', '$ma_menu_index');";
            }else if($i == count($menu_area)-1){
                $ma_sql .= "INSERT INTO menu_$userId (menuName, menuUrl, menuIndex) VALUES ('$ma_menu_name', '$ma_menu_url', '$ma_menu_index')";
            }else{
                $ma_sql .= "INSERT INTO menu_$userId (menuName, menuUrl, menuIndex) VALUES ('$ma_menu_name', '$ma_menu_url', '$ma_menu_index');";
            }


        }

        if($db->link->multi_query($ma_sql) === TRUE) {
            echo 1;
        }else{
            echo 0;
        }
    }else{
        echo $db->link->error();
    }

    
    /*$ma_sql = "";
    $userTblIndexMsg = "done";


    if(isset($_POST['menu-area'])){

        $menu_area = $_POST['menu-area'];

        for($i=0; $i<count($menu_area); $i++){
            $j = $menu_area;

            $sql_ma = "SELECT * FROM menu_sidebar WHERE id=$j[$i]";
            $result_ma = $db->select($sql_ma);
            $row_ma = $result_ma->fetch_assoc();

            $ma_menu_name = mysqli_real_escape_string($db->link, $row_ma['menuName']);
            $ma_menu_url = mysqli_real_escape_string($db->link, $row_ma['menuUrl']);
            $ma_menu_index = mysqli_real_escape_string($db->link, $row_ma['menuIndex']);

            if($i==0){
                $ma_sql = "INSERT INTO menu_$userId (menuName, menuUrl, menuIndex) VALUES ('$ma_menu_name', '$ma_menu_url', '$ma_menu_index');";
            }else if($i == count($menu_area)-1){
                $ma_sql .= "INSERT INTO menu_$userId (menuName, menuUrl, menuIndex) VALUES ('$ma_menu_name', '$ma_menu_url', '$ma_menu_index')";
            }else{
                $ma_sql .= "INSERT INTO menu_$userId (menuName, menuUrl, menuIndex) VALUES ('$ma_menu_name', '$ma_menu_url', '$ma_menu_index');";
            }


        }

        if($db->link->multi_query($ma_sql) === TRUE) {
            $userTblIndexMsg = "done";
        }else{
            $userTblIndexMsg = "error";
        }

    }*/
    
    
}

if(isset($_POST['userStatusChange'])){
    
    $userId = $_POST['userStatusChange'];
    
    $statusQuery = "SELECT status FROM user WHERE userId='$userId'";
    
    $statusResult = $db->select($statusQuery);
    
    while($statusRow = $statusResult->fetch_assoc()){
        
        if($statusRow['status'] == 1){
            
            $updateUserStatusQuery = "UPDATE user SET status='0' WHERE userId='$userId'";
            
            $updateUserStatusResult = $db->update($updateUserStatusQuery);
            
            if($updateUserStatusResult === TRUE){
                echo '0';
            }else{
                echo 'Not Working!';
            }
            
            
        }else{
            
            $updateUserStatusQuery = "UPDATE user SET status='1' WHERE userId='$userId'";
            
            $updateUserStatusResult = $db->update($updateUserStatusQuery);
            
            if($updateUserStatusResult === TRUE){
                echo '1';
            }else{
                echo 'Not Working!';
            }
        }
        
        
        
    }
    
    
}

if(isset($_POST['productName'])){    
    
    $productId = $_POST['productName'];
    $productCode = $_POST['productCode'];
    $quantity = $_POST['quantity'];
    $buy_price = $_POST['buy_price'];
    $sale_price = $_POST['sale_price'];
    $company_id = $_POST['company_id'];
    $branch_id = $_POST['branch_id'];
    $description = $_POST['description'];
    $buy_date = $_POST['buy_date'];
    
    $created_by = Session::get('adminId');
    
    
    
    if($query){
        header("location: ../product_in.php");
    }else{
        header("location: ../product_in.php");
}

}

if(isset($_POST['productCodeCheck'])){
    $productCodeCheck = $_POST['productCodeCheck'];
    
    $check = "select *from product_stock where product_id = '$productCodeCheck'";
    $result = $db->link->query($check);
    
    if($result->num_rows>0){
        echo 1;
        
    }else{
        if($productCodeCheck == ""){
           echo 1; 
        }else{            
        echo 0;
        }
    }
    
}

/*if(isset($_POST['product_name'])){
    $product_name = $_POST['product_name'];
    
    $check = "select *from product_stock where id = '$product_name'";
    $result = $db->link->query($check);
    
   while($row = $result->fetch_assoc()){
       ?>
<tbody>
    <tr>
        <th style="text-align:right">Chalan No.</th>
        <th style="text-align:center">:&nbsp;</th>
        <th id="p_id"><?php echo $row["chalanNo"];?></th>
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
    
}*/

if(isset($_POST['product_quantity_check'])){
    $product_name = $_POST['product_quantity_check'];
    
    $check = "select *from product_stock where product_id = '$product_name'";
    $result = $db->link->query($check);
    
    $quantity = $result->fetch_assoc();
    
    echo $quantity["quantity"];
   
    
}

/*if(isset($_POST['product_id'])){
    $pro_id = $_POST['product_id'];
    $buyerType = $_POST['buyerType'];
    $buyer_id = $_POST['agentNamePout'];
    $pro_quantity = $_POST['quantity'];    
    $customerName = $_POST['customerName'];
    $sale_price = $_POST['sale_price'];
    $agentTotalPrice = $_POST['submitGrandTotal'];
    $invoice_no = $_POST['invoiceNo'];
    
    //query for get branch name 
    $branchName = "SELECT branch_name FROM user WHERE userId = '$userStatusId'";
    $branch_Id = $db->link->query($branchName);
    $branchId = "";
    
    while($row = $branch_Id->fetch_assoc()){
        $branchId = $row['branch_name'];
    }
    
    
    //for getting buyer name start code here
    $getBuyerName  = "SELECT *FROM agent where id='$buyer_id'";
    $buyerName = $db->link->query($getBuyerName);
    $buyerName2 = $buyerName->fetch_assoc();
    
    if($buyerType == "agent"){        
        $buyerName3 = $buyerName2['name'];
    }else{
        $buyerName3 = $customerName;
    }
    
    
    //code close for getting buyer name
    
    $array_length = count($pro_id);
    
    for($i = 0;$i < $array_length; $i++){
//        echo " Product ID: ".$pro_id[$i];
//        echo " Quantity: ".$pro_quantity[$i];
        $current_quantity = "select *from product_stock where product_id = '$pro_id[$i]'";
        $result = $db->link->query($current_quantity);    
        $quantity = $result->fetch_assoc();
        
        $up_quantity = $quantity['quantity'] - $pro_quantity[$i];
        
//        echo "Stock : ".$up_quantity;
                
        $product_id = $pro_id[$i];
        $sale_quantity = $pro_quantity[$i];
        $salePrice = $sale_price[$i];
        
        $totalPrice = $sale_quantity * $salePrice;
        
        
        $sale_history = "insert into sale_history (product_id, buyer_type, buyer_id, buyer_name, quantity, unit_price, total_price, invoice_no, entry_by, branch_id,sale_type) values ('$product_id','$buyerType','$buyer_id', '$buyerName3', '$sale_quantity','$salePrice','$totalPrice','$invoice_no', '$userStatusId', '$branchId', 'sale')";
        
        $insert_sale = $db->link->query($sale_history);
        
        if($insert_sale){
            $update_quantity = "update product_stock  set quantity ='$up_quantity' where product_id = '$pro_id[$i]'";
            $result_quantity = $db->link->query($update_quantity);     
           
            
            
        }else{
            echo 2;
            echo $db->link->error;
        }
        
    }
    //insert into accounts as a credit balance
    if($totalPrice != 0){
        $query_1 = "SELECT serial FROM accounts order by id DESC limit 1";
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

            $insert_accounts = "INSERT INTO accounts (reference_no, serial, payer_name, amount, description, receiver_id, transaction_type) VALUES ('$invoice_no', '$serial', 'buyer_name', '$totalPrice', 'product_sale', '$userStatusId', 'credit')";
    
            $query = $db->link->query($insert_accounts);
    }
    
     if($buyerType == "agent"){
         $add_agent_ladger = "insert into agent_ladger (agent_id, transaction_type, plant_no, goods_description, amount, entry_by, status) values ('$buyer_id','debit', '$invoice_no', 'buy_product' , '$agentTotalPrice','$userStatusId','1')";
        $add_agent_ladger = $db->link->query($add_agent_ladger);
     }
    
    $insert_invoice = "insert into invoice_no(invoice_no,status) values ('$invoice_no','1')";
    $insert_invoice = $db->link->query($insert_invoice);  
    
    if($result_quantity){
                echo $invoice_no;
            }else{
                echo 0;
            }
    
    
}*/




if(isset($_POST['plantIdFromEditPlant'])){
    
    $plantTableId = $_POST['plantIdFromEditPlant'];
    
//    $query = "SELECT *FROM biogas_plant WHERE disbursement_no = '$disbursmentID'";
      $query = "SELECT biogas_plant.*, agent.name FROM biogas_plant LEFT JOIN agent ON biogas_plant.`assigned_by` = agent.id WHERE biogas_plant.id = '$plantTableId'";
    
    $result = $db->link->query($query);
    
    $plantInfo = $result->fetch_array();
    
//    print_r($plantInfo);
    echo json_encode($plantInfo);    
//    print_r($result);    
    
}

if(isset($_POST['modalPlantDateName'])){
    
//    $formInfo = $_POST['formInfo'];    
    
    $plantTableID = $_POST['hiddenModalPlantTableIdName'];
    
        
    $plant_no = $_POST['modalPlantIdName'];
    $disbursement_no = $_POST['modalDisbursementNoName'];
    $plant_owner_name = $_POST['modalPlantOwnerName'];
    $nid = $_POST['modalNidName'];
    $dob = $_POST['modalDobName'];
    $contact_no = $_POST['modalContactName'];
    $assignee_type = $_POST['modalPlantAssignByName'];
    $assigned_by = $_POST['modalAgentName'];
    $status = $_POST['modalUpdateStatusName'];
    
    
        
    if($status == 0){
        $update_plant = "UPDATE `biogas_plant` SET `nid` = '$nid', `dob` = '$dob', `status` = '$status', offered_amount = -(offered_amount) , plant_no = '$plant_no', disbursement_no = '$disbursement_no'  WHERE `biogas_plant`.`id` = '$plantTableID'";    
        $result_update_plant = $db->link->query($update_plant);        
        
    }else{
        $update_plant = "UPDATE `biogas_plant` SET `nid` = '$nid', `dob` = '$dob', `status` = '$status', plant_no = '$plant_no', disbursement_no = '$disbursement_no'  WHERE `biogas_plant`.`id` = '$plantTableID'";    
        $result_update_plant = $db->link->query($update_plant);        
        
    }
    
//    if($result_update_plant){
//        echo 1;
//    }else{
//        echo 0;
//    }
}

if(isset($_POST['agentDetails'])){
    $agentId = $_POST['agentDetails'];
    
    $agentDetails = "select *from agent_ladger where agent_id = '$agentId'";
    $agentResult = $db->link->query($agentDetails);
    
    ?>
<table id="totalStatement" class="table table-striped table-bordered table-hover table-full-width" style="width:100%">
    <thead>
        <tr>
            <th style="text-align:center">Date</th>
            <th style="text-align:center">Invoice No.</th>
            <th style="text-align:center">Description</th>

            <th style="text-align:center">Credit</th>
            <th style="text-align:center">Debit</th>

            <th style="text-align:center">Balance</th>
        </tr>
    </thead>
    <tbody>
        <?php
    
    $totalBalance = 0;
    
    while($result = $agentResult->fetch_array()){
        
?>



        <tr>
            <td style="text-align:center"><?php echo date('d-m-Y',strtotime($result['entry_date']))?></td>
            <td style="text-align:center"><?php echo $result['plant_no'];?></td>
            <td style="text-align:center"><?php echo $result['goods_description'];?></td>
            <?php
                if($result['transaction_type'] == "credit"){
                    
                $totalBalance = $totalBalance + $result['amount'];
            ?>
            <td style="text-align:center"><?php echo number_format($result['amount'],2);?></td>
            <td style="text-align:center"><?php echo "--"?></td>
            <?php
                    }else{
                    $totalBalance = $totalBalance - $result['amount'];
                    ?>
            <td style="text-align:center"><?php echo "--"?></td>
            <td style="text-align:center"><?php echo number_format($result['amount'],2);?></td>
            <?php
                }
            ?>

            <td style="text-align:center"><?php echo number_format($totalBalance,2);?></td>
        </tr>


        <?php
    }?>
    </tbody>
</table>
<?php 
    
}

if(isset($_POST['agentName'])){
    $agentId = $_POST['agentName'];
    
    $agentDetails = "select name from agent where id = '$agentId'";
    $agentResult = $db->link->query($agentDetails);
    
    $agentName = $agentResult->fetch_assoc();
    
    echo $agentName['name'];
    
}

if(isset($_POST['agent_contact1'])){
    $agentContact_1 = $_POST['agent_contact1'];
    
    $checkContact = "SELECT *FROM agent where contact1 = '$agentContact_1' or contact2 = '$agentContact_1'";
    $checkContact2 = $db->link->query($checkContact);
    
    if($checkContact2->num_rows>0){
        echo 1;
    }else{
        echo 0;
    }
 }


if(isset($_POST['invoiceCheck'])){
    $invoiceNo = $_POST['invoiceCheck'];
    
    $checkInvoice = "SELECT *FROM sale_history where invoice_no = '$invoiceNo'";
    $checkInvoice = $db->link->query($checkInvoice);
    
//    $checkInvoice = $checkInvoice->fetch_row();
    
    if($checkInvoice->num_rows>0){
        echo 1;
    }else{
        echo 0;
    }
    
    
}



if(isset($_POST['oldInvoiceNo'])){
    $invoiceNo = $_POST['oldInvoiceNo'];
    
//    $saleInvoice = "SELECT *FROM sale_history where invoice_no = '$invoiceNo'";
    $saleInvoice = "SELECT sale_history.*, product_stock.product_id AS product FROM sale_history LEFT JOIN product_stock ON sale_history.product_id = product_stock.product_id WHERE sale_history.invoice_no  = '$invoiceNo'";
    $saleInvoice = $db->link->query($saleInvoice);
    
    $sl = "1";
    
    while($row = $saleInvoice->fetch_assoc()){       
    
    ?>
<tr>
    <td style="text-align: center;" width="84">
        <p><?php echo $sl; ?></p>
    </td>
    <td style="text-align: center;" width="167">
        <p><?php echo $row['product'];?></p>
    </td>
    <td style="text-align: center;" width="125">
        <p><?php echo $row['quantity'];?></p>
    </td>
    <td style="text-align: right;" width="125">
        <p><?php echo number_format($row['unit_price'],2);?></p>
    </td>
    <td style="text-align: right;" width="125">
        <p><?php echo number_format($row['total_price'],2);?>&nbsp;</p>
    </td>
</tr>


<?php
      $sl++;  
    }
}



if(isset($_POST['oldInvoiceNoData'])){
    $invoiceNo = $_POST['oldInvoiceNoData'];
    
//    $saleInvoice = "SELECT *FROM sale_history where invoice_no = '$invoiceNo'";
    $saleInvoice = "SELECT SUM(total_price) AS grandTotal, buyer_id, buyer_name, DATE(sale_date) AS sale_date,invoice_no FROM sale_history where invoice_no = '$invoiceNo'";
    $saleInvoice = $db->link->query($saleInvoice);
    
    $result = $saleInvoice->fetch_array();
    echo json_encode($result);
}

if(isset($_POST['joinDateS'])){
    $joiningDate = $_POST['joinDateS'];
    
    $month = date('m', strtotime($joiningDate));
    $year = date('y', strtotime($joiningDate));
    
    $employeeId = "SELECT id FROM user ORDER BY id DESC LIMIT 1";
    $employeeId = $db->link->query($employeeId);
    
    $employeeId = $employeeId->fetch_row();
    
    if($employeeId[0]<10){
        $employeeId = "0".$employeeId[0];
    }else{
        $employeeId = $employeeId[0];
    }
    
    echo "SC".$year.$month.$employeeId;
//    echo ++$employeeId;
}

if(isset($_POST['districtIdForPoliceStation'])){
    $districtId = $_POST['districtIdForPoliceStation'];
    
//    echo $districtId;
    $policeStattionWQuery = "SELECT *FROM police_station WHERE district_id = '$districtId'";
    $policeStationQuery = $db->link->query($policeStattionWQuery);
//    $policeStations = array();
    
    while($row = $policeStationQuery->fetch_array()){
        ?>
<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
<?php
    }
    
}

?>
