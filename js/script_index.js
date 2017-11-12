// function principale
$(document).ready(function () {
    $("#durata").fitText(0.4);

    console.log('Eccoci');

    $("#btnPlay").on("click", function () {
        console.log('Play');
        var inizio = moment().format("DD/MM/YYYY");

        console.log('Data inizio: ' + inizio);
    });

    $("#form").on("submit", function () {
        console.log('Registra');

        // impedisce l'invio
        return false;
    });

});

