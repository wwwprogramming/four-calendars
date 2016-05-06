<?php

class GetCategoriesAction{
    
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
    public function getCategories() {
        return (new SearchHelper())->getAllCategories();
    }
    
    
}