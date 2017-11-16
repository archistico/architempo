<?php

class Html_index {

    public function Form_nuovo_tempo($progetti, $formLink, $csrf, $csrfname) {
        $html = "
        <div class='row'>
        <div class='col-md-12'>
            <h1 id='durata' class='text-center cronometro'>00:00:00</h1>
        </div>
        </div>
        ";
        echo $html;

        $html = "
        <form action='$formLink' method='post' id='form'>
        <div class='row'>
        <div class='col-md-6'>
            <div class='form-group'>
                <label for='progettofk'>Seleziona il progetto</label>
                <select class='form-control' style='width: 100%;' name='progettofk' required>
        ";
        echo $html;

        foreach ($progetti as $opz) {
            $cliente = $opz->getCliente()->denominazione;
            echo "<option value='$opz->progettoid'>$opz->descrizione - $cliente</option>";
        }
        $html = "
                </select>
            </div>
        </div>
        <div class='col-md-6'>    
            <div class='form-group'>
                <label for='Descrizione'>Descrizione attività</label>
                <input type='text' class='form-control' id='Descrizione' placeholder='Scrivi cosa ti metterai a fare' name='descrizione' required>
            </div>
            <input id='datainizio' name='datainizio' type='hidden' value=''>
            <input id='datafine' name='datafine' type='hidden' value=''>
            <input type='hidden' name='$csrfname' value='$csrf'>
        </div>
        </div>
        <div class='row'>
            <div class='col-md-6 paddingBottom20'>
	            <a class='btn btn-success btn-block btn-lg text-white' id='btnPlay'><i class='fa fa-play' aria-hidden='true'></i> START</a>
            </div>
            <div class='col-md-6 paddingBottom20'>
	            <button type='submit' class='btn btn-danger btn-block btn-lg' id='btnRegistra'><i class='fa fa-stop' aria-hidden='true'></i> STOP</button>
            </div>
        </div>  
        </form>
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