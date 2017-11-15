<?php

class Html_statistiche {

    public function Show($totale_ore_lavorate) {
        $html = "
        <div class='row'>
            <div class='col-md-12 paddingBottom20'>
                <div class='alert alert-success h-100 d-block' role='alert'>
                    <h1 class='alert-heading'>ORE LAVORATE TOTALI</h1>
                    <h1>$totale_ore_lavorate</h1>
                    <hr>
                    <p class='mb-0'>Somma delle ore lavorate tra tutti i progetti</p>
                </div>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-6 paddingBottom20'>
                <h4>Ore per tipologia</h4>
                <canvas id='tipologie' width='400' height='400'></canvas>
            </div>
            <div class='col-md-6 paddingBottom20'>
                <h4>Ore per cliente</h4>
                <canvas id='clienti' width='400' height='400'></canvas>
            </div>
        </div>
        
        
        ";
        echo $html;
    }

    public function CaricaJS($file) {
        $html = "
            <script src='js/script_$file.js'></script>
        ";
        echo $html;
    }
}