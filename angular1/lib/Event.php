<?php

class Event {
    // http://fullcalendar.io/docs/event_data/Event_Source_Object/#options
    public $start;
    public $end;
    public $title;
    public $color;
    public $backgroundColor;
    public $category;
    public $calendar;
    
    
    public static function getRandom($mindate, $maxdate) {
        // randomly add hours to mindate and then add random numer of hours
        $unixstart = strtotime($mindate);
        $unixmax = strtotime($maxdate);
        // hours between these two
        $hoursbetween = ($unixmax - $unixstart) / 3600;
        
        $unixstart += (rand(1,$hoursbetween * 2)) * 3600 * 0.5; //
        
        $unixend = $unixstart + (rand(1,8)) * 3600 * 0.5;
        
        $obj = new static();
        $rand = rand(1,40000);
        $obj->id = $rand;
        $obj->start = date("Y-m-d\\TH:i:s", $unixstart);
        $obj->end = date("Y-m-d\\TH:i:s", $unixend);
        $obj->title = "TITLE-" . $rand;
        $obj->color = "#33DD33";
        $obj->backgroundColor = "#000000";
        $obj->calendar = rand(1,4);
        $obj->category = rand(1,4);
        return $obj;
        
    }
}