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
?>