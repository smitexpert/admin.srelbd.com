<?php 
include('includes/header.php'); 
error_reporting(E_ALL);

//if (isset($_POST['submit'])) {
//$createStuffs = $Stuffset->insertStuff($_POST);
//}

$getUserId = new Database();
$db = new Database();

// Designation Query Start

$designationQuery = "SELECT * FROM user_rule WHERE status=1";    
$ruleResult = $db->select($designationQuery);


$query = "SELECT id FROM user ORDER BY id DESC LIMIT 1";
$result = $getUserId->select($query);

$productName = "SELECT * FROM product_name ORDER BY name ASC";
$productQueryResult = $db->select($productName);

$productCompanyResult = "SELECT *FROM product_company_name";
$productCompanyResult = $db->select($productCompanyResult);

$branchProduct = "SELECT *FROM tbl_branch WHERE branch_status = 1";
$branchProduct = $db->select($branchProduct);

while($row = $result->fetch_assoc()){
    $lastId = $row['id']+1;
}

$yearMonth = date('y').date('m');

if($lastId < 10){
    $lastId = '0'.$lastId;
}

//get branch id from user table by using employee id

$getBranchName = "SELECT branch_name FROM user WHERE userId = '$userId'";
$getBranchId = $db->link->query($getBranchName);

while($row = $getBranchId->fetch_row()){
    $branchId = $row[0];
}

// Designation Query End


/*
$dashboardMenuQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='dashboard'";
$dashboardMenuCount = $db->count($dashboardMenuQuery);


$creationMenuQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='creation-area'";
$creationMenuCount = $db->count($creationMenuQuery);

*/



?>

<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>

    <div class="main-content">

        <div class="container"><br><br>
            <div id="printSuccess"></div>
            <form action="" id="product_entry">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-12">

                        <div class="panel panel-default">
                            <div class="panel-heading bdOrange">
                                <i class="fa fa-external-link-square"></i>NEW PRODUCT ENTRY
                                <!--                                <div class="panel-tools"><a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a><a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal"><i class="fa fa-wrench"></i></a><a class="btn btn-xs btn-link panel-refresh" href="#"><i class="fa fa-refresh"></i></a><a class="btn btn-xs btn-link panel-expand" href="#"><i class="fa fa-resize-full"></i></a></div>-->
                            </div>


                            <div class="panel-body borderOrange">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Buy Date</label>
                                            <input type="text" class="form-control" name="buy_date" id="buy_date" value="<?php echo date("d-m-Y"); ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="productName" class="control-label">
                                                Select Product <span class="symbol required"></span>
                                            </label>
                                            <select name="product_id" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" required>
                                                <option value="">----</option>
                                                <?php
                                                 while($product = $productQueryResult->fetch_assoc()){
                                                     ?>

                                                <option value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></option>
                                                <?php
                                                             
                                                     }
                                                    ?>


                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" id="red">
                                            <label for="productCode" class="control-label">
                                                Chalan No. <span class="symbol required"></span>
                                            </label>
                                            <input type="text" class="form-control" name="chalan_no" id="chalan_no" required>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="quantity" class="control-label">
                                                Quantity <span class="symbol required"></span>
                                            </label>
                                            <input type="number" class="form-control" min="0" name="quantity" id="quantity" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="quantity" class="control-label">
                                                Buy Price <span class="symbol required"></span>
                                            </label>
                                            <input type="number" step="0.000001" class="form-control" min="0" name="buy_price" id="buy_price" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="quantity" class="control-label">
                                                Sale Price
                                            </label>
                                            <input type="number" step="0.000001" class="form-control" min="0" name="sale_price" id="sale_price" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="company_id" class="control-label">
                                                Select Company
                                            </label>
                                            <select name="company_id" id="company_id" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                <option value="0">Others</option>
                                                <?php
                                                if($productCompanyResult){ while($row = $productCompanyResult->fetch_assoc()){
                                                     ?>

                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['company_name']; ?></option>
                                                <?php
                                                             
                                                     }
                                                    
                                                }
                                                    ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="company_id" class="control-label">
                                                Select Branch
                                            </label>
                                            <select name="branch_id" id="branch_id" class="form-control selectpicker" data-show-subtext="true" data-live-search="fale">
                                                <?php
                                                 if($branchProduct){while($row = $branchProduct->fetch_assoc()){

                                                if($row['branch_id'] == $branchId){
                                                    ?>
                                                <option value="<?php echo $row['branch_id']; ?>" selected><?php echo $row['branch_name']; ?></option>
                                                <?php
                                                }else{
                                                    ?>
                                                    <option value="<?php echo $row['branch_id']; ?>"><?php echo $row['branch_name']; ?></option>
                                                    <?php
                                                }
                                                             
                                                     }
                                                     
                                                 }
                                                    ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="description" class="control-label">
                                                Description
                                            </label>
                                            <input type="text" class="form-control" name="description" id="description">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group connected-group">
                                            <input class="btn btn-md btn-green btn-block" type="submit" name="submit" value="submit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php 
include('includes/footer.php');
?>
<!--
<script type="text/javascript">
    jQuery(document).ready(function($) {

        // data table with pdf csv excel print copy
        table = $('#stufftbl').DataTable({

            // paging: false,
            // info: false,
            //  dom: 'Bfrtip',
            //       buttons: [
            //           'copy', 'csv', 'excel', 'pdf', 'print'
            //       ]
        });


    })

</script>
-->
