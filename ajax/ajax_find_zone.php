<?php
require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database();
$ndb = new Database();


if($_POST['country_tag']){
    $country_tag = $_POST['country_tag'];
    
    $slP = "SELECT id, principal_name FROM principals_name";
    $rlP = $db->link->query($slP);
    $i=1;
    while($rowP = $rlP->fetch_assoc()){
        $pid = $rowP['id'];
        $pname = $rowP['principal_name'];
        
        $sql = "SELECT zone FROM principal_zone WHERE principal_id='$pid' AND country_tag='$country_tag'";
        $query = $db->link->query($sql);
        
        if($query->num_rows > 0){
            
            
            while($row = $query->fetch_assoc()){
                ?>
                <tr>
                    <th style="text-align: center;"><?php echo $i; ?></th>
                    <td><?php echo $pname; ?></td>
                    <td style="text-align: center;"><?php echo $row['zone']; ?></td>
                </tr>
                <?php
                
                $i++;
            }
        }
    }
}




?>