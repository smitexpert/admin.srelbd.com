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
if(isset($_POST['agentId'])){
    $agentId = $_POST['agentId'];

    $agentInformation = "SELECT *FROM agent WHERE id = '$agentId'";
    $getAgentInfo = $db->link->query($agentInformation);

    echo json_encode($getAgentInfo->fetch_array());
}

if(isset($_POST['upAgentId'])){
    $upAgentId = $_POST['upAgentId'];
    $upAgentName = $_POST['upAgentName'];
    $upAgentEmail = $_POST['upAgentEmail'];
    $upAgentAssignTo = $_POST['upAgentAssignTo'];
    $upContact2 = $_POST['upContact2'];
    $upAddress = $_POST['upAddress'];

    //update agent information into agent table
    $upAgentInfo = "UPDATE agent SET name = '$upAgentName', address = '$upAddress', email = '$upAgentEmail', contact2 = '$upContact2', assignto = '$upAgentAssignTo' WHERE `agent`.`id` = '$upAgentId'";
    $update = $db->link->query($upAgentInfo);

    echo $update;
}



?>