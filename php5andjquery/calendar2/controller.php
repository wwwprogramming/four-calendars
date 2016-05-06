<?php

require ROOT_PATH. DIRECTORY_SEPARATOR . "actions" . DIRECTORY_SEPARATOR . "GetCalendars.php";
require ROOT_PATH. DIRECTORY_SEPARATOR . "actions" . DIRECTORY_SEPARATOR . "GetCategories.php";
require ROOT_PATH. DIRECTORY_SEPARATOR . "actions" . DIRECTORY_SEPARATOR . "GetEvents.php";
require ROOT_PATH. DIRECTORY_SEPARATOR . "actions" . DIRECTORY_SEPARATOR . "GetEvent.php";

class CalendarAppController {
    
    private $action;
    
    public function __construct($action) {
        $this->action = $action;
    }
    
    public function run() {
     // session or request
        
        
        
        //$eventsHelper = new EventsHelper($events->getEventsFor($activeCalendars, $activeCategories));   
        switch($this->action) {
            case "getevents": 
                $catIds = isset($_GET['catId']) ? $_GET['catId']: array();
                $calIds = isset($_GET['calId']) ? $_GET['calId']: array();
                
                $returnObj = 
                        GetEventsAction::getInstance()
                        ->getEvents($_GET['start'], $_GET['end'], $_GET['tz'],$calIds, $catIds);
                $this->doReturn(array("events" =>$returnObj));
                break;
            case "getevent":
                $returnObj = 
                        GetEventAction::getInstance()
                        ->getEvent($_GET['start'], $_GET['id']);
                $this->doReturn(array("event" =>$returnObj));
                
                break;
            case "getcalendars":
                $returnObj = GetCalendarsAction::getInstance()->getCalendars();
                $this->doReturn(array("calendars" =>$returnObj));
                break;
            
            case "getcategories":
                $returnObj = GetCategoriesAction::getInstance()->getCategories();
                $this->doReturn(array("categories" =>$returnObj));
                break;
            default;
                $returnObj1 = GetCalendarsAction::getInstance()->getCalendars();
                $returnObj2 = GetCategoriesAction::getInstance()->getCategories();
                $this->doReturn(array("calendars" => $returnObj1, "categories" => $returnObj2));
            
            
        }
        
        
    }
    
    protected function doReturn($forObj) {
        $payload = json_encode($forObj);
        header("Content-Type: application/json");
//        header("Content-Length: " + strlen($payload));
        echo $payload;
    }
    
    
    
}