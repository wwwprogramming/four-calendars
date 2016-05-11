<h2>Search</h2>


<h3>Datepicker</h3>

<div style="display:inline-block; min-height:290px;">
      <uib-datepicker ng-model="state.dt" class="well well-sm" datepicker-options="options"></uib-datepicker>
    </div>

<h3>Calendars</h3>
<table>
    <tr ng-repeat="calendar in data.allCalendars"><td>{{calendar.id}} {{calendar.name}}</td><td><input ng-model="calendar.selected" type='checkbox' name='calendar' value='{{calendar.id}}' /></td></tr>
</table>

<h3>Categories</h3>
<table>
    <tr ng-repeat="category in data.allCategories"><td>{{category.id}} {{category.name}}</td><td><input ng-model="category.selected" type='checkbox' name='category' value='{{category.id}}' /></td></tr>
</table>

<hr />