<!DOCTYPE html>
<html>
    <head>
        <title>Calendar Example Static Event</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Latest compiled and minified CSS -->
        <script
            src="https://code.jquery.com/jquery-2.2.3.js"
            integrity="sha256-laXWtGydpwqJ8JA+X9x2miwmaiKhn8tVmOVEigRNtP4="
        crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <style>

            /* calendar */
            table.calendar		{ border-left:1px solid #999; }
            tr.calendar-row	{  }
            td.calendar-day	{ min-height:80px; font-size:11px; position:relative; } * html div.calendar-day { height:80px; }
            td.calendar-day:hover	{ background:#eceff5; }
            td.calendar-day-np	{ background:#eee; min-height:80px; } * html div.calendar-day-np { height:80px; }
            td.calendar-day-head { background:#ccc; font-weight:bold; text-align:center; width:120px; padding:5px; border-bottom:1px solid #999; border-top:1px solid #999; border-right:1px solid #999; }
            div.day-number		{ background:#999; padding:5px; color:#fff; font-weight:bold; float:right; margin:-5px -5px 0 0; width:20px; text-align:center; }

            div.day-current { background-color: #46b8da }
            span.day-current { background-color: #46b8da }
            span.event {
                width:100%;
                display:block;
            }

            /* shared */
            td.calendar-day, td.calendar-day-np { width:120px; padding:5px; border-bottom:1px solid #999; border-right:1px solid #999; }
        </style>

    </head>
    <body>

        <div class="container-fluid">

        </div>


        <div class="container-fluid">
            <h1 class="page-header">Calendar Application</h1>
            <div class="row">
                <div class="col-sm-4 col-md-2 sidebar">
                    <a href="calendar.php?date=<?php echo date('Y-m-d' , strtotime($currentEvent->start)) ?>">&lt;&lt; Calendar</a>       
                </div>

                <div class="col-sm-8 col-md-10 main">
                    <table style="background-color: <?php echo $currentEvent->backgroundColor  ?>; color: <?php echo $currentEvent->color ?>">
                        <tr><th>Id</th><td><?php echo $currentEvent->id ?></td></tr>
                        <tr><th>Title</th><td><?php echo $currentEvent->title ?></td></tr>
                        <tr><th>Category</th><td><?php echo $currentEvent->category ?></td></tr>
                        <tr><th>Calendar</th><td><?php echo $currentEvent->calendar ?></td></tr>
                        <tr><th>Start</th><td><?php echo $currentEvent->start ?></td></tr>
                        <tr><th>End</th><td><?php echo $currentEvent->end ?></td></tr>
                        
                    </table>
                    
                </div>

            </div>
        </div>

    </body>
</html>

