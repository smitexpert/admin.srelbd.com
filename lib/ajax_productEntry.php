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
//-------------------


if(isset($_POST['product_id'])){
    $buy_date = $_POST['buy_date'];
    $product_id = $_POST['product_id'];
    $chalan_no = $_POST['chalan_no'];
    $quantity = $_POST['quantity'];
    $buy_price = $_POST['buy_price'];
    $sale_price = $_POST['sale_price'];
    $company_id = $_POST['company_id'];
    $branch_id = $_POST['branch_id'];
    $description = $_POST['description'];
    
    $insert = "INSERT INTO product_stock (product_id, chalanNo, quantity, buy_price, sale_price, company_id, branch_id, description, buy_date, entry_by) VALUES ('$product_id', '$chalan_no', '$quantity','$buy_price','$sale_price', '$company_id', '$branch_id', '$description', '$buy_date', '$userStatusId')";
      
    $query = $db->link->query($insert);

    if($query){
        echo 1;
    }else{
        echo $db->link->error;
    }
 

}