<h2>Search</h2>
<!-- day to show -->
<pre id="currentDateHolder">[<?php echo "{$dateHelper->getYear()}-{$dateHelper->getMonth()}-{$dateHelper->getDay()}"; ?>]</pre>
<h3>Päivä</h3>
<?php
$nextYear = $dateHelper->nextYear();
$prevYear = $dateHelper->prevYear();

$nextMonth = $dateHelper->nextMonth();
$prevMonth = $dateHelper->prevMonth();

/* @var $dateHelper DateHelper */
echo (new Calendar())->renderSmall($dateHelper->getMonth(), $dateHelper->getYear());
?>

<!-- calendar to show -->
<h3>Kalenterit</h3>
<ul>
    <?php
    /* @var $searchHelper SearchHelper */
    foreach ($searchHelper->getAllCalendars() as $id => $name) {
        ?>
        <li id="calendar_<?php echo $id ?>" data-calendar="<?php echo $id ?>">
            <span><?php echo $name ?></span><span class="action"></span>
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
        <li id="category_<?php echo $id ?>" data-category="<?php echo $id ?>">    

            <span><?php echo $name ?></span><span class="action"></span>

        </li>                
        <?php
    }
    ?>
</ul>

<hr />