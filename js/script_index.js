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

    var pause = false;

    $("#btnPlay").on("click", function () {
        datainizio = moment();
        datainizio_str = datainizio.format("DD/MM/YYYY HH:mm:ss");

        // cambio colore al pulsante e disabilito la funzione
        if(!pause) {
            // SE E' IN PAUSA
            pause = true;
            $("#btnPlay").removeClass("btn-success");
            $("#btnPlay").addClass("btn-secondary");
            $("#btnPlay").html("<i class='fa fa-power-off' aria-hidden='true'></i> ANNULLA");

            // Avverti il cambio pagina
            window.onbeforeunload = function(e) {
                var dialogText = 'In registrazione';
                e.returnValue = dialogText;
                return dialogText;
            };

            intervallo = setInterval(calcola, 1000);
        } else {
            // SE NON E' IN PAUSA
            pause = false;
            $("#btnPlay").removeClass("btn-secondary");
            $("#btnPlay").addClass("btn-success");
            $("#btnPlay").html("<i class='fa fa-play' aria-hidden='true'></i> PLAY");

            // ripristina
            datainizio=null;
            datafine=null;
            $("#durata").text("00:00:00");

            // Avverti il cambio pagina
            window.onbeforeunload = null;

            clearInterval(intervallo);
        }
        
    });

    $("#form").on("submit", function () {
        if(datainizio==null) {
            alert('Premere play prima');
            return false;
        }
        
        // cambio colore al pulsante e disabilito la funzione
        $("#btnPlay").removeClass("btn-secondary");
        $("#btnPlay").addClass("btn-success");
        $("#btnPlay").html("<i class='fa fa-play' aria-hidden='true'></i> PLAY");

        datafine = moment();
        datafine_str = datafine.format("DD/MM/YYYY HH:mm:ss");
        
        // calcola durata
        var differenza = moment.duration(datafine.diff(datainizio));

        durata_ore = parseInt(differenza.asHours());
        durata_minuti = parseInt(differenza.asMinutes())-durata_ore*60;
        durata_secondi = parseInt(differenza.asSeconds())-durata_ore*3600-durata_minuti*60;
        durata_str = durata_ore.pad()+":" +durata_minuti.pad()+ ":"+durata_secondi.pad();

        $("#datainizio").val(datainizio_str);
        $("#datafine").val(datafine_str);
        
        // Avverti il cambio pagina
        window.onbeforeunload = null;
        
        console.log('Data inizio: '+datainizio_str);
        console.log('Data fine  : '+datafine_str);
        console.log('Durata     : '+durata_str);

        // ripristina
        datainizio=null;
        datafine=null;
        $("#durata").text("00:00:00");
        clearInterval(intervallo);

        // impedisce l'invio
        // return false;
    });

    // Funzione che eseguo ogni secondo
    // Calcola la differenza in ore minuti secondi tra inizio e now
    function calcola() {
        var now = moment();
        var differenza = moment.duration(now.diff(datainizio));

        durata_ore = parseInt(differenza.asHours());
        durata_minuti = parseInt(differenza.asMinutes())-durata_ore*60;
        durata_secondi = parseInt(differenza.asSeconds())-durata_ore*3600-durata_minuti*60;

        durata_str = durata_ore.pad()+":" +durata_minuti.pad()+ ":"+durata_secondi.pad();
        now = null;
        $("#durata").text(durata_str);
    }

    
});

