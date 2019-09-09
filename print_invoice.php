<?php
    include("lib/Database.php");
//    include('includes/header.php'); 
    session_start();

    $db = new Database();

    $serial = 1;
    $grandTotalPrice = 0;
    $buyerId = "";
    $buyerType = "";

    $invoiceNo = "";
    $refInvoice = "nil";
    $currentUser = $_SESSION['adminId'];
//    $currentUser = "SC190701";

    if(isset($_GET['id'])){
        $invoiceNo = $_GET['id']; 
        
        $invoiceNoQ = "select *from sale_history where invoice_no = '$invoiceNo'";
        $invoiceResult1 = $db->link->query($invoiceNoQ);
        $invoiceResult2 = $db->link->query($invoiceNoQ);
        $invoiceResult3 = $db->link->query($invoiceNoQ);
        
//        $invoiceNo2 = "select *from sale_history where invoice_no = '$invoiceNo'";
//        $invoiceResult2 = $db->link->query($invoiceNo2);
//        
        if($invoiceResult1->num_rows == 0){
            header('location: index.php');
        }
    }else{
        header('location: index.php');        
    }

//    echo $invoiceNo;
    

    while($row = $invoiceResult1->fetch_array()){
        $buyerId = $row['buyer_id'];
        $buyerType = $row['buyer_type'];
        $buyerName = $row['buyer_name'];
        $entry_by = $row['entry_by'];
        $refInvoice = $row['reference_invoice'];
    }

        
