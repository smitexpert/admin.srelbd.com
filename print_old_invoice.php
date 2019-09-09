<?php 
include('includes/header.php'); 
//include('classes/Agent.php'); 
error_reporting(E_ALL);
    
    $productList = "SELECT * FROM  product_stock order by id ASC";
    $productList = $db->link->query($productList);

    function getStaffName($staffId){
        $db = new Database();
        
        $staffName = "SELECT name from user where userId = '$staffId'";
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
                            PRINT OLD INVOICE
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="oldInvoice" class="control-label">
                                            INVOICE NO. <span class="symbol required"></span>
                                        </label>
                                        <input type="text" class="form-control" name="oldInvoiceValue" id="oldInvoice" onfocusout="oldInvoice()" onkeyup="oldInvoice()" required>
                                        <div id="oldInvoiceAlert" style="display:none">invalid</div>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <button style="margin-top:22px;" type="button" class="btn btn-green btn-sm" id="oldInvoiceShow" disabled="">SHOW</button>
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <div class="form-group" id="printOldInvoice">
                                        <div class="printMain" style="margin-left: 50%; left: -313px; position: relative; display: flex; flex-direction: column;">
                                            <div class="printBody" style="flex: 1;">
                                                <table width="626">
                                                    <thead>
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
                                                            <td width="84">
                                                                <p style="text-align: right;">&nbsp;ID:</p>
                                                            </td>
                                                            <td width="167">
                                                                <p style="text-align: left;padding-left:5px;" id="buyer_id">&nbsp;Buyer ID</p>
                                                            </td>
                                                            <td width="125">
                                                                <p>&nbsp;</p>
                                                            </td>
                                                            <td width="125">
                                                                <p style="text-align: right;">Invoice No:</p>
                                                            </td>
                                                            <td width="125">
                                                                <p style="text-align: left;padding-left:5px;"><strong id="invoice_no">&nbsp;Invoice Number</strong></p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="84">
                                                                <p style="text-align: right;">Name:</p>
                                                            </td>
                                                            <td width="167">
                                                                <p style="text-align: left; padding-left:5px;" id="buyer_name">&nbsp;Buyer Name</p>
                                                            </td>

                                                            <td width="125">
                                                                <p>&nbsp;</p>
                                                            </td>
                                                            <td width="125">
                                                                <p style="text-align: right;">Date:</p>
                                                            </td>
                                                            <td width="125">
                                                                <p style="text-align: left; padding-left:5px;" id="sale_date">&nbsp;<?php echo date('d-m-Y');?></p>
                                                            </td>
                                                        </tr>


                                                        <tr>
                                                            <td width="84">
                                                                <p>&nbsp;</p>
                                                            </td>
                                                            <td width="167">
                                                                <p>&nbsp;</p>
                                                            </td>
                                                            <td width="125">
                                                                <p>&nbsp;</p>
                                                            </td>
                                                            <td width="125">
                                                                <p>&nbsp;</p>
                                                            </td>
                                                            <td width="125">
                                                                <p>&nbsp;</p>
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
                                                    </thead>
                                                    <tbody id="printAllProduct">

                                                    </tbody>
                                                    <tfoot>
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
                                                                <p><strong id="grandTotal" style="padding-left:5px;">Grand Total&nbsp;</strong></p>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                <p>&nbsp;</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    
                                </div>
                                <div class="col-md-2">
                                    <form><input type="submit" value="Print" class="btn btn-block btn-success" id="printButton" disabled></form>
                                </div>
                                   <div class="col-md-1">
                                    
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
