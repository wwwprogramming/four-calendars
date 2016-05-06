<?php

session_start();
define("DS", DIRECTORY_SEPARATOR);
define("ROOT_PATH", dirname(__FILE__));
define("LIB_PATH",  realpath( dirname(__FILE__) . DS . ".." . DS . "lib") );
define("LIB_PATH_LOCAL" , ROOT_PATH . DS . "lib");
define("CACHE_PATH", dirname(__FILE__). DIRECTORY_SEPARATOR . "cache". DIRECTORY_SEPARATOR);


require LIB_PATH_LOCAL . DS . "Request.php";
require LIB_PATH . DS . "DateHelper.php";

require LIB_PATH_LOCAL . DS . "SearchHelper.php";
require LIB_PATH . DS . "Events.php";
require LIB_PATH . DS . "EventsHelper.php";



// session or request
$activeCalendars = Request::getCalenders();
$activeCategories = Request::getCategories();
$activeDate = Request::getDate();
$dateHelper = new DateHelper($activeDate);

$firstDayOfMonth = $dateHelper->firstOfMonth();
$lastDayOfMonth = $dateHelper->lastOfMonth();

$searchHelper = new SearchHelper($activeCalendars, $activeCategories, $activeDate);
$events = new Events($firstDayOfMonth, $lastDayOfMonth );
$eventsHelper = new EventsHelper($events->getAllEvents());

$currentEvent = $eventsHelper->getEvent(Request::getEventId());
include "tmpl" . DS . "event.php";