$(function () {
    $('#data').datepicker({
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        weekStart: 1,
        autoclose: true,
        language: 'it'
    });

    var importo = document.getElementById('importo');
    var totale = document.getElementById('totale');

    importo.addEventListener('input', function () {
        totale.value = ((this.value*1.04)*1.04).toFixed(2);
    });
});