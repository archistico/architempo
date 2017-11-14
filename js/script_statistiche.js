/*
$.ajax({
    type: 'POST',
    url: 'api_tipologie.php',
    success: function (data) {
        console.log(JSON.stringify(data));

    }
});
*/


var ctx = document.getElementById('tipologie').getContext('2d');
var tipologie = new Chart(ctx, {
    // The type of chart we want to create
    type: 'doughnut',

    // The data for our dataset
    data: {
        labels: ["AAA", "BBB", "CCC", "DDD", "EEE"],
        datasets: [{
            label: "Tipologie",
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
            ],
            data: [0, 10, 5, 2, 20],
        }]
    },

    // Configuration options go here
    options: {}
});
