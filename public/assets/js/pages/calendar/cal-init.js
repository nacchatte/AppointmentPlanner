// ! function($) {
//     "use strict";

//     var CalendarApp = function() {
//         this.$body = $("body")
//         this.$calendar = $('#calendar'),
//         this.$event = ('#calendar-events div.calendar-events'),
//         this.$categoryForm = $('#add-new-event form'),
//         this.$extEvents = $('#calendar-events'),
//         this.$modal = $('#my-event'),
//         this.$saveCategoryBtn = $('.save-category'),
//         this.$calendarObj = null
//     };

//     /* on drop */
//     // CalendarApp.prototype.onDrop = function(eventObj, date) {
//     //         var $this = this;
//     //         // retrieve the dropped element's stored Event Object
//     //         var originalEventObject = eventObj.data('eventObject');
//     //         var $categoryClass = eventObj.attr('data-class');
//     //         // we need to copy it, so that multiple events don't have a reference to the same object
//     //         var copiedEventObject = $.extend({}, originalEventObject);
//     //         // assign it the date that was reported
//     //         copiedEventObject.start = date;
//     //         if ($categoryClass)
//     //             copiedEventObject['className'] = [$categoryClass];
//     //         // render the event on the calendar
//     //         $this.$calendar.fullCalendar('renderEvent', copiedEventObject, true);
//     //         // is the "remove after drop" checkbox checked?
//     //         if ($('#drop-remove').is(':checked')) {
//     //             // if so, remove the element from the "Draggable Events" list
//     //             eventObj.remove();
//     //         }
//     //     },
//     //     CalendarApp.prototype.enableDrag = function() {
//     //         //init events
//     //         $(this.$event).each(function() {
//     //             // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
//     //             // it doesn't need to have a start or end
//     //             var eventObject = {
//     //                 title: $.trim($(this).text()) // use the element's text as the event title
//     //             };
//     //             // store the Event Object in the DOM element so we can get to it later
//     //             $(this).data('eventObject', eventObject);
//     //             // make the event draggable using jQuery UI
//     //             $(this).draggable({
//     //                 zIndex: 999,
//     //                 revert: true, // will cause the event to go back to its
//     //                 revertDuration: 0 //  original position after the drag
//     //             });
//     //         });
//     //     }
//     /* Initializing */
//     CalendarApp.prototype.init = function() {
//             //this.enableDrag();
//             /*  Initialize the calendar  */
//             var self = this;
//             $.ajax({
//                 url: '/get-appointments', // Update this URL to match your Laravel route
//                 method: 'GET',
//                 success: function(response) {
//                     var appointments = response;

//                     var formattedAppointments = appointments.map(function(appointment) {
//                         return {
//                             title: appointment.Customer_Id,
//                             start: appointment.App_Date + 'T' + appointment.App_Time, // Ensure correct date and time format
//                             end: appointment.App_Date + 'T' + appointment.App_Time,
//                             // Other properties as needed
//                         };
//                     });

//                     // Use the formatted data as calendar events
//                     self.$calendarObj.fullCalendar('renderEvents', formattedAppointments);
//                 },
//                 error: function(xhr, status, error) {
//                     console.error(error); // Handle error appropriately
//                 }
//             });

//             var date = new Date();
//             var d = date.getDate();
//             var m = date.getMonth();
//             var y = date.getFullYear();
//             var form = '';
//             var today = new Date($.now());

//             var defaultEvents = [{
//                     title: 'Meeting #3',
//                     start: new Date($.now() + 506800000),
//                     className: 'bg-info'
//                 }, {
//                     title: 'Submission #1',
//                     start: today,
//                     end: today,
//                     className: 'bg-danger'
//                 }, {
//                     title: 'Meetup #6',
//                     start: new Date($.now() + 848000000),
//                     className: 'bg-info'
//                 }, {
//                     title: 'Seminar #4',
//                     start: new Date($.now() - 1099000000),
//                     end: new Date($.now() - 919000000),
//                     className: 'bg-warning'
//                 }, {
//                     title: 'Event Conf.',
//                     start: new Date($.now() - 1199000000),
//                     end: new Date($.now() - 1199000000),
//                     className: 'bg-purple'
//                 }, {
//                     title: 'Meeting #5',
//                     start: new Date($.now() - 399000000),
//                     end: new Date($.now() - 219000000),
//                     className: 'bg-info'
//                 },
//                 {
//                     title: 'Submission #2',
//                     start: new Date($.now() + 868000000),
//                     className: 'bg-danger'
//                 }, {
//                     title: 'Seminar #5',
//                     start: new Date($.now() + 348000000),
//                     className: 'bg-success'
//                 }
//             ];

//             var self = this;

//             $this.$calendarObj = $this.$calendar.fullCalendar({
//                 slotDuration: '00:15:00',
//                 /* If we want to split day time each 15minutes */
//                 minTime: '08:00:00',
//                 maxTime: '19:00:00',
//                 defaultView: 'month',
//                 handleWindowResize: true,

