document.addEventListener('DOMContentLoaded', function () {
    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendarInteraction.Draggable
    
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['dayGrid', 'timeGrid', 'list', 'bootstrap'],
        themeSystem: 'bootstrap',
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        navLinks: true,
        locale: 'pt-br',
        navLinks: true,
        eventLimit: true,
        selectable:true,
        editable: true,
        droppable: true, // this allows things to be dropped onto the calendar
    });

    calendar.render();
});