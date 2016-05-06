<?php

class GetEventsAction{
    
    protected function __construct() {
        ;
    }
    
    public static function getInstance() {
        return new static();
    }
    
    public function getEvents($start, $end, $tz, $calendarIds, $categoryIds) {
        // TODO is start and end on different months... then get the whole range
        $offset = date('Y-m-d', strtotime($start));
        $limit = date('Y-m-d', strtotime($end));
        //echo $offset;
        $events = new Events($offset,$limit);
        if (empty($calendarIds)) $calendarIds = array();
        if (empty($categoryIds)) $categoryIds = array();
        
        $eventsHelper = new EventsHelper($events->getEventsFor($calendarIds, $categoryIds));
        return $eventsHelper->getEventsFor($offset, $limit);
    }
    
    
}
