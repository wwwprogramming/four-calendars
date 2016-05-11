<?php

class ApplicationConfiguration{
    
    
    protected function __construct() {
        ;
    }
    
    public static function getInstance() {
        return new static();
    }
    
    
    
}