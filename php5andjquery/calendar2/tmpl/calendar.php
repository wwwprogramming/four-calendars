<h2 class="sub-header">Calendar </h2>
         
          <?php
/* @var $dateHelper DateHelper */
echo (new Calendar())->renderLarge($dateHelper->getMonth(), $dateHelper->getYear());


          
          