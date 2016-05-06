<?php

include dirname(__FILE__) . DS.  "Event.php";

class Events {
    
    public $events = array();
    
    
    public function __construct($startDate, $endDate,$activeCategories = array(), $activeCalendars = array()) {
        // try to get from cache
        $dateHelper = new DateHelper($startDate);
        $firstDateOfMonth = $dateHelper->firstOfMonth();
        $lastDateOfMonth = $dateHelper->lastOfMonth();
        
        $dateHelper2 = new DateHelper($endDate);
        $firstDateOfMonth2 = $dateHelper2->firstOfMonth();
        $lastDateOfMonth2 = $dateHelper2->lastOfMonth();
        
        
        while (strtotime($firstDateOfMonth) <= strtotime($firstDateOfMonth2)) {
                
            if (file_exists(CACHE_PATH . $firstDateOfMonth . ".json")) {
                $events = json_decode(file_get_contents(CACHE_PATH . $firstDateOfMonth . ".json"));
            } else {
                // create 100 and cache
                $events = array();
                for ($i = 0; $i<50; $i++) {
                    $event = Event::getRandom($firstDateOfMonth, $lastDateOfMonth);
                $events[] = $event;

                }
                file_put_contents(CACHE_PATH . $firstDateOfMonth . ".json", json_encode($events));
            }
            $this->events = array_merge($this->events, $events);
            
            $nextMonth = $dateHelper->nextMonth();
            $dateHelper = new DateHelper($nextMonth);
            $firstDateOfMonth = $dateHelper->firstOfMonth();
            $lastDateOfMonth = $dateHelper->lastOfMonth();
        }
    }
    
    public function getEventsFor($calendasr=array(), $categories=array()) {
        $validEvents = array();

        foreach ($this->events as $event) {
            if ( in_array($event->category, $categories) && in_array($event->calendar, $calendasr)) {
                $validEvents[] = $event;
            }
        }
        return $validEvents;

    }
    
    public function getAllEvents() {
        return $this->events;
    }
    
}