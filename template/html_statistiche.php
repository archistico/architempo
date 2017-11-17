<?php

class Html_statistiche {

    public function Show($totale_ore_lavorate, $totale_acconti, $totale_compensi) {
        $html = "
        <div class='row'>
            <div class='col-md-4 paddingBottom20'>
                <div class='alert alert-success h-100 d-block'>
                    <h1 class='alert-heading'>TOTALE ORE</h1>
                    <h4>$totale_ore_lavorate ore</h4>
                    <hr>
                    <p class='mb-0'>Somma delle ore lavorate tra tutti i progetti</p>
                </div>
            </div>
            <div class='col-md-4 paddingBottom20'>
                <div class='alert alert-success h-100 d-block'>
                    <h1 class='alert-heading'>ACCONTI/COMPENSI</h1>
                    <h4>".Utilita::EURO($totale_acconti)."/".Utilita::EURO($totale_compensi)."</h4>
                    <hr>
                    <p class='mb-0'>Somma pagate</p>
                </div>
            </div>
            <div class='col-md-4 paddingBottom20'>
                <div class='alert alert-success h-100 d-block'>
                    <h1 class='alert-heading'>DA PAGARE</h1>
                    <h4>".Utilita::EURO($totale_compensi-$totale_acconti)."</h4>
                    <hr>
                    <p class='mb-0'>Ancora da ricevere dai clienti</p>
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