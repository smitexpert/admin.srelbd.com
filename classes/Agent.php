<?php

    public function getAgentName($id){
        $db = new Database();
        
        $getName = "SELECT name from agent where id = '$id'";
        $getAgentName = $db->link->query($getName);
        
        $result = $getAgentName->fetch_row();
        
        return $result[0];
    }
?>
