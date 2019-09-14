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

//start code for get agent information from agent table
if(isset($_POST['debitItemId'])){
    $debitItemId = $_POST['debitItemId'];

    $getDebitItemInformation = "SELECT *FROM debit_item WHERE id = '$debitItemId'";
    $debitItemInfo = $db->link->query($getDebitItemInformation);

    echo json_encode($debitItemInfo->fetch_array());
}

if(isset($_POST['itemNameId'])){
    $itemNameId = $_POST['itemNameId'];
    $itemName = $_POST['itemName'];

    //update agent information into agent table
    $updateDebitItemName = "UPDATE debit_item SET item_name = '$itemName'  WHERE `debit_item`.`id` = '$itemNameId'";
    $update = $db->link->query($updateDebitItemName);

    echo $update;
}



?>