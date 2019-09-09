<?php 
include('includes/header.php'); 
//include('classes/Agent.php'); 
error_reporting(E_ALL);
    
    $productList = "SELECT * FROM product_stock order by branch_id ASC";
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

function getBranchName($branchId){
        $db = new Database();
        
        $branchName = "SELECT branch_name from tbl_branch where branch_id = '$branchId'";
        $staffNameR = $db->link->query($branchName);
        
        $result = $staffNameR ->fetch_row();
        
        return $result[0];
    }
function getBranchContact($branchId){
        $db = new Database();
        
        $branchName = "SELECT branch_contact from tbl_branch where branch_id = '$branchId'";
        $staffNameR = $db->link->query($branchName);
        
        $result = $staffNameR ->fetch_row();
        
        return $result[0];
    }
function getBranchManager($branchId){
        $db = new Database();
        
        $branchName = "SELECT user.name from user LEFT JOIN branch_managers ON branch_managers.branch_id = user.branch_name where branch_managers.branch_id = '$branchId'";
        $staffNameR = $db->link->query($branchName);
        
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
                            ALL PRODUCT LIST
                        </div>

                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover table-full-width" id="allProductList">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">SL</th>
                                        <th style="text-align:center">PRODUCT NAME</th>
                                        <th style="text-align:center">AVAILABLE STOCK</th>
                                        <th style="text-align:center">BRANCH NAME</th>
                                        <th style="text-align:center">BRANCH CONTACT</th>
                                        <th style="text-align:center">MANAGER'S NAME</th>
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
                                        <td style="text-align:center"><?php echo $row['quantity']; ?></td>
                                        <td style="text-align:center"><?php echo getBranchName($row['branch_id']); ?></td>
                                        <td style="text-align:center"><?php echo getBranchContact($row['branch_id']); ?></td>
                                        <td style="text-align:center"><?php echo getBranchManager($row['branch_id']); ?></td>

                                        
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
