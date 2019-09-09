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

if(isset($_POST['oldPasswordCheck'])){
    $oldPassEntry = md5($_POST['oldPasswordCheck']);
    
    //get password for user table
    $getPassword = "SELECT password FROM user WHERE userId = '$userStatusId'";
    $getPass = $db->link->query($getPassword);
    
    $row = $getPass ->fetch_row();
    $oldPassword = $row[0];
    
    if($oldPassEntry == $oldPassword){        
    echo 1;
    }else{
        echo 0;
    }
    
}

if(isset($_POST['newPasswordCheck'])){
    $password = $_POST['newPasswordCheck'];
    
    if( strlen($password ) < 8 ) {
        $error = 1;
        }else if( strlen($password ) > 20 ) {
        $error = 2;
        }else if( strlen($password ) < 8 ) {
        $error = 3;
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

//update password
if(isset($_POST['oldPass'])){
    $oldPass = md5($_POST['oldPass']);
    $newPass = md5($_POST['newPass']);
    $confirmPass = md5($_POST['confirmPass']);
    
//    echo $confirmPass;
    //select old pass from user table
    $getOldPass = "SELECT password FROM user WHERE userId = '$userStatusId'";
    $getPass = $db->link->query($getOldPass);
    $row = $getPass->fetch_row();
    
    $pass = $row[0];
//    echo $pass;
    
    if($pass == $oldPass){
        if($newPass == $confirmPass){
            $update = "UPDATE user SET password = '$newPass' WHERE userId = '$userStatusId'";
            $up = $db->link->query($update);
            echo 1;
        }else{
            echo 2;
        }
    }else{
        echo 3;
    }
}

?>
