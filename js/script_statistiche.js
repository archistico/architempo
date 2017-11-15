
$.ajax({
    type: 'POST',
    url: 'api_tipologie.php',
    success: function (data) {
        console.log(JSON.stringify(data));

        // converto i miei dati in due array: label e dati
        var etichette = [];
        var dati = [];

        for(var c=0; c<data.length; c++ ) {
            etichette.push(data[c][0]);
            dati.push(data[c][1]);
        }

        var ctx = document.getElementById('tipologie').getContext('2d');
        var tipologie = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: etichette,
                datasets: [{
                    label: "Tipologie",
                    data: dati,
                    backgroundColor: palette('tol-rainbow', dati.length).map(function(hex) {
                        return '#' + hex;
                    })

                }]
            },

            // Configuration options go here
            options: {}
        });
    }
});

$.ajax({
    type: 'POST',
    url: 'api_clienti.php',
    success: function (data) {
        console.log(JSON.stringify(data));

        // converto i miei dati in due array: label e dati
        var etichette = [];
        var dati = [];

        for(var c=0; c<data.length; c++ ) {
            etichette.push(data[c][0]);
            dati.push(data[c][1]);
        }

        var ctx = document.getElementById('clienti').getContext('2d');
        var clienti = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: etichette,
                datasets: [{
                    label: "Clienti",
                    data: dati,
                    backgroundColor: palette('tol-rainbow', dati.length).map(function(hex) {
                        return '#' + hex;
                    })

                }]
            },

            // Configuration options go here
            options: {}
        });
    }
});


