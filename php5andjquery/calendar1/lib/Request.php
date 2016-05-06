<?php
require LIB_PATH . DS . "SharedRequest.php";

class Request extends SharedRequest {
    
    public static function getCalenders() {
        if (isset($_SESSION['calendars'])) {
           $calendars = $_SESSION['calendars'];
        } else {
            $calendars = array();
        }
        
        if (isset($_GET['calendar'])) {
            $calendarid = $_GET['calendar'];
        
            $action = isset($_GET['action']) ? $_GET['action'] : "add";
        
            switch ($action) {
                case "add":
                    $calendars[] = $calendarid;
                    break;
                case "remove": 
                    if(($key = array_search($calendarid, $calendars)) !== false) {
                        unset($calendars[$key]);
                    }
                    break;
            }
        }
        $_SESSION['calendars'] = $calendars;
        return $calendars;
    }
    
    
    public static function getCategories() {
        if (isset($_SESSION['categories'])) {
            $categories = $_SESSION['categories'];
        } else {
            $categories = array();
        }
        
        if (isset($_GET['category'])) {
            $categoryid = $_GET['category'];
        
            $action = isset($_GET['action']) ? $_GET['action'] : "add";
        
            switch ($action) {
                case "add":
                    $categories[] = $categoryid;
                    break;
                case "remove": 
                    if(($key = array_search($categoryid, $categories)) !== false) {
                        unset($categories[$key]);
                    }
                    break;
            }
        }
        $_SESSION['categories'] = $categories;
        return $categories;
    }
    
    
}
