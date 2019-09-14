<?php
require __DIR__.'/Session.php';
require __DIR__.'/Database.php';

Session::checkSession();



$db = new Database;

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

if(isset($_POST['userIdUpdatePassGetName'])){
    $getName = $_POST['userIdUpdatePassGetName'];

    $getUserName = "SELECT name FROM user WHERE userId = '$getName'";
    $getName1 = $db->link->query($getUserName);

    $getName = $getName1->fetch_row();
    $getName = $getName[0];
    echo $getName;
}

if(isset($_POST['newPass_all_check'])){
    $password = $_POST['newPass_all_check'];
    
    if( strlen($password ) < 8 ) {
        $error = 1;
        }else if( strlen($password ) > 20 ) {
        $error = 2;
        }else if( !preg_match("#[0-9]+#", $password ) ) {
        $error = 4;
        }else if( !preg_match("#[a-z]+#", $password ) ) {
        $error = 5;
        }else if( !preg_match("#[A-Z]+#", $password ) ) {
        $error = 6;
        }else if( !preg_match("#\W|_#", $password ) ) {
        $error = 7;
        } else {
        $error = 0;
        }

    echo $error;
}

//check confirm password
if(isset($_POST['newPass_all'])){
    $newPass_all = md5($_POST['newPass_all']);
    $confirmPass_all = md5($_POST['confirmPass_all']);
    $userIdUpdate = $_POST['userIdUpdate'];

    echo $userIdUpdate." ";

    //update database passwor

    if($newPass_all == $confirmPass_all){
        $updatePass = "UPDATE user SET password = '$newPass_all' WHERE userId = '$userIdUpdate'";
        $up = $db->link->query($updatePass);

        if($up){
            echo $up;
        }
    }
}

?>