<?php

class Html_progetto_nuovo {

    /*
    public $progettoid;
    public $descrizione;
    public $clientefk;
    public $cliente;
    public $tipologiafk;
    public $tipologia;
    public $compenso;
    public $acconto;
    public $pagato;
    public $completato;
    */

    public function Form_nuovo_progetto($utenti, $tipologie, $formLink, $annullaLink, $csrf, $csrf_user) {
        
        $html = "
        <form action='$formLink' method='post' id='form'>
        <div class='row'>
        <div class='col-md-6'>
            <div class='form-group'>
                <label for='clientefk'>Seleziona il cliente</label>
                <select class='form-control' style='width: 100%;' name='clientefk' required>
        ";
        echo $html;

        foreach ($utenti as $opz) {
            echo "<option value='$opz->utenteid'>$opz->denominazione</option>";
        }
        $html = "
                </select>
            </div>
        </div>
        <div class='col-md-6'>    
            <div class='form-group'>
                <label for='Descrizione'>Breve descrizione del progetto</label>
                <input type='text' class='form-control' id='Descrizione' placeholder='Descrizione' name='descrizione' required>
            </div>
            <input type='hidden' name='$csrf_user' value='$csrf'>
        </div>
        </div>
        <div class='row'>
            <div class='col-md-6 paddingBottom20'>
	            <a class='btn btn-secondary btn-block btn-lg text-white' href='$annullaLink'> ANNULLA</a>
            </div>
            <div class='col-md-6 paddingBottom20'>
	            <button type='submit' class='btn btn-danger btn-block btn-lg'><i class='fa fa-stop' aria-hidden='true'></i> REGISTRA</button>
            </div>
        </div>  
        </form>
        ";
        echo $html;
    }

}