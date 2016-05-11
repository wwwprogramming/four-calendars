<?php

class SharedRequest {
    
   
    public static function getDate() {
        $date = null;
        if (isset($_GET['date'])) {
            $date = $_GET['date'];
        }
        return $date;
    }
    
    
    
    public static function getEventId() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        return $id;
    }
    
    
}