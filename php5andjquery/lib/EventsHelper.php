<?php

class EventsHelper{
    
    private $events = array();
    
    public function __construct($validEvents = array()) {
        $this->events = $validEvents;
    }
    
    public function getEventsFor($start, $end) {
        //echo "$start, $end<br />";
        $dateEvents = array();
        $compstart = strtotime($start);
        $compend = strtotime($end);
        /* @var $event Event */
        // var_dump($this->events);
        foreach ($this->events as $event) {
            // $obj->start = date("Y-m-d\\TH:i:s", $unixstart);
            $eventstart = strtotime($event->start);
            $eventend = strtotime($event->end);
            //echo "{$event->start} {$event->end} <br />";
            if ($eventstart >= $compstart && $eventstart <= $compend) {
                $dateEvents[] = $event;
            } else if ($eventend <= $compend && $eventend >= $compstart) {
                $dateEvents[] = $event;
            }
        }
        
        return $dateEvents;
    }
    
    public function getEvent($id) {
        foreach ($this->events as $event) {
            if (intval($event->id) === intval($id)) {
                return $event;
            }
        }
        return null;
        
    }
    
}