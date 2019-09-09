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

if(isset($_POST['staffUpdate'])){
    $staff_id = $_POST['staffUpdate'];
    
    //select all data from user table using by employee id
    $employeeDetails = "SELECT *FROM user WHERE userId = '$staff_id'";
    $getDetails = $db->link->query($employeeDetails);
    
    echo json_encode($getDetails->fetch_array());
    
}

if(isset($_POST['employeeId'])){
    $employeeId = $_POST['employeeId'];
    $employeeName = $_POST['employeeName'];
    $designation = $_POST['designation'];
    $empBranch = $_POST['empBranch'];
    $upEmail = $_POST['upEmail'];
    $upContact1 = $_POST['upContact1'];
    $upContact2 = $_POST['upContact2'];
    $upAddress = $_POST['upAddress'];
    
    //update employee information in user table
    $upEmployee = "UPDATE user SET name = '$employeeName',rule = '$designation', email = '$upEmail', contact1 = '$upContact1', contact2 ='$upContact2', address='$upAddress', branch_name='$empBranch' WHERE userId = '$employeeId'";
    
    $updateEmployee = $db->link->query($upEmployee);
    
    echo $updateEmployee;
}
?>
