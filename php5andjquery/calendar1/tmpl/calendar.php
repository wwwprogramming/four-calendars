<h2 class="sub-header">Calendar </h2>
          <h3>
<a href="calendar.php?date=<?php echo $prevMonth ?>">&lt;</a> <?php echo date('F',strtotime($prevMonth)) ?>

[<?php echo date('F Y',strtotime($activeDate)) ?>]

    <?php echo date('F',strtotime($nextMonth)) ?> <a href="calendar.php?date=<?php echo $nextMonth ?>">&gt;</a></h3>
          <?php
/* @var $dateHelper DateHelper */
/* @var $eventsHelper EventsHelper */
          
          $month = $dateHelper->getMonth();
          $year = $dateHelper->getYear();


	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

	/* table headings */
	$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
        
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
            $myComparable = date('Y-m-d H:i:s',mktime(0,0,0,$month,$list_day,$year));
            $myComparable2 = date('Y-m-d H:i:s',mktime(23,59,59,$month,$list_day,$year));
        
		$calendar.= '<td class="calendar-day">';
			/* add in the day number */
        $currentDateStyle = Request::getDate() === $myComparable ? ' day-current': '';
			$calendar.= '<div class="day-number'.$currentDateStyle.' ">'.$list_day.'</div>';
$dayEvents = $eventsHelper->getEventsFor( $myComparable, $myComparable2  );
		foreach ($dayEvents as $event1) {
                    $calendar.= '<span class="event"><a href="event.php?id='.$event1->id.'">'.$event1->title.'</a></span>';
			
                }	
                        
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
        
        echo $calendar;

          
          