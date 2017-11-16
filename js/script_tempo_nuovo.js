$(function () {
    $('#datainizio').datepicker({
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        weekStart: 1,
        autoclose: true,
        language: 'it'
    });

    $('#datafine').datepicker({
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        weekStart: 1,
        autoclose: true,
        language: 'it'
    });
});