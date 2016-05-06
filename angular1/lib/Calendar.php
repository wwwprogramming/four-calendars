<?php

class Calendar {
    
    public function __construct() {
        ;
    }
    
    function renderLarge($month,$year){
        return "<div id='fullcalendar' data-month=$month data-year=$year'></div>";
}
 
    function renderSmall($month,$year){

	return "<div id='datepicker'></div>";
}
    
}