<?php

class SearchHelper {
    
   
    private $allCalendars = array(
        array("id" => 1 , "name" => "Tampere"),
        array("id" => 2, "name" => "Nokia"),
        array("id" => 3, "name" => "Ylöjärvi"),
        array("id" => 4, "name" => "Pirkkala")
        
    );
    
    
    private $allCategories = array(
        array("id" => 1 , "name" => "Elokuvat"),
        array("id" => 2, "name" => "Näyttelyt"),
        array("id" => 3, "name" => "Konsertit"),
        array("id" => 4, "name" => "Muu taide")
             
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
