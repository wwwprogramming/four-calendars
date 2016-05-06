<?php

class SearchHelper {
    
    private $activeCalendars = array();
    
    private $allCalendars = array(
        1 => "Tampere",
        "Nokia",
        "Ylöjärvi",
        "Pirkkala"
        
    );
    
    private $activeCategories = array();
    
    private $allCategories = array(
        1 => "Elokuvat",
        "Näyttelyt",
        "Konsertit",
        "Muu taide"       
    );
    
    private $activeDate;
    
    public function __construct(array $calendars, array $categories) {
        $this->activeCalendars = $calendars;
        $this->activeCategories = $categories;
    }
    
    function getActiveCalendars() {
        return $this->activeCalendars;
    }

    function getAllCalendars() {
        return $this->allCalendars;
    }

    function getActiveCategories() {
        return $this->activeCategories;
    }

    function getAllCategories() {
        return $this->allCategories;
    }

    function getActiveDate() {
        return $this->activeDate;
    }

        
    public function isActiveCat($category) {
        return in_array($category, $this->activeCategories);
    }
    
    public function isActiveCal($calendar) {
        return in_array($calendar, $this->activeCalendars);
    }
    
    
    
    
}
