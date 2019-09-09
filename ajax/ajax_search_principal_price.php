<?php
require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database();


if(isset($_POST['country'])){
    $country = $_POST['country'];
    $weight = $_POST['weight'];
    
    $dt = 0;
    
    
    $slPrincipal = "SELECT * FROM principals_name";
    $qrPrincipal = $db->link->query($slPrincipal);
    
    $lowest_price = array();
    $lowest_costing = array();
    $lowest_p_id = array();
    $i=0;
    
    while($rowPrincipla = $qrPrincipal->fetch_assoc()){
        $principal_id = $rowPrincipla['id'];
        $principal_name = $rowPrincipla['principal_name'];
        $slZone = "SELECT zone FROM principal_zone WHERE country_tag='$country' AND principal_id='$principal_id'";
        $qrZone = $db->link->query($slZone);
        $rowZone = $qrZone->fetch_row();
        
        $zone = $rowZone[0];
        
        
        $slPrice = "SELECT price FROM principal_price WHERE principal_id='$principal_id' AND zone='$zone' AND weight='$weight' AND goods_type='D' AND price > 0";
        $qrPrice = $db->link->query($slPrice);
        
        if($qrPrice->num_rows > 0){
            
            $dt = 1;
            
            while($rowPrice = $qrPrice->fetch_assoc()){
                $lowest_price[$i] = $rowPrice['price'];
                $lowest_costing[$i] = $db->getPrincipalCosting($principal_id, $rowPrice['price'], $weight);
                $lowest_p_id[$i] = $principal_id;
                $i++;
            }
     
            
        }
    }
    
    
    if($dt == 1){        
    
            array_multisort($lowest_costing, $lowest_price, $lowest_p_id);
        
        ?>

<style>
    th {
        background-color: orange !important;
    }

</style>

<div class="all_price">
    <table class="table table-striped table-bordered table-hover">
        <caption style="text-align: left">DOCUMENT PRICE LIST</caption>
        <tr>
            <th>Principal Name</th>
            <th>Weight</th>
            <th>Rate (Based Currency)</th>
            <th>Rate (USD)</th>
            <th>Costing (USD)</th>
            <th>Costing (BDT)</th>
        </tr>

        <?php
    
    $j=0;
    while($j < count($lowest_price)){
        if($j==0){
            ?>
        <tr style="font-size: 18px;background-color: yellow;color: red; font-weight: bold;">
            <td title="Lowest Price"><?php echo $db->getPrincipalName($lowest_p_id[$j]); ?></td>
            <td><?php echo $weight; ?></td>
            <td><?php echo $lowest_price[$j].' '.$db->getCurrencyName($lowest_p_id[$j]); ?></td>
            <td><?php echo number_format($db->converttousd($lowest_p_id[$j], $lowest_price[$j]), 2); ?></td>
            <td><?php echo $lowest_costing[$j]; ?></td>
            <td><?php echo $db->converttobdt("USD", $lowest_costing[$j]); ?></td>
        </tr>
        <?php
        }else{
            ?>
        <tr>
            <td><?php echo $db->getPrincipalName($lowest_p_id[$j]); ?></td>
            <td><?php echo $weight; ?></td>
            <td><?php echo $lowest_price[$j].' '.$db->getCurrencyName($lowest_p_id[$j]); ?></td>
            <td><?php echo number_format($db->converttousd($lowest_p_id[$j], $lowest_price[$j]), 2); ?></td>
            <td><?php echo $lowest_costing[$j]; ?></td>
            <td><?php echo $db->converttobdt("USD", $lowest_costing[$j]); ?></td>
        </tr>
        <?php
        }
        
        
        $j++;
    }
    
?>

    </table>
</div>
<?php
        
    }
    
    
    
    $pt = 0;
    
    
    $slPrincipal = "SELECT * FROM principals_name";
    $qrPrincipal = $db->link->query($slPrincipal);
    
    $lowest_price = array();
    $lowest_costing = array();
    $lowest_p_name = array();
    
    $i=0;
    
    while($rowPrincipla = $qrPrincipal->fetch_assoc()){
        $principal_id = $rowPrincipla['id'];
        $principal_name = $rowPrincipla['principal_name'];
        $slZone = "SELECT zone FROM principal_zone WHERE country_tag='$country' AND principal_id='$principal_id'";
        $qrZone = $db->link->query($slZone);
        $rowZone = $qrZone->fetch_row();
        
        $zone = $rowZone[0];
        
        
        $slPrice = "SELECT price FROM principal_price WHERE principal_id='$principal_id' AND zone='$zone' AND weight='$weight' AND goods_type='P' AND price > 0";
        $qrPrice = $db->link->query($slPrice);
        
        if($qrPrice->num_rows > 0){
            
            $pt = 1;
            
            while($rowPrice = $qrPrice->fetch_assoc()){
                $lowest_price[$i] = $rowPrice['price'];
                $lowest_costing[$i] = $db->getPrincipalCosting($principal_id, $rowPrice['price'], $weight);
                $lowest_p_id[$i] = $principal_id;
                $i++;
            }
     
            
        }
    }
    
    
    if($pt == 1){
        
    array_multisort($lowest_costing, $lowest_price, $lowest_p_id);
       
        ?>

<style>
    th {
        background-color: orange !important;
    }

</style>

<div class="all_price">
    <table class="table table-striped table-bordered table-hover">
        <caption style="text-align: left">PARCEL PRICE LIST</caption>
        <tr>
            <th>Principal Name</th>
            <th>Weight</th>
            <th>Rate (Based Currency)</th>
            <th>Rate (USD)</th>
            <th>Costing (USD)</th>
            <th>Costing (BDT)</th>
        </tr>

        <?php
    
    $j=0;
    while($j < count($lowest_price)){
        if($j==0){
            ?>
        <tr style="font-size: 18px;background-color: yellow;color: red; font-weight: bold;">
            <td title="Lowest Price" ><?php echo $db->getPrincipalName($lowest_p_id[$j]); ?></td>
            <td><?php echo $weight; ?></td>
            <td><?php echo $lowest_price[$j].' '.$db->getCurrencyName($lowest_p_id[$j]); ?></td>
            <td><?php echo number_format($db->converttousd($lowest_p_id[$j], $lowest_price[$j]), 2); ?></td>
            <td><?php echo $lowest_costing[$j]; ?></td>
            <td><?php echo $db->converttobdt("USD", $lowest_costing[$j]); ?></td>
        </tr>
        <?php
        }else{
            ?>
        <tr>
            <td><?php echo $db->getPrincipalName($lowest_p_id[$j]); ?></td>
            <td><?php echo $weight; ?></td>
            <td><?php echo $lowest_price[$j].' '.$db->getCurrencyName($lowest_p_id[$j]); ?></td>
            <td><?php echo number_format($db->converttousd($lowest_p_id[$j], $lowest_price[$j]), 2); ?></td>
            <td><?php echo $lowest_costing[$j]; ?></td>
            <td><?php echo $db->converttobdt("USD", $lowest_costing[$j]); ?></td>
        </tr>
        <?php
        }
        
        
        $j++;
    }
    
?>

    </table>
</div>
<?php
        
    }
    
}



?>
