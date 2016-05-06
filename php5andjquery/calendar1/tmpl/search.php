<h2>Search</h2>
<!-- day to show -->
<pre>[<?php echo "{$dateHelper->getYear()}-{$dateHelper->getMonth()}-{$dateHelper->getDay()}"; ?>]</pre>
<h3>Päivä</h3>
<?php
$nextYear = $dateHelper->nextYear();
$prevYear = $dateHelper->prevYear();

$nextMonth = $dateHelper->nextMonth();
$prevMonth = $dateHelper->prevMonth();

?>
<div>[<a href="calendar.php?date=<?php echo $prevYear ?>">&lt;</a>vuosi]
    [vuosi <a href="calendar.php?date=<?php echo $nextYear ?>">&gt;</a>]</div>
<div>[<a href="calendar.php?date=<?php echo $prevMonth ?>">&lt;</a> kk]
    [kk <a href="calendar.php?date=<?php echo $nextMonth ?>">&gt;]</a></div>


    <?php
/* @var $dateHelper DateHelper */
include dirname(__FILE__) .DS. "smallcalendar.php";
?>

<!-- calendar to show -->
<h3>Kalenterit</h3>
<ul>
    <?php
    /* @var $searchHelper SearchHelper */
    foreach ($searchHelper->getAllCalendars() as $id => $name) {
        ?>

        <li>    
            <?php
            if ($searchHelper->isActiveCal($id)) {
                ?>
                <span><?php echo $name ?></span><a href="calendar.php?calendar=<?php echo $id ?>&action=remove"><span>[x]</span></a>
                <?php
            } else {
                ?>
                <a href="calendar.php?calendar=<?php echo $id ?>&action=add"><?php echo $name ?></a>
                <?php
            }
            ?>
        </li>                
        <?php
    }
    ?>
</ul>
<hr />            

<!-- types of events to show -->
<h3>Kategoriat</h3>
<ul>
    <?php
    /* @var $searchHelper SearchHelper */
    foreach ($searchHelper->getAllCategories() as $id => $name) {
        ?>
        <li>    
            <?php
            if ($searchHelper->isActiveCat($id)) {
                ?>
                <span><?php echo $name ?></span><a href="calendar.php?category=<?php echo $id ?>&action=remove"><span>[x]</span></a>
                <?php
            } else {
                ?>
                <a href="calendar.php?category=<?php echo $id ?>&action=add"><?php echo $name ?></a>
                <?php
            }
            ?>
        </li>                
        <?php
    }
    ?>
</ul>

<hr />