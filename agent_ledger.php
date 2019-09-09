<?php 
include('includes/header.php');
	$query = "SELECT DISTINCT agent_id FROM agent_ladger";
    $result = $db->select($query);

    $id = 1;

    function getTotalPlant($id){
        $db = new Database();
        
        $queryTotalPlant = "SELECT count(id) FROM biogas_plant where assignee_type = 'agent' and assigned_by = '$id'";
        $result = $db->link->query($queryTotalPlant);
        
        $result2 = $result->fetch_row();
        
        return $result2[0];
    }

    function getTotalCredit($id){
        $db = new Database();
        
        $queryTotalPlant = "SELECT sum(amount) as debitTotal FROM agent_ladger where transaction_type = 'credit' and agent_id = '$id'";
        $result = $db->link->query($queryTotalPlant);
        
        $result2 = $result->fetch_assoc();
        
        return $result2["debitTotal"];
    }

    function getTotalDebit($id){
        $db = new Database();
        
        $queryTotalPlant = "SELECT sum(amount) as debitTotal FROM agent_ladger where transaction_type = 'debit' and agent_id = '$id'";
        $result = $db->link->query($queryTotalPlant);
        
        $result2 = $result->fetch_assoc();
        
        return $result2["debitTotal"];
    }

    function getTotalBalance($id){
        $db = new Database();
        
        $totalDebit = getTotalDebit($id);
        $totalCredit = getTotalCredit($id);
        
        $result = $totalCredit - $totalDebit;
        
        return $result;
    }

    function getAgentName($id){
        $db = new Database();
        
        $getName = "SELECT name from agent where id = '$id'";
        $getAgentName = $db->link->query($getName);
        
        $result = $getAgentName->fetch_row();
        
        return $result[0];
    }
?>
<!-- start: MAIN CONTAINER -->
<div class="main-container">
    <?php include('includes/sidebar-menu.php'); ?>
    <!-- start: PAGE -->
    <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container"><br><br>
            <!-- end: PAGE HEADER -->
            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            AGENT LADGER WINDOW
                        </div>

                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover table-full-width" id="agentDetails">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">SL</th>
                                        <th style="text-align:center">Agent Name</th>
                                        <th style="text-align:center">Total Plant</th>
                                        <th style="text-align:center">Total Credit</th>
                                        <th style="text-align:center">Total Debit</th>
                                        <th style="text-align:center">Balance</th>
                                        <th style="text-align:center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            if($result){
                                                while($row = $result->fetch_assoc()){
                                                
                                        ?>

                                    <tr>
                                        <td style="text-align:center"><?php echo $id ?></td>
                                        <td style="text-align:center"><?php echo getAgentName($row['agent_id']); ?></td>
                                        <td style="text-align:center"><?php echo getTotalPlant($row['agent_id']); ?></td>
                                        <td style="text-align:right"><?php echo number_format(getTotalCredit($row['agent_id']),2); ?></td>
                                        <td style="text-align:right"><?php echo number_format(getTotalDebit($row['agent_id']),2); ?></td>
                                        
                                        <td style="text-align:right; <?php 
                                                if(getTotalBalance($row['agent_id']) <0){
                                                    echo "color:red";
                                                }
                                                
                                                   ?>"><?php echo number_format(getTotalBalance($row['agent_id']),2); ?>
                                        </td>

                                        <td style="text-align:center" ;><button   title="Show Agent Details" type="button" class="btn btn-xs btn-teal editBtn" data-toggle="modal" data-target="#agentDetailsModal" id="<?php echo $row['agent_id']; ?>"><i class="fa fa-edit"></i></button>
                                        
                                        <a  title="Print" href="print_agent_details.php?id=<?php echo $row['agent_id']; ?>" class="btn btn-xs btn-teal printBtn" target="_blank"><i class="fa fa-print"></i></a>
                                        <a  title="Download PDF" href="pdf_agent_details.php?id=<?php echo $row['agent_id']; ?>" class="btn btn-xs btn-teal printBtn" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
                                        </td>
                                    </tr>

                                    <?php
                                                $id++;
                                            }
                                                
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
        <!-- end: PAGE CONTENT-->
    </div>
</div>
<!-- end: PAGE -->
<!--Start Modal code for editing Plant information-->
<div class="">
    <div class="modal modal-dialog modal-lg fade" id="agentDetailsModal" role="dialog">

        <!-- Modal content-->
        <div class="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Details of Agent :&nbsp;<span style="font-weight:bold" id="agentName"></span></h4>
            </div>
            <div class="modal-body">
                <!-- start: FORM VALIDATION 1 PANEL -->
                <div class="panel panel-default" id="upAgentDetails">
                    <table id="totalStatement_details" class="table table-striped table-bordered table-hover table-full-width" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align:center">Date</th>
                                <th style="text-align:center">Invoice No.</th>
                                <th style="text-align:center">Description</th>

                                <th style="text-align:center">Credit</th>
                                <th style="text-align:center">Debit</th>

                                <th style="text-align:center">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!--End Modal code for editing Plant information-->


<!-- end: MAIN CONTAINER -->


<?php 
include('includes/footer.php');
?>
