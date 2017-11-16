$(function () {
    $('#datainizio').datepicker({
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        weekStart: 1,
        autoclose: true
    });

    $('#datafine').datepicker({
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        weekStart: 1,
        autoclose: true
    });
});