// function principale
$(document).ready(function () {
    $("#durata").fitText(0.4);

    console.log('Eccoci');

    function clickBtnRegistra() {
        console.log('Registra');
        // impedisce l'invio del form
        return false;
    }

    function clickBtnPlay() {
        console.log('Play');
    }
}