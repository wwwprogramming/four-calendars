var calendarApp = angular.module('calendarApp', ['ui.router','ui.calendar', 'ui.bootstrap']);


calendarApp.config(function($stateProvider) {
  console.log("states...");
    $stateProvider
    .state('index', {
        url: "",
       views: {
        "calendar": { 
            templateProvider: function($templateCache){  
                    // simplified, expecting that the cache is filled
                // there should be some checking... and async $http loading if not found
                return $templateCache.get('/calendar.html'); 
            } 
        }
      } 
    })
    .state('calendar', {
      url: "/calendar",
      views: {
        "calendar": { 
            templateProvider: function($templateCache){  
                    // simplified, expecting that the cache is filled
                // there should be some checking... and async $http loading if not found
                return $templateCache.get('/calendar.html'); 
            } 
        }
      }
    })
    .state('event', {
      url: "/event/:id",
      views: {
          
        "event": { 
            templateProvider: function($templateCache){
                return $templateCache.get('/event.html'); 
            }
        }
        
      }
    });
});

calendarApp.factory('calendarService', function(appConfiguration, $http,$q) {
   console.log("calendarService");
    var serviceFactory = {};

   var calendars = [];
   var categories = [];
   
   var activeCalendars = [];
   var activeCategories = [];
   
   
   serviceFactory.allCalendars = function() { return calendars; };
   serviceFactory.allCategories = function() { return categories; };
   
   serviceFactory.category = function(id) { return _.find(categories, function(item) {
      return item.id === id;     
   });
   };
   
   serviceFactory.calendar = function(id) { return _.find(calendars, function(item) {
      return item.id === id;     
   });
   };
   
   serviceFactory.event = function(id, start, fn) {
                   $http({
       method: 'GET',
       url: appConfiguration.eventPoint,
       params: {"id": id, "start": start}
     }).then(function successCallback(response) {
         console.log(response);
         fn(response.data.event);
       }, function errorCallback(response) {
            console.log("error?");
            console.log(response);
            fn({});
       });
   };
   
   
   
   serviceFactory.events = function(start,end,tz, calendarIds, categoryIds, fn) {
       
       
            $http({
       method: 'GET',
       url: appConfiguration.eventsPoint,
       params: {"start": start.format("YYYY-MM-DD"), "end": end.format("YYYY-MM-DD"), "tz": tz, "catId[]": categoryIds, "calId[]": calendarIds}
     }).then(function successCallback(response) {
         console.log(response);
         // this callback will be called asynchronously
         // when the response is available


         fn(response.data.events);
       }, function errorCallback(response) {
       console.log("error?");
       console.log(response);
         // called asynchronously if an error occurs
         // or server returns response with an error status.
         fn([]);
       });
       
       
   };
   
   serviceFactory.init = function() {
       var promise = $http.get(appConfiguration.initPoint)
        .then(function(response) {
            console.log("init this promise");
            console.log(response);
            calendars = response.data.calendars;
            categories = response.data.categories;
            return response.data;
        }); 
        return promise;
   };
      
      return {
          getAllCalendars: serviceFactory.allCalendars,
          getAllCategories: serviceFactory.allCategories,
          getEvents: serviceFactory.events,
          getEvent: serviceFactory.event,
          getCalendar: serviceFactory.calendar,
          getCategory: serviceFactory.category,
          init: serviceFactory.init
      };
    
 });

