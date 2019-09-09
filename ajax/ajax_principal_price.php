<?php
require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database();
$ndb = new Database();


function getPrice($zone, $weight, $type){
    $dbf = new Database();
    $sql = "SELECT price FROM general_price WHERE zone='$zone' AND weight='$weight' AND goods_type='$type'";
    $query = $dbf->link->query($sql);
    if($query->num_rows > 0){
        $row = $query->fetch_row();
        return $row[0];
    }else{
        return "0";
    }
}


if(isset($_POST['update_price'])){
    $zone = $_POST['update_price'];
    
    ?>

<form action="" onsubmit="updatePrice(event)">
<input type="hidden" name="zone" value="<?php echo $zone; ?>">
<div class="row">
    <div class="col-md-12">
        <div class="#">
            <div style="font-weight:bold; padding-bottom:5px;">SET PRICE FOR DOCUMENT</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-addon"><?php echo '0.25 kg'; ?></span>
                    <input type="hidden" value="<?php echo 0.25; ?>" name="d_weight[]">
                    <input type="text" class="form-control" name="d_price[]" placeholder="0" value="<?php echo getPrice($zone, "0.25", "D"); ?>">
                </div>
            </div>
            <?php
                                                
                                                
                                                
                                        for($i=0.50; $i<=3.00; $i+=0.50){
                                    ?>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-addon"><?php echo number_format($i, 2).' kg'; ?></span>
                    <input type="hidden" value="<?php echo $i; ?>" name="d_weight[]">
                    <input type="text" class="form-control" name="d_price[]" placeholder="0" value="<?php echo getPrice($zone, number_format($i, 2), "D"); ?>">
                </div>
            </div>
            <?php
                                        }
                                    ?>


        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="#">
            <div style="font-weight:bold; padding-bottom:5px;">SET PRICE FOR PARCEL</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <?php
                                    $sqlW = "SELECT * FROM tbl_weight WHERE status='1' ORDER BY weight ASC";
                                    $queryW = $db->link->query($sqlW);
                                    if($queryW->num_rows > 0){
                                        while($rowW = $queryW->fetch_assoc()){
                                    ?>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-addon"><?php echo $rowW['weight'].' kg'; ?></span>
                    <input type="hidden" value="<?php echo $rowW['weight']; ?>" name="p_weight[]">
                    <input type="text" class="form-control" name="p_price[]" placeholder="0" value="<?php echo getPrice($zone, $rowW['weight'], "P"); ?>">
                </div>
            </div>
            <?php
                                        }
                                    }
                                    ?>


        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <button id="submit_zone_price" type="submit" class="btn btn-lg btn-warning btn-block">SUBMIT</button>
        </div>
    </div>
</div>

</form>

<?php
}

if(isset($_POST['zone'])){
    $zone = $_POST['zone'];
    
    $d_weight = $_POST['d_weight'];
    $d_price = $_POST['d_price'];
    
    $p_weight = $_POST['p_weight'];
    $p_price = $_POST['p_price'];
    
    $ch = 0;
    
    
    
    $dltSQL = "DELETE FROM general_price WHERE zone='$zone'";
    $dltResult = $db->link->query($dltSQL);
    
    if($dltResult){
        $ch = 1;
    }
    
    if($ch == 1){
        
        for($i=0; $i<count($d_weight); $i++){
            $weight = $d_weight[$i];
            $price = $d_price[$i];
            
            if($i==0){
                $ma_sql = "INSERT INTO general_price (zone, weight, price, goods_type) VALUES ('$zone', '$weight', '$price', 'D');";
            }else if($i == count($d_weight)-1){
                $ma_sql .= "INSERT INTO general_price (zone, weight, price, goods_type) VALUES ('$zone', '$weight', '$price', 'D')";
            }else{
                $ma_sql .= "INSERT INTO general_price (zone, weight, price, goods_type) VALUES ('$zone', '$weight', '$price', 'D');";
            }
        }
        
        if($db->link->multi_query($ma_sql) === TRUE) {
            $ch++;
        }
        
        
        
        for($j=0; $j<count($p_weight); $j++){
            $weight = $p_weight[$j];
            $price = $p_price[$j];
            
            if($j==0){
                $ma_sql_p = "INSERT INTO general_price (zone, weight, price, goods_type) VALUES ('$zone', '$weight', '$price', 'P');";
            }else if($j == count($p_weight)-1){
                $ma_sql_p .= "INSERT INTO general_price (zone, weight, price, goods_type) VALUES ('$zone', '$weight', '$price', 'P')";
            }else{
                $ma_sql_p .= "INSERT INTO general_price (zone, weight, price, goods_type) VALUES ('$zone', '$weight', '$price', 'P');";
            }
        }
        
        if($ndb->link->multi_query($ma_sql_p) === TRUE) {
            $ch++;
        }
        
        echo $ch;
        
    }else{
        echo $ch;
    }
}

?>
