<?php

class GetCalendarsAction{
    
    protected function __construct() {
        ;
    }
    
    public static function getInstance() {
        return new static();
    }
    
    /**
     * 
     * @return array
     */
    public function getCalendars() {
        return (new SearchHelper())->getAllCalendars();
    }
    
    
}