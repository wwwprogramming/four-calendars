<?php
session_start();

define("DS", DIRECTORY_SEPARATOR);
define("ROOT_PATH", dirname(__FILE__));
define("LIB_PATH",  ROOT_PATH . DS . "lib" );

define("CACHE_PATH", dirname(__FILE__). DS . "cache". DS);


require LIB_PATH . DS . "Request.php";
require LIB_PATH . DS . "Calendar.php";

require LIB_PATH . DS . "DateHelper.php";

require LIB_PATH . DS . "SearchHelper.php";
require LIB_PATH . DS . "Events.php";
require LIB_PATH . DS . "EventsHelper.php";

require "controller.php";

if (isset($_GET['action'])) {
    (new CalendarAppController($_GET['action']))->run();
} else {
    // default date is today
    $dateHelper = new DateHelper(date('Y-m-d'));
    $searchHelper = new SearchHelper();
    $activeDate = $dateHelper->getDate();
    include ROOT_PATH . DS. "tmpl" . DS . "master.php";
}
echo ob_get_clean();