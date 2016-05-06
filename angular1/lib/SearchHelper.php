<?php

class SearchHelper {
    
   
    private $allCalendars = array(
        1 => "Tampere",
        "Nokia",
        "Ylöjärvi",
        "Pirkkala"
        
    );
    
    
    private $allCategories = array(
        1 => "Elokuvat",
        "Näyttelyt",
        "Konsertit",
        "Muu taide"       
    );
    
    
    
    public function __construct() {
        
    }
    
   
    function getAllCalendars() {
        return $this->allCalendars;
    }

   
    function getAllCategories() {
        return $this->allCategories;
    }
    
}
