// function principale
$(document).ready(function () {

    var datainizio;
    var datainizio_str;
    var datafine;
    var datafine_str;
    var durata_secondi;
    var durata_minuti;
    var durata_ore;
    var durata_str;
    var intervallo;

    Number.prototype.pad = function(size) {
        var s = String(this);
        while (s.length < (size || 2)) {s = "0" + s;}
        return s;
    }

    $("#durata").fitText(0.4);

    console.log('Eccoci');

    $("#btnPlay").on("click", function () {
        console.log('Play');

        datainizio = moment();
        datainizio_str = datainizio.format("DD/MM/YYYY HH:mm:ss");

        intervallo = setInterval(calcola, 1000);

        console.log('Data inizio: ' + datainizio_str);
    });

    $("#form").on("submit", function () {
        console.log('Registra');

        datafine = moment();
        datafine_str = datafine.format("DD/MM/YYYY HH:mm:ss");

        console.log('Data fine: ' + datafine_str);

        // calcola durata
        durata_secondi = datafine.diff(datainizio, 'seconds');
        durata_minuti = datafine.diff(datainizio, 'minutes');
        durata_ore = datafine.diff(datainizio, 'hours');

        durata_str = durata_ore.pad()+":" +durata_minuti.pad()+ ":"+durata_secondi.pad();

        console.log('Durata: ' + durata_str);
        clearInterval(intervallo);

        // impedisce l'invio
        return false;
    });

    // Funzione che eseguo ogni secondo
    // Calcola la differenza in ore minuti secondi tra inizio e now
    function calcola() {
        var now = moment();
        durata_secondi = now.diff(datainizio, 'seconds');
        durata_minuti = now.diff(datainizio, 'minutes');
        durata_ore = now.diff(datainizio, 'hours');

        durata_str = durata_ore.pad()+":" +durata_minuti.pad()+ ":"+durata_secondi.pad();

        $("#durata").text(durata_str);
    }
});

