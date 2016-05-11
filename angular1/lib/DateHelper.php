<?php

class DateHelper {
    
    private $time;
    private $date;
    private $day;
    private $month;
    private $year;
    
    public function __construct($date) {
        $this->time = strtotime($date);
        $this->date = $date;
        list($year, $month, $day) = explode("-", $date);
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
        
    }
    
    public function getDate() {
        return $this->date;
    }
    
    public function getDay() {
        return $this->day;
    }
    
    public function getMonth() {
        return $this->month;
    }
    
    public function getYear() {
        return $this->year;
    }
    
    public function nextYear() {
        $month = (int)ltrim($this->month, "0");
        $day = (int)ltrim($this->day, "0");
        $year = $this->year;
        $oneMore = mktime(12, 0, 0, $month, $day, $year +1);
        
        return date("Y-m-d", $oneMore);
    }
    
    public function prevYear() {
        $month = (int)ltrim($this->month, "0");
        $day = (int)ltrim($this->day, "0");
        $year = $this->year;
        $oneLess = mktime(12, 0, 0, $month, $day, $year -1);
        
        return date("Y-m-d", $oneLess);
    }
    
    
    public function prevMonth() {
        $month = (int)ltrim($this->month, "0");
        $day = (int)ltrim($this->day, "0");
        $year = $this->year;

        $oneLess = mktime(12, 0, 0, $month -1, $day, $year);
        list($year2, $month2, $day2) = explode("-", date('Y-n-j', $oneLess));
        if ($day2 != $day) {
            // decreased 2 months. get the corect month and the last day
                    $oneLess = mktime(12, 0, 0, $month -1, 15, $year);
                return date("Y-m-t", $oneLess);
                    
        }
        
        
        return date("Y-m-d", $oneLess);
    }
    
    public function nextMonth() {
        $month = (int)ltrim($this->month, "0");
        $day = (int)ltrim($this->day, "0");
        $year = $this->year;
        $oneMore = mktime(12, 0, 0, $month + 1, $day, $year);        
        list($year2, $month2, $day2) = explode("-", date('Y-n-j', $oneMore));
        if ($day2 != $day) {
            // increased 2 months. get the corect month and the last day
                    $oneMore = mktime(12, 0, 0, $month +1, 15, $year);
                return date("Y-m-t", $oneMore);
                    
        }
        
        return date("Y-m-d", $oneMore);
    }
    
        public function prevDay() {
        $month = (int)ltrim($this->month, "0");
        $day = (int)ltrim($this->day, "0");
        $year = $this->year;
        $oneLess = mktime(12, 0, 0, $month, $day -1, $year);
        return date("Y-m-d", $oneLess);
    }
    
    public function nextDay() {
        $month = (int)ltrim($this->month, "0");
        $day = (int)ltrim($this->day, "0");
        $year = $this->year;
        $oneMore = mktime(12, 0, 0, $month, $day + 1, $year);        
        return date("Y-m-d", $oneMore);
    }
    
    public function firstOfMonth() {
        return date('Y-m-01', strtotime($this->date));
    }
    
    public function lastOfMonth() {
        return date('Y-m-t', strtotime($this->date));
    }
     
    public function isCurrent($date) {
        return $this->date === $date;
    }
    
}