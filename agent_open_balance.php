<?php 
include('includes/header.php');    

    $getAgentName = "SELECT *FROM agent ORDER BY name ASC";
    $agentName = $db->link->query($getAgentName);

    //select agent balance from agent_ladger
    $select_opening_balance = "SELECT *FROM agent_ladger WHERE goods_description = 'Opening Balance' ORDER BY id DESC";
    $openingBalance = $db->link->query($select_opening_balance);

    $query_1 = "SELECT money_receipt_no FROM accounts ORDER BY id DESC LIMIT 1";
    $result_1 = $db->link->query($query_1);

    if($result_1->num_rows > 0){
        $last_serial = $result_1 ->fetch_row();
        $last_serial = substr($last_serial[0],-3);
        if($last_serial <999){
            $last_serial++;
            $last_serial = sprintf("%03d",$last_serial);          
        }else{
            $last_serial = "001";
        }
    }else{
        $last_serial = "001";
    }

    $dayMonthYear = date('d').date('m').date('y');

	$moneyReceiptNumber = "AD".$dayMonthYear.$last_serial;

    function getAgentName($id){
        $db = new Database();
        $getAgentName = "SELECT name FROM agent WHERE id = '$id'";
        $agentName = $db->link->query($getAgentName);
        $row = $agentName->fetch_row();
        return $row[0];
    }
    function getAgentContact($id){
        $db = new Database();
        $getAgentName = "SELECT contact1 FROM agent WHERE id = '$id'";
        $agentName = $db->link->query($getAgentName);
        $row = $agentName->fetch_row();
        return $row[0];
    }
    function getUserName($id){
        $db = new Database();
        $getUserName = "SELECT name FROM user WHERE userId = '$id'";
        $userName = $db->link->query($getUserName);
        $row = $userName->fetch_row();
        return $row[0];
    }

?>

<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>


    <!-- start: PAGE -->
    <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container"><br>
            <!-- end: PAGE HEADER -->
            <!-- end: PAGE HEADER -->
            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-12">
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="viewarea">
                                <div class="viewsec" id="CORPORATEVIEW">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <i class="fa fa-external-link-square"></i>
                                            AGENT OPENNING BALANCE
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="corporate_form_view">
                                                        <br>
                                                        <br>
                                                        <form method="POST" id="agent_opening_balance">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Money Receipt No.:<span class="symbol required"></span></label>
                                                                        <input type="text" class="form-control" value="<?=$moneyReceiptNumber ?>" name="agentOpenBalance" readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Date:</label>
                                                                        <input type="text" class="form-control" name="create_date" id="create_date" value="<?php echo date("d-m-Y"); ?>" required>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Reference No.:</label>
                                                                        <input type="text" class="form-control" name="referenceno" id="referenceno">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group" id="selectPlantAssignee">
                                                                        <label class="control-label">
                                                                            Agent Name: <span class="symbol required"></span>
                                                                        </label>
                                                                        <select name="agentName" id="agentName" class="form-control selectpicker"  data-show-subtext="true" data-live-search="true">
                                                                            <option value="">----</option>

                                                                            <?php
                                                                        while($row = $agentName->fetch_assoc()){
                                                                        ?>
                                                                            <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Amount(BDT):<span class="symbol required"></span></label>
                                                                        <input type="number" step="0.0001" class="form-control" name="amount" id="amount" min="0" required>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <br>
                                                                    <button class="btn btn-green btn-block" type="submit" id="agentOpenBalanceSubmit">SUBMIT</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            AGENT OPENING BALANCE
                        </div>

                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover table-full-width" id="brnachtbl">

                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th style="text-align:center" >AGENT NAME</th>
                                        <th style="text-align:center" >OPENING BALANCE</th>
                                        <th style="text-align:center" >CONTACT</th>
                                        <th style="text-align:center" >ENTRY DATE</th>
                                        <th style="text-align:center" >ENTRY BY</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php $i=0; if ($openingBalance) { 
                                        while ($row=$openingBalance->fetch_assoc()) {
                                            $i++; ?>
                                    <tr>
                                        <td class="center"><?php echo $i; ?></td>
                                        <td><?php echo getAgentName($row['agent_id']); ?></td>
                                        <td style="text-align:right"><?php echo number_format($row['amount'],2); ?></td>
                                        <td style="text-align:center" ><?php echo getAgentContact($row['agent_id']); ?></td>
                                        <td style="text-align:center" ><?php echo $row['entry_date']; ?></td>
                                        <td style="text-align:center" ><?php echo getUserName($row['entry_by']); ?></td>                                        
                                    </tr>
                                    <?php } }else{ } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- end: FORM VALIDATION 1 PANEL -->
            </div>

            <!-- end: PAGE CONTENT-->
        </div>
    </div>
    <!-- end: PAGE -->


</div>
<!-- end: MAIN CONTAINER -->


<?php 
include('includes/footer.php');
?>
