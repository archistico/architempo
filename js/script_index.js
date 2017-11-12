// function principale
$(document).ready(function () {
    $("#durata").fitText(0.4);

    console.log('Eccoci');

    $("#btnPlay").on("click", function () {
        console.log('Play');
    });

    $("#form").on("submit", function () {
        console.log('Registra');

        // impedisce l'invio
        return false;
    });

});

