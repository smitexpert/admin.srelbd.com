<?php
    include("lib/Database.php");

    $db = new Database();

    $agentId = $_GET['id'];
    
    $agentDetails = "select *from agent_ladger where agent_id = '$agentId'";
    $agentResult = $db->link->query($agentDetails);    
    
?>

    
    


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Print</title>    
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
<!--
    <style>
        body {
            background-color: whitesmoke;
        }

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



    </style>
-->
    
</head>

<body>
    <div class="printMain">
        <div class="printHeader">
        </div>
        <div class="printBody">
            <table id="printAgentLadger" class="table table-striped table-bordered table-hover table-full-width" style="width:100%">
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
                    <?php
    
    $totalBalance = 0;
    
    while($result = $agentResult->fetch_array()){
        
?>



                    <tr>
                        <td style="text-align:center"><?php echo date('d-m-Y',strtotime($result['entry_date']))?></td>
                        <td style="text-align:center"><?php echo $result['plant_no'];?></td>
                        <td style="text-align:center"><?php echo $result['goods_description'];?></td>
                        <?php
                if($result['transaction_type'] == "credit"){
                    
                $totalBalance = $totalBalance + $result['amount'];
            ?>
                        <td style="text-align:center"><?php echo number_format($result['amount'],2);?></td>
                        <td style="text-align:center"><?php echo "--"?></td>
                        <?php
                    }else{
                    $totalBalance = $totalBalance - $result['amount'];
                    ?>
                        <td style="text-align:center"><?php echo "--"?></td>
                        <td style="text-align:center"><?php echo number_format($result['amount'],2);?></td>
                        <?php
                }
            ?>

                        <td style="text-align:center"><?php echo number_format($totalBalance,2);?></td>
                    </tr>


                    <?php
    }?>
                </tbody>
            </table>
        </div>
        
    </div>  
    
    

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

</body>

</html>
<script>
$(document).ready(function() {
    $('#printAgentLadger').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend:'print',
                messageTop: null,
                filename:"srel",
                title:''
            }
        ]
    } );
} );
</script>
