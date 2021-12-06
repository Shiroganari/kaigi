$(document).ready(function() {
    $.datepicker.setDefaults({
        dateFormat: 'yy-mm-dd'
    });

    $(function() {
        $("#entity-date" ).datepicker();
    });

    $('#entity-time').timepicker({
        timeFormat: 'h:mm p',
        interval: 60,
        minTime: '6',
        maxTime: '11:00pm',
        defaultTime: '11',
        startTime: '6:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
})