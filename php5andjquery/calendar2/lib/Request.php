<?php
require LIB_PATH . DS . "SharedRequest.php";

class Request extends SharedRequest {
    
     public static function getCalendarId() {
        $calendarid = null;
        if (isset($_GET['calendar'])) {
            $calendarid = $_GET['calendar'];
        }
        return $calendarid;
    }
    
    public static function getCategoryId() {
        $categoryid = null;
        if (isset($_GET['category'])) {
            $categoryid = $_GET['category'];
        
        }
        return $categoryid;
    }
    
}
