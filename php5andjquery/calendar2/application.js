var myApp = (function () {
    var currentDate;

    var allCalendars = {};
    var allCategories = {};

    var activeCalendars = [];
    var activeCategories = [];

    var start;
    var end;
    var tz;

    var url;
    
    var dateFormatOfPicker = "dd.mm.yy";
    var dateFormatToMoment = "DD.MM.YYYY";

    var fullCalendar;
    var viewType = "month";
    
    // when datapicker is moving months
    var runningMonthYear = true;

    var app = {}
    
    app.getDateFormat = function() {
        return dateFormatOfPicker;
    };
    
    app.getFormatToMoment = function() {
        return dateFormatToMoment;
    };

    app.setFullCalendar = function (cal) {
        fullCalendar = cal;
    };

    app.refreshCalender = function () {
        fullCalendar.fullCalendar('refetchEvents');
    };

    app.setAllCalendars = function (calendars) {
        allCalendars = calendars;
    };

    app.setAllCategories = function (categories) {
        allCategories = categories;
    };
    
    app.changeView = function(newViewType, start) {
        viewType = newViewType;
        
        // may Trigger onChangeMonthYear... so disable that while setting new date.
        var cb = app.changeMonthYear;
        app.changeMonthYear= function() {};
        
        app.showDate(start.format("YYYY-MM-DD"));
        if (!runningMonthYear) {
            app.changePickerDate(start.format("YYYY-MM-DD") , false);
            
        }
        runningMonthYear = false;
        app.changeMonthYear = cb;
    };
    
    app.changeMonthYear = function(y,m) {
        console.log("onChangeMonthYear");
        console.log(y,m);
        var myMoment = new moment(y + "-" + m + "-01", "YYYY-M-DD" )
        console.log(myMoment.format("YYYY-MM-DD"));
        runningMonthYear = true;
        app.changeDate(myMoment.format("YYYY-MM-DD"), true);
    };

    app.selectCategory = function (id, refresh) {
        console.log("selectCategory(" + id + ")");
        activeCategories.push(id);
        var node = jQuery("<a href='#category.del'><span>DEL</span></a>");
        node.click(function () {
            app.unSelectCategory(id, true);
        });
        jQuery("#category_" + id + " .action").html("");
        jQuery("#category_" + id + " .action").append(node);
        if (refresh) {
            app.refreshCalender();
        }
    };

    app.unSelectCategory = function (id, refresh) {
        console.log("unSelectCategory(" + id + ")");
        activeCategories = _.filter(activeCategories, function (value, key) {
            if (id === value) {
                return false;
            }
            return true;
        });
        var node = jQuery("<a href='#category.add'><span>ADD</span></a>");
        node.click(function () {
            app.selectCategory(id, true);
        });
        jQuery("#category_" + id + " .action").html("");
        jQuery("#category_" + id + " .action").append(node);
        if (refresh) {
            app.refreshCalender();
        }
    };

    app.selectCalendar = function (id, refresh) {
        console.log("selectCalendar(" + id + ")");
        activeCalendars.push(id);
        var node = jQuery("<a href='#calendar.del'><span>DEL</span></a>");
        node.click(function () {
            app.unSelectCalendar(id, true);
        });
        jQuery("#calendar_" + id + " .action").html("");
        jQuery("#calendar_" + id + " .action").append(node);
        if (refresh) {
            app.refreshCalender();
        }
    };

    app.unSelectCalendar = function (id, refresh) {

        console.log("unSelectCalendar(" + id + ")");
        activeCalendars = _.filter(activeCalendars, function (value, key) {
            if (id === value) {
                return false;
            }
            return true;
        });
        var node = jQuery("<a href='#calendar.add'><span>ADD</span></a>");
        node.click(function () {
            app.selectCalendar(id, true);
        });
        jQuery("#calendar_" + id + " .action").html("");
        jQuery("#calendar_" + id + " .action").append(node);
        if (refresh) {
            app.refreshCalender();
        }
    };

    app.getEvents = function (start, end, tz, fn) {
        // add calendars and categories to url.
        console.log("app.getEvents");
        console.log(start, end, tz);
        // calId, catId, date, start, end, tz
        jQuery.get(url,
                {"action": "getevents",
                    "calId": activeCalendars,
                    "catId": activeCategories,
                    "start": start.format("YYYY-MM-DD"),
                    "end": end.format("YYYY-MM-DD"),
                    "tz": tz}, function (response) {
            console.log(response);
            fn(response.events);
        });
    };
    
    app.showDate = function(newDate) {
        jQuery("#currentDateHolder").html(newDate);
    };

    app.changeDate = function (newDate, refresh) {
        console.log(newDate, refresh);
        currentDate = newDate;
        app.showDate(newDate);
        // should I refresh
        // how to tell fullCalendar to change its view?
        if (refresh) {
            console.log("refresh calendar");
            fullCalendar.fullCalendar('gotoDate', moment(currentDate, "YYYY-MM-DD"));
            //fullCalendar.fullCalendar( 'refetchEvents' );
        }
        //console.log(this);
        //console.log(url, currentDate, start,end,tz,allCalendars, allCategories, activeCalendars, activeCategories);
        //console.log(app);
    };
    
    app.changePickerDate = function (newDate, refresh) {
        console.log(newDate, refresh);
        var myMoment = moment(newDate, "YYYY-MM-DD");
        jQuery( "#datepicker" ).datepicker( "setDate", myMoment.toDate() );
        console.log(myMoment.format("YYYY-MM-DD"));
        if (refresh) {
            console.log("refresh calendar");
            fullCalendar.fullCalendar('gotoDate', moment(currentDate, "YYYY-MM-DD"));
            //fullCalendar.fullCalendar( 'refetchEvents' );
        }
        
    };
    
    app.showEvent = function(event) {
       console.log(event);
      jQuery.get(url, {action : "getevent", id:event.id, start: event.start.format("YYYY-MM-DD")} , function(response) {
         console.log(response);
         jQuery("#event_table").css("background-color", response.event.backgroundColor);
         jQuery("#event_table").css("color", response.event.color);
         
         jQuery("#event_ph_id").html(response.event.id);
         jQuery("#event_ph_title").html(response.event.title);
         jQuery("#event_ph_start").html(response.event.start);
         jQuery("#event_ph_end").html(response.event.end);
         jQuery("#event_ph_calendar").html(response.event.calendar);
         jQuery("#event_ph_category").html(response.event.category);
         
      });
        jQuery("#calendar_container").removeClass("app-visible").addClass("app-hidden");
      jQuery("#event_container").removeClass("app-hidden").addClass("app-visible");
      
    };
    
    app.showCalendar = function() {

      jQuery("#event_container").removeClass("app-visible").addClass("app-hidden");
      jQuery("#calendar_container").removeClass("app-hidden").addClass("app-visible");
      
    };

    app.init = function (newUrl) {
        // get all
        url = newUrl;
        // TODO ajax load categories and calendars
        jQuery.get(url, {"action": "all"}, function (data) {
            console.log(data);
            // calendars, categories
            allCalendars = data.calendars;
            allCategories = data.categories;

            console.log(allCalendars);
            _.each(allCalendars, function (value, key, list) {
                // _.contains(list, value, [fromIndex])
                console.log(value, key);
                if (_.contains(activeCalendars, key)) {
                    app.selectCalendar(key, false);
                } else {
                    app.unSelectCalendar(key, false);
                }
            });
            console.log(allCategories);
            _.each(allCategories, function (value, key, list) {
                // _.contains(list, value, [fromIndex])
                console.log(value, key);
                if (_.contains(activeCategories, key)) {
                    app.selectCategory(key, false);
                } else {
                    app.unSelectCategory(key, false);
                }
            });
            // what else, fullcalendar will initialize it self

        }); // end ajax
    };

    return app;
})();