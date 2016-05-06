<?php

class GetEventAction{
    
    protected function __construct() {
        ;
    }
    
    public static function getInstance() {
        return new static();
    }
    
    public function getEvent($start, $id) {
        $dateHelper = new DateHelper($start);
        $firstDayOfMonth = $dateHelper->firstOfMonth();
        $lastDayOfMonth = $dateHelper->lastOfMonth();
        
        $events = new Events($firstDayOfMonth,$lastDayOfMonth);
        
        $eventsHelper = new EventsHelper($events->getAllEvents());
        return $eventsHelper->getEvent($id);
    }
    
    
}


