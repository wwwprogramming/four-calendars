<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html  ng-app="calendarApp">
    <head>
        <title>Calendar Example Static</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script
            src="https://code.jquery.com/jquery-2.2.3.js"
            integrity="sha256-laXWtGydpwqJ8JA+X9x2miwmaiKhn8tVmOVEigRNtP4="
        crossorigin="anonymous"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.7.0/fullcalendar.css">


        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment-with-locales.js"
        ></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.7.0/fullcalendar.js"
        ></script>
        
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"
        ></script>

       <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular.min.js"></script>
       
       <script src="//angular-ui.github.io/ui-router/release/angular-ui-router.js"></script>
       
       <script src="media/js/ng-ui-bootstrap/ui-bootstrap-tpls-1.3.2.js"></script>

              <script src="media/js/ui-calendar-master/src/calendar.js"></script>

        <script src="application.js"></script>
        <script type="text/javascript">
            
            calendarApp.constant('appConfiguration',{
                "a": "b",
                "initPoint": "http://angular1.my/calendar.php?action=init",
                "eventsPoint": "http://angular1.my/calendar.php?action=getevents",
                "eventPoint": "http://angular1.my/calendar.php?action=getevent",
            });
                            
        </script>


    </head>
    <body ng-controller="ApplicationController">

        <div class="container-fluid">
            NAVI
            <pre>{{state.dt}}</pre>
        </div>

        <div ui-view='index'>
            <div ui-view="calendar"></div>
            <div ui-view="event"></div>
        </div><!-- viewMaster -->
        
        <script type="text/ng-template" id="/calendar.html">
            <div id="calendar_container" ng-controller="CalendarViewController"  class="container-fluid">
            
            <h1 class="page-header">Calendar Application</h1>
            <div class="row">
                <div ng-controller="CalendarSearchController" class="col-sm-4 col-md-4 sidebar">
                    <?php
                    include dirname(__FILE__) . DIRECTORY_SEPARATOR . "search.php";
                    ?>
                </div>
        
                <div class="col-sm-8 col-md-8 main" ng-controller="CalendarCtrl" >
                    <!--  calendar -->
                    <?php 
                    include dirname(__FILE__) . DIRECTORY_SEPARATOR . "calendar.php"; 
                    ?>
                </div>
            </div>
            </div>
            </script>
            
            <script type="text/ng-template" id="/event.html">
            <div ng-controller="EventViewController" id="event_container" class="container-fluid">
                <h1 class="page-header">Calendar Application Event</h1>
                <div class="row">
                    <div class="col-sm-4 col-md-2 sidebar">
                        <button id="showCalendar" ng-click="toCalendar()">&lt;&lt; Calendar</button>       
                    </div>

                    <div class="col-sm-8 col-md-10 main">
                        <table id="event_table" style="background-color: white; color: black">
                            <tr><th>Id</th><td id="event_ph_id">{{event.id}}</td></tr>
                            <tr><th>Title</th><td id="event_ph_title">{{event.title}}</td></tr>
                            <tr><th>Category</th><td id="event_ph_category">{{event.category}}</td></tr>
                            <tr><th>Calendar</th><td id="event_ph_calendar">{{event.calendar}}</td></tr>
                            <tr><th>Start</th><td  id="event_ph_start">{{event.start}}</td></tr>
                            <tr><th>End</th><td id="event_ph_end">{{event.end}}</td></tr>
                        </table>

                    </div>

                </div>
            </div>
            </script>
            
    </body>
</html>
