<?php 
include('includes/header.php'); 
//include('classes/Agent.php'); 
error_reporting(E_ALL);

    //get branch id from user table by using user id

    $getBranchName = "SELECT branch_name FROM user WHERE userId = '$userId'";
    $getBranchId = $db->link->query($getBranchName);

    while($row = $getBranchId->fetch_row()){
        $branchId = $row[0];
    }

//get branch name from tbl_branh table by using branch id

    $getBranchName1 = "SELECT branch_name FROM tbl_branch WHERE branch_id = '$branchId'";
    $getBranchName2 = $db->link->query($getBranchName1);

    while($row = $getBranchName2->fetch_row()){
        $branchName = $row[0];
    }
    
    $productList = "SELECT * FROM product_stock WHERE branch_id = '$branchId' order by id ASC";
    $productList = $db->link->query($productList);

    function getStaffName($staffId){
        $db = new Database();
        
        $staffName = "SELECT name from user where userId = '$staffId'";
        $staffNameR = $db->link->query($staffName);
        
        $result = $staffNameR ->fetch_row();
        
        return $result[0];
    }

function getProductName($productId){
        $db = new Database();
        
        $staffName = "SELECT name from product_name where id = '$productId'";
        $staffNameR = $db->link->query($staffName);
        
        $result = $staffNameR ->fetch_row();
        
        return $result[0];
    }

?>
<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>

    <div class="main-content">

        <div class="container"><br><br>

            <div class="row">
                <div class="col-md-12">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            ALL PRODUCT LIST OF <span style="color:green"><?= $branchName;?></span>
                        </div>

                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover table-full-width" id="productList">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">SL</th>
                                        <th style="text-align:center">PRODUCT NAME</th>
                                        <th style="text-align:center">CHALAN NO.</th>
                                        <th style="text-align:center">QUANTITY</th>
                                        <th style="text-align:center">BUY PRICE</th>
                                        <th style="text-align:center">SALE PRICE</th>
                                        <th style="text-align:center">DESCRIPTION</th>
                                        <th style="text-align:center">ENTRY BY</th>
                                        <th style="text-align:center">BUY DATE</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                                    $sl = 1;
                                    while ($row = $productList->fetch_assoc()) 
                                        {
                                    ?>
                                    <tr>
                                        <td style="text-align:center"><?php echo $sl; ?></td>
                                        <td style="text-align:center"><?php echo getProductName($row['product_id']); ?></td>
                                        <td style="text-align:center"><?php echo $row['chalanNo']; ?></td>
                                        <td style="text-align:center"><?php echo $row['quantity']; ?></td>
                                        <td style="text-align:center"><?php echo $row['buy_price']; ?></td>
                                        <td style="text-align:center"><?php echo $row['sale_price']; ?></td>
                                        <td style="text-align:center"><?php echo $row['description']; ?></td>
                                        <td style="text-align:center"><?php echo getStaffName($row['entry_by']); ?></td>
                                        <td style="text-align:center"><?php echo date('d-m-Y', strtotime($row['buy_date'])); ?></td>


                                    </tr>
                                    <?php
                                       $sl++;
                                     }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- end: FORM VALIDATION 1 PANEL -->
            </div>
        </div>
    </div>

</div>
<!--Start Modal code for editing Plant information-->

<!--End Modal code for editing Plant information-->



<?php 
include('includes/footer.php');
?>
<script type="text/javascript">
    jQuery(document).ready(function($) {

        // data table with pdf csv excel print copy
        table = $('#brnachtbl').DataTable({

            // paging: false,
            // info: false,
            //  dom: 'Bfrtip',
            //       buttons: [
            //           'copy', 'csv', 'excel', 'pdf', 'print'
            //       ]
        });


    })

</script>