// 

    function getProductName($id){
        $db = new Database();
        $getProductName = "SELECT product_stock.*, product_name.name FROM product_stock LEFT JOIN product_name ON product_stock.product_id = product_name.id where product_stock.product_id = '$id'";
        $getProductName = $db->link->query($getProductName);
        
        $name = $getProductName->fetch_assoc();
        return $name['name'];
    }

    function getBranchName($employeeId){
        $db = new Database();
        $getBranchName = "SELECT user.branch_name, tbl_branch.branch_name FROM user LEFT JOIN tbl_branch ON user.branch_name = tbl_branch.branch_id WHERE user.userId = '$employeeId'";
        $getBranchName = $db->link->query($getBranchName);
        
        $name = $getBranchName->fetch_row();
        return $name[1];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Print Invoice</title>
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
    <style>
        body {
            background-color: whitesmoke;
            width: 100%;
            float: left;
            font-family: "Times New Roman", Times, serif;

        }

        /*
        .printMain {
            padding: 10px;
            background: #fff;
            width: 100vh;
            min-height: 842px;
            margin: 0 auto;
            box-shadow: 0px 0px 40px 6px rgba(0, 0, 0, 0.3);
        }

        .printHeader {
            width: 595px;
            min-height: 75px;
        }

        #printInvoice {
            font-family: "Times New Roman", Times, serif;
            font-weight: 50;
        }
*/

        .printBody {
            width: 100%;

        }

        .printBody table {
            margin: 0 auto;
            background: white;

        }

    </style>

</head>

<body>

    <div class="printMain" style="margin-left: 50%; left: -313px; position: relative; display: flex; flex-direction: column;">

        <div class="printBody" style="flex: 1;">
            <table width="626">
                <tbody>
                    <tr>
                        <td colspan="5" width="626">
                            <p style="text-align: center;"><u>INVOICE</u></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" width="626">
                            <p style="text-align: center; padding:0; margin:0">Success Renewable Energy Limited</p>
                            <p style="text-align: center; padding-bottom:20px">Ati Bazar, Kerani Gonj, Dhaka-1216</p>
                        </td>
                    </tr>

                    <tr>
                        <td width="84" colspan="2" style="padding-left:30px;">
                            Agent ID: <?php echo sprintf('%04d',$buyerId);?><br>
                            Name: <?php echo $buyerName;?><br>
                            Branch Name: <?php echo getBranchName($currentUser);?>
                        </td>

                        <td width="125">
                            <p>&nbsp;</p>
                        </td>
                        <td width="125" colspan="2" style="text-align:right; padding-right:30px;">
                            Invoice No: <?php echo $invoiceNo;?><br>
                            Date: <?php echo date('d-m-Y');?><br>
                            <?php 
                            if($refInvoice != ""){
                                echo  "Ref. invoice: ".$refInvoice;
                                }
                            ?>
                        </td>

                    </tr>


                    <tr>
                        <td></td>
                        <td width="84">

                        </td>
                        <td width="125">
                            
                                <?php
                            if($refInvoice != ""){
                                  ?><kbd><?php echo"RETURN INVOICE";?></kbd>
                                <?php
                                }
                            ?>
                            
                        </td>
                        <td width="125">

                        </td>
                    </tr>


                    <tr style="border-bottom:1px dashed black">
                        <td style="text-align: center;" width="84">
                            <p><strong>SL.</strong></p>
                        </td>
                        <td style="text-align: center;" width="167">
                            <p><strong>Product Name</strong></p>
                        </td>
                        <td style="text-align: center;" width="125">
                            <p><strong>Quantity</strong></p>
                        </td>
                        <td style="text-align: right;" width="125">
                            <p><strong>Unit Price</strong></p>
                        </td>
                        <td style="text-align: right;" width="125">
                            <p><strong>Total Price&nbsp;</strong></p>
                        </td>
                    </tr>

                    <!--                    Print all Product from sale_history-->
                    <?php
                        while($row =$invoiceResult2->fetch_array() ){
                            ?>
                    <tr>
                        <td style="text-align: center;" width="84">
                            <p><?php echo $serial?></p>
                        </td>
                        <td style="text-align: center;" width="167">
                            <p><?php echo getProductName($row['product_id'])?></p>
                        </td>
                        <td style="text-align: center;" width="125">
                            <p><?php echo $row['quantity'];?></p>
                        </td>
                        <td style="text-align: right;" width="125">
                            <p><?php echo number_format($row['unit_price'],2);?></p>
                        </td>
                        <td style="text-align: right;" width="125">
                            <p><?php echo number_format($row['total_price'],2);
                                $grandTotalPrice = $grandTotalPrice + $row['total_price'];
                                ?>&nbsp;</p>
                        </td>
                    </tr>
                    <?php
                            $serial++;
                        }
                    ?>

                    <tr style="border-top:1px dashed black">
                        <td style="text-align: center;" width="84">
                            <p><strong>&nbsp;</strong></p>
                        </td>
                        <td width="167">
                            <p><strong>&nbsp;</strong></p>
                        </td>
                        <td width="125">
                            <p><strong>&nbsp;</strong></p>
                        </td>
                        <td width="125">
                            <p style="text-align: right;"><strong>Grand Total</strong></p>
                        </td>
                        <td style="text-align: right;" width="125">
                            <p><strong><?php echo number_format($grandTotalPrice,2); ?>&nbsp;</strong></p>
                        </td>
                    </tr>


                </tbody>
            </table>
            <p>&nbsp;</p>
        </div>

        <!--        second part of invoice-->

        <div class="printBody" style="flex: 1; ">
            <table width="626">
                <tbody>
                    <tr>
                        <td colspan="5" width="626">
                            <p style="text-align: center;"><u>INVOICE</u></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" width="626">
                            <p style="text-align: center; padding:0; margin:0">Success Renewable Energy Limited</p>
                            <p style="text-align: center; padding-bottom:20px">Ati Bazar, Kerani Gonj, Dhaka-1216</p>
                        </td>
                    </tr>

                    <tr>
                        <td width="84" colspan="2" style="padding-left:30px;">
                            Agent ID: <?php echo sprintf('%04d',$buyerId);?><br>
                            Name: <?php echo $buyerName;?><br>
                            Branch Name: <?php echo getBranchName($currentUser); $serial = 1;?>
                        </td>

                        <td width="125">
                            <p>&nbsp;</p>
                        </td>

                        <td width="125" colspan="2" style="text-align:right; padding-right:30px;">
                            Invoice No: <?php echo $invoiceNo;?><br>
                            Date: <?php echo date('d-m-Y');?><br>
                            <?php 
                            if($refInvoice != ""){
                                echo  "Ref. invoice: ".$refInvoice;
                                }
                            ?>
                        </td>

                    </tr>


                    <tr>
                        <td></td>
                        <td width="84">

                        </td>
                        <td width="125">
                            
                                <?php
                            if($refInvoice != ""){
                                  ?><kbd><?php echo"RETURN INVOICE";?></kbd>
                                <?php
                                }
                            ?>
                            
                        </td>
                        <td width="125">
                        </td>
                    </tr>



                    <tr style="border-bottom:1px dashed black">
                        <td style="text-align: center;" width="84">
                            <p><strong>SL.</strong></p>
                        </td>
                        <td style="text-align: center;" width="167">
                            <p><strong>Product Name</strong></p>
                        </td>
                        <td style="text-align: center;" width="125">
                            <p><strong>Quantity</strong></p>
                        </td>
                        <td style="text-align: right;" width="125">
                            <p><strong>Unit Price</strong></p>
                        </td>
                        <td style="text-align: right;" width="125">
                            <p><strong>Total Price&nbsp;</strong></p>
                        </td>
                    </tr>

                    <!--                    Print all Product from sale_history-->
                    <?php
                        while($row =$invoiceResult3->fetch_array() ){
                            ?>
                    <tr>
                        <td style="text-align: center;" width="84">
                            <p><?php echo $serial?></p>
                        </td>
                        <td style="text-align: center;" width="167">
                            <p><?php echo getProductName($row['product_id'])?></p>
                        </td>
                        <td style="text-align: center;" width="125">
                            <p><?php echo $row['quantity'];?></p>
                        </td>
                        <td style="text-align: right;" width="125">
                            <p><?php echo number_format($row['unit_price'],2);?></p>
                        </td>
                        <td style="text-align: right;" width="125">
                            <p><?php echo number_format($row['total_price'],2);
//                                $grandTotalPrice = $grandTotalPrice + $row['total_price'];
                                ?>&nbsp;</p>
                        </td>
                    </tr>
                    <?php
                            $serial++;
                        }
                    ?>

                    <tr style="border-top:1px dashed black">
                        <td style="text-align: center;" width="84">
                            <p><strong>&nbsp;</strong></p>
                        </td>
                        <td width="167">
                            <p><strong>&nbsp;</strong></p>
                        </td>
                        <td width="125">
                            <p><strong>&nbsp;</strong></p>
                        </td>
                        <td width="125">
                            <p style="text-align: right;"><strong>Grand Total</strong></p>
                        </td>
                        <td style="text-align: right;" width="125">
                            <p><strong><?php echo number_format($grandTotalPrice,2); ?>&nbsp;</strong></p>
                        </td>
                    </tr>


                </tbody>
            </table>
            <p>&nbsp;</p>
        </div>
        <!--        second part of invoice-->

    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="assets/printThis.js"></script>

</body>

</html>
<script>
    $('.printMain').printThis();

</script>
