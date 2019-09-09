<?php
require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database();
$ndb = new Database();

function getLastId(){
    
        $dbf = new Database();
    
        $getId = "SELECT remote_id FROM remote_area ORDER BY id DESC LIMIT 1";
        $sqlId = $dbf->link->query($getId);
        $rowId = $sqlId->fetch_row();
        return $rowId[0]+1;
}


if(isset($_POST['add_remote_country'])){
    
    $add_remote_country = $_POST['add_remote_country'];
    $add_remote_zip_code = $_POST['add_remote_zip_code'];
    $add_remote_city = strtoupper($_POST['add_remote_city']);
    $add_cour_company = $_POST['add_cour_company'];
    
    $input_by = Session::get('adminId');
    
    $checkSql = "SELECT id FROM remote_area WHERE principal_id='$add_cour_company' AND country='$add_remote_country' AND zip_code='$add_remote_zip_code' AND city='$add_remote_city'";
    
    $checkResult = $db->link->query($checkSql);
    
    if($checkResult->num_rows > 0){
        echo "0";
    }else{
        
        $getId = "SELECT remote_id FROM remote_area ORDER BY id DESC LIMIT 1";
        $sqlId = $db->link->query($getId);
        $rowId = $sqlId->fetch_row();
        
        $id = getLastId();
        
        $sql = "INSERT INTO remote_area (principal_id, remote_id, country, zip_code, city, input_by, status) VALUES ('$add_cour_company', '$id', '$add_remote_country', '$add_remote_zip_code', '$add_remote_city', '$input_by', '1')";
        $query = $db->link->query($sql);

        if($query){
            ?>
<tr class="remote_add">
    <td>
        <?php echo $add_remote_country; ?>
    </td>
    <td>
        <?php echo $add_remote_zip_code; ?>
    </td>
    <td>
        <?php echo $add_remote_city; ?>
    </td>
    <td>
        <div id="selected_country">
            <a onclick="removeBtn(event);" id="<?php echo $id; ?>">REMOVE</a>
        </div>
    </td>
</tr>

<?php
        }else{
            echo "1";
        }
    }
    
    
    
}


if(isset($_POST['delete'])){
    $delete = $_POST['delete'];
    $sql = "DELETE FROM remote_area WHERE remote_id='$delete'";
    $query = $db->link->query($sql);
    
    if($query){
        echo "1";
    }else{
        echo "0";
    }
}


if(isset($_POST['get_remote_price'])){
    $get_remote_price = $_POST['get_remote_price'];
    
    $sql = "SELECT * FROM remote_area WHERE principal_id='$get_remote_price' AND status='1'";
    $query = $db->link->query($sql);
    $i=1;
    
    while($row = $query->fetch_assoc()){
        ?>

<tr class="remote_add">
    <td><?php echo $i; ?></td>
    <td><?php echo $db->getCountryName($row['country']); ?></td>
    <td><?php echo $row['zip_code']; ?></td>
    <td><?php echo $row['city']; ?></td>
    <td>
        <div id="selected_country">
            <a onclick="removeBtn(event);" id="<?php echo $row['remote_id']; ?>">REMOVE</a>
        </div>
    </td>
</tr>

<?php
        
        $i++;
    }
    
}


if(isset($_POST['getextracost'])){
    $getextracost = $_POST['getextracost'];
    
    $sql = "SELECT surcharge FROM surcharge WHERE principal_id='$getextracost'";
    $query = $db->link->query($sql);
    if($query->num_rows > 0){
        $row = $query->fetch_row();
        echo $row[0];
    }else{
        echo 0;
    }
}


if(isset($_POST['extracost'])){
    
    $extracost = $_POST["extracost"];
    $principal = $_POST["principal"];
    
    $check = "SELECT id FROM surcharge WHERE principal_id='$principal'";
    $cQuery = $db->link->query($check);
    if($cQuery->num_rows > 0){
        $sql = "UPDATE surcharge SET surcharge='$extracost' WHERE principal_id='$principal'";
        $query = $db->link->query($sql);
        if($query){
            echo "1";
        }else{
            echo $db->link->error;
        }
    }else{
        $sql = "INSERT INTO surcharge (principal_id, surcharge, status) VALUES ('$principal', '$extracost', '1')";
        $query = $db->link->query($sql);
        if($query){
            echo "1";
        }else{
            echo $db->link->error;
        }
    }
}

if(isset($_POST['match_city_id'])){
    
    $id = $_POST['match_city_id'];
    $pid = $_POST['pid'];
    
    
    $sql = "SELECT * FROM consignment_booking WHERE id='$id'";
    $query = $db->link->query($sql);
    $row = $query->fetch_assoc();
    
    $match_zip = $row['r_zip'];
    $match_city = $row['r_city'];
    $match_country = $row['r_country'];
    
    $fa = substr($match_city, 0, 2);
    $la = substr($match_city, -2);

    
    $sql = "SELECT city FROM remote_area WHERE principal_id='$pid' AND country='$match_country' AND zip_code='$match_zip' AND (city LIKE '$fa%' AND city LIKE '%$la') LIMIT 10";
    $query = $db->link->query($sql);
    
    if($query->num_rows > 0){
        
        ?>
<style>
    .badge {
        font-size: unset;
        font-style: italic;
    }

</style> 
<p>SUGGESTION:
        <?php
        
        while($row = $query->fetch_assoc()){
            ?>
            <span class="badge badge-pill badge-danger"><?php echo $row['city']; ?></span>
            <?php
        }
        ?>
</p>
        <?php
    }
    
}





?>
