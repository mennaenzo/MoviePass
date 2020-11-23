
$(document).ready(function () {
    $('.timepicker').timepicker({
        timeFormat: 'HH:mm',
        interval: 15,
        minTime: '0',
        maxTime: '23:59',
        defaultTime: '0',
        startTime: '00:00',
        dynamic: false,
        dropdown: true,
        scrollbar: false
    });

});