//                 header: {
//                     left: 'prev,next today',
//                     center: 'title',
//                     right: 'month,agendaWeek,agendaDay'
//                 },
//                 events: defaultEvents,
//                 //editable: true,
//                 //droppable: true, // this allows things to be dropped onto the calendar !!!
//                 //eventLimit: true, // allow "more" link when too many events
//                 selectable: true,
//                 //drop: function(date) { $this.onDrop($(this), date); },
//                 select: function(start, end, allDay) { $this.onSelect(start, end, allDay); },
//                 eventClick: function(calEvent, jsEvent, view) { $this.onEventClick(calEvent, jsEvent, view); }

//             });

//         },

//         //init CalendarApp
//         $.CalendarApp = new CalendarApp();
//         $.CalendarApp.Constructor = CalendarApp;

// }(window.jQuery),

// //initializing CalendarApp
// $(window).on('load', function() {

//     $.CalendarApp.init()
// });
(function ($) {
    "use strict";

    var CalendarApp = function () {
        this.$body = $("body");
        this.$calendar = $('#calendar');
        this.$modal = $('#my-event-details'); // Replace with your modal ID
        this.$calendarObj = null;
    };

    CalendarApp.prototype.init = function () {
        var self = this;

        $.ajax({
            url: '/get-appointments',
            method: 'GET',
            success: function (response) {
                var appointments = response;

                var formattedAppointments = appointments.map(function (appointment) {

                    var startDateTime = moment(appointment.appointment.App_Date + ' ' + appointment.appointment.App_Time);
                    var endDateTime = moment(startDateTime).add(appointment.appointment.App_Duration, 'hours');

                    return {
                        title: appointment.appointment.Customer_Name,
                        start: startDateTime.format(), // Use the formatted time from moment.js
                        end: endDateTime.format(), // Use the formatted time from moment.js
                        appointmentDetails: appointment,
                        className: getAppointmentColor(appointment.appointment.App_Status) // Assign different colors based on Customer_Id
                    };
                });
                console.log('Formatted Appointments:', formattedAppointments);

                self.$calendarObj = self.$calendar.fullCalendar({
                    // Your calendar initialization options...
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    events: formattedAppointments,
                    eventClick: function (calEvent, jsEvent, view) {
                        self.showAppointmentDetails(calEvent.appointmentDetails);
                    },
                    // ... other calendar options ...
                });
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    };

    // Function to display appointment details in a modal
    CalendarApp.prototype.showAppointmentDetails = function (appointment) {
        // var timeString = appointment.appointment.App_Time;
        // var ddate = appointment.appointment.App_Date;
        // var time = new Date(ddate + "T" + timeString + "Z"); // Assuming a dummy date for formatting

        // var formattedTime = time.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

        this.$modal.find('.modal-title').text(appointment.appointment.title);
        this.$modal.find('.customer-name').text(appointment.appointment.Customer_Name);
        this.$modal.find('.customer-hp').text(appointment.appointment.Customer_HP);
        this.$modal.find('.customer-address').text(appointment.appointment.Customer_Address);
        this.$modal.find('.app-date').text(appointment.appointment.App_Date + " " + appointment.appointment.App_Time);
        this.$modal.find('.app-duration').text(appointment.appointment.App_Duration + " hour(s)");
        this.$modal.find('.app-price').text("RM " + appointment.appointment.App_Price);
        this.$modal.find('.app-desc').text(appointment.appointment.App_Desc);
        this.$modal.find('.app-status').text(appointment.appointment.App_Status);

        // Display staff details
        var staffList = this.$modal.find('.staff-list');
        staffList.empty();

        if (appointment.staff.length > 0) {
            staffList.append('<p><strong>Staff In Charge:</strong></p>');
            var staffDetails = '<ul>';
            for (var i = 0; i < appointment.staff.length; i++) {
                staffDetails += '<li>' + appointment.staff[i].Staff_Name + '</li>';
            }
            staffDetails += '</ul>';
            staffList.append(staffDetails);
        }

        var appId = appointment.appointment.App_Id;
        
        var editButton = this.$modal.find('#edit-appointment-btn');
        editButton.attr('href', baseUrl + "/appointmentsdetails/" + appId);
        this.$modal.modal('show');
    };

    // Function to get color based on Customer_Id
    function getAppointmentColor(status) {
        // You can implement logic to assign colors based on Customer_Id
        // For example:
        if (status === "upcoming") {
            return 'bg-info'; // CSS class for a blue background
        } else if (status === "completed") {
            return 'bg-success'; // CSS class for a green background
        } else if (status === "cancelled") {
            return 'bg-danger'; // Default color
        }
    }
    $.CalendarApp = new CalendarApp();
    $.CalendarApp.Constructor = CalendarApp;

    $(window).on('load', function () {
        $.CalendarApp.init();
    });

})(window.jQuery);
