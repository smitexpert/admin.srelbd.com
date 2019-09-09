<?php

/*include('Database.php');*/

function getTrackingId(){
    
     $db = New Database();

    $date = date('y').date('m');

    $query = "SELECT tracking_id FROM tracking_id WHERE date='$date' ORDER BY id DESC LIMIT 1";

    $result = $db->link->query($query);

    $row = $result->fetch_row();

    if($result->num_rows == 0){
        $num = 1;
        $num_padded = sprintf("%06d", $num);
        $insert = "INSERT INTO tracking_id (date, tracking_id) VALUES ('$date', '$num_padded')";
        $insertQuery = $db->link->query($insert);

        if($insertQuery){
            echo $date.$num_padded;
        }else{
            echo $db->link->error;
        }
    }else{
        $num = $row[0]+1;

        $num_padded = sprintf("%06d", $num);
        $insert = "INSERT INTO tracking_id (date, tracking_id) VALUES ('$date', '$num_padded')";
        $insertQuery = $db->link->query($insert);

        if($insertQuery){
            echo $date.$num_padded;
        }else{
            echo $db->link->error;
        }
    }


}

?>