calendarApp.controller('ApplicationController', function($rootScope,$scope,$stateParams, $http, $state, appConfiguration, calendarService) {
    console.log("ApplicationController");
    var calendar = this;
    console.log(appConfiguration);
    
    
    
    var calendarSearch = this;
    
    $scope.state = {};
    $scope.state.dt = moment().toDate();
    $scope.state.activeCalendars = [];
    $scope.state.activeCategories = [];
    // variable to hold true when calendar is in the middle of view change
    $scope.state.changingView = false;
    // other data not related to state, like all cals and cats
    $scope.data = {};
    
    $scope.$watch("state.dt", function(newVal, oldVal) {
       console.log("state.dt");
       console.log(newVal,oldVal);
    });
    
    $scope.datePickerChanged = function(newVal, oldVal) {
        console.log("application...");
        console.log($scope.state.dt);
       console.log(newVal,oldVal); 
    };
    
    $scope.calendarViewRender = function(view, element) {
        $scope.state.changingView = true;
        console.log("calendarViewRender");
        console.log(view.start, view.end);
        $scope.state.dt = view.start;
    };
    
    $scope.eventAfterAllRender = function(view) {
         console.log("eventAfterAllRender");
         $scope.state.changingView = false;
    },
    
    $scope.eventClick = function(event) {
        console.log(event);
        $scope.state.event = event;
        $state.go("event", {"id": event.id});
    },
    
    /****************
     * 
     * API
     */    
        

    $scope.setSelectedCalendars = function (cals) {
        console.log("app set cals");
        console.log(cals);
        $scope.state.activeCalendars = cals;
    };

    $scope.setSelectedCategories = function (cats) {
        console.log("app set cats");
        console.log(cats);
        
        $scope.state.activeCategories = cats;
    };
    
    $scope.getEvents = function(start, end, tz, fn) {
        console.log("application getEvents()");
        var calendarIds = _.map($scope.state.activeCalendars, function(item) {return item.id; });
        var categoryIds = _.map($scope.state.activeCategories, function(item) {return item.id; });
        
        calendarService.getEvents(start, end,tz, calendarIds, categoryIds, fn);
        
    };
    
    
    // INIT
    calendarService.init().then(function(data) {
        console.log("init calendarService complete");
        console.log(data);
        var calendars = calendarService.getAllCalendars();
        var categories = calendarService.getAllCategories();
        // add attributes required by ng
        _.each(calendars, function(item) {
            item.selected = false;
        });
        $scope.data.allCalendars = calendars;
        _.each(categories, function(item) {
            item.selected = false;
        });
        $scope.data.allCategories = categories;
    });
    
    
  });
  
  
  calendarApp.controller('CalendarViewController', function($scope, calendarService) {
    console.log("CalendarViewController");
        var calendarView = this;
        console.log("dt...");
        console.log($scope.state.dt);
        
  });
 
  calendarApp.controller('CalendarSearchController', function($scope, $http, filterFilter, calendarService) {
      console.log("CalendarSearchController...");  
      console.log("dt...");
      console.log($scope.state.dt);
      
      $scope.options = {
        showWeeks: true,
        initDate: $scope.state.dt
      };
    
    // helper method to get selected calendars
  $scope.selectedCalendars = function selectedCalendars() {
    return filterFilter($scope.data.allCalendars, { selected: true });
  };
  
      // helper method to get selected categories
  $scope.selectedCategories = function selectedCategories() {
    return filterFilter($scope.data.allCategories, { selected: true });
  };

  // watch calendars for changes
  $scope.$watch('data.allCalendars|filter:{selected:true}', function (nv) {
    if (nv) {
      var selection = nv.map(function (cal) {
        return cal;
      });
    $scope.setSelectedCalendars(selection);
    console.log(selection);
    }
  }, true);
  
    // watch categories for changes
  $scope.$watch('data.allCategories|filter:{selected:true}', function (nv) {
    if (nv) {
      var selection = nv.map(function (cal) {
        return cal;
      });
    $scope.setSelectedCategories(selection);
    console.log(selection);
    }
  }, true);
        
       
  });


  calendarApp.controller('EventViewController', function($scope,$state,$stateParams,calendarService) {
    console.log('EventViewController');
    console.log($stateParams);
    var eventView = this;
    $scope.event = {};
    
    $scope.toCalendar = function() {
        $state.go('calendar');
    };
    
    calendarService.getEvent($stateParams.id, $scope.state.event.start.format("YYYY-MM-DD"), function(event) {
        console.log(event);
        $scope.event.id = event.id;
        $scope.event.title = event.title;
        $scope.event.calendar = calendarService.getCalendar(event.calendar).name;
        $scope.event.category = calendarService.getCategory(event.category).name;
        $scope.event.start = moment(event.start).format("YYYY-MM-DD HH:mm");
        $scope.event.end = moment(event.end).format("YYYY-MM-DD HH:mm");
    });  
        

      
  });
  
  

 calendarApp.controller('CalendarCtrl', function($scope,$compile,uiCalendarConfig,calendarService) {
    console.log("CalendarCtrl");

    /* alert on eventClick */
    $scope.alertOnEventClick = function( event, jsEvent, view){
        console.log(event, jsEvent, view);
        $scope.alertMessage = (event.title + ' was clicked ');
        $scope.eventClick(event);
    };
    /* alert on Drop */
     $scope.alertOnDrop = function(event, delta, revertFunc, jsEvent, ui, view){
       $scope.alertMessage = ('Event Droped to make dayDelta ' + delta);
    };
    /* alert on Resize */
    $scope.alertOnResize = function(event, delta, revertFunc, jsEvent, ui, view ){
       $scope.alertMessage = ('Event Resized to make dayDelta ' + delta);
    };
    /* add and removes an event source of choice */
    $scope.addRemoveEventSource = function(sources,source) {
      var canAdd = 0;
      angular.forEach(sources,function(value, key){
        if(sources[key] === source){
          sources.splice(key,1);
          canAdd = 1;
        }
      });
      if(canAdd === 0){
        sources.push(source);
      }
    };
    
    /* remove event */
    $scope.remove = function(index) {
      $scope.events.splice(index,1);
    };
    /* Change View */
    $scope.changeView = function(view,calendar) {
      uiCalendarConfig.calendars[calendar].fullCalendar('changeView',view);
    };
    
    $scope.$watch('state.dt' ,function(newDate) {
        console.log("calendarctrl ... go to new date");
        console.log(newDate);
        console.log($scope.state.dt);
        
        // date changed from the picker or because view  changed...
        if (!$scope.state.changingView) {
            if(uiCalendarConfig.calendars['myCalendar1']){
                uiCalendarConfig.calendars['myCalendar1'].fullCalendar('gotoDate', newDate); 
            }
        }
    });
    
    $scope.$watch('state.activeCalendars' ,function(newCalendars) {
        console.log("calendarctrl ... go to new calendars");
        // calendars changed so force calendar to refetch events
        if (!$scope.state.changingView) {
            if(uiCalendarConfig.calendars['myCalendar1']){
                uiCalendarConfig.calendars['myCalendar1'].fullCalendar('refetchEvents');
            }
        }
    });
    
    $scope.$watch('state.activeCategories' ,function(newCategories) {
        console.log("calendarctrl ... go to new categories");
        // categories changed so force calendar to refetch events
        if (!$scope.state.changingView) {
            if(uiCalendarConfig.calendars['myCalendar1']){
                uiCalendarConfig.calendars['myCalendar1'].fullCalendar('refetchEvents');
            }
        }
    });
    
    /* Change View */
    $scope.renderCalender = function(calendar) {
      if(uiCalendarConfig.calendars[calendar]){
        uiCalendarConfig.calendars[calendar].fullCalendar('render');
      }
    };
     /* Render Tooltip */
    $scope.eventRender = function( event, element, view ) { 
        //console.log("eventRender");
        //console.log(event);
        element.attr({'tooltip': event.title,
                     'tooltip-append-to-body': true});
        $compile(element)($scope);
    };
    /* config object */
    $scope.uiConfig = {
      calendar:{
        height: 450,
        editable: true,
        header: {
            left: 'prev,next today',
	    center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        defaultDate: ($scope.state.dt ? $scope.state.dt : moment()),
        eventClick: $scope.alertOnEventClick,
        eventDrop: $scope.alertOnDrop,
        eventResize: $scope.alertOnResize,
        eventRender: $scope.eventRender,
        viewRender: $scope.calendarViewRender,
        eventAfterAllRender: $scope.eventAfterAllRender
      }
    };

/* event sources array*/
    $scope.eventSources = [$scope.getEvents];
    
});

