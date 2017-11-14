<?php

class Html_progetto_modifica {

    public function Form_modifica_progetto($progetto, $utenti, $tipologie, $formLink, $annullaLink, $csrf, $csrfname) {

        // CLIENTE E DESCRIZIONE
        $html = "
        <form action='$formLink' method='post' id='form'>
        <div class='row'>
        <div class='col-md-4'>
            <div class='form-group'>
                <label for='clientefk'>Seleziona il cliente</label>
                <select class='form-control' style='width: 100%;' name='clientefk' required>
        ";
        echo $html;

        foreach ($utenti as $opz) {
            if($opz->utenteid == $progetto->getCliente()->utenteid) {
                $selected = "selected";
            } else {
                $selected = "";
            }

            echo "<option value='$opz->utenteid' ".$selected.">$opz->denominazione</option>";
        }
        $html = "
                </select>
            </div>
        </div>
        <div class='col-md-8'>    
            <div class='form-group'>
                <label for='Descrizione'>Breve descrizione del progetto</label>
                <input type='text' class='form-control' id='Descrizione' placeholder='Descrizione' name='descrizione' value='$progetto->descrizione' required>
            </div>
        </div>
        </div>
        ";
        echo $html;

        $html = "
        <div class='row'>
        <div class='col-md-4'>
            <div class='form-group'>
                <label for='tipologiafk'>Tipologia</label>
                <select class='form-control' style='width: 100%;' name='tipologiafk' required>
        ";
        echo $html;

        foreach ($tipologie as $opz) {
            if($opz->tipologiaid == $progetto->getTipologia()->tipologiaid) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            echo "<option value='$opz->tipologiaid' ".$selected.">$opz->descrizione</option>";
        }

        $html = "
                </select>
            </div>
        </div>
        <div class='col-md-3'>    
            <div class='form-group'>
                <label for='acconto'>Acconto &euro;</label>
                <input type='number' class='form-control' required name='acconto' min='0' value='$progetto->acconto' step='0.01'>
            </div>
        </div>
        <div class='col-md-3'>    
            <div class='form-group'>
                <label for='compenso'>Compenso &euro;</label>
                <input type='number' class='form-control' required name='compenso' min='0'  value='$progetto->compenso' step='0.01'>
            </div>
        </div>
        <div class='col-md-2'>
            <div class='form-group'>
                <label>Altro</label>
                <div class='form-check'>
                    <label class='form-check-label'><input type='checkbox' name='pagato' class='form-check-input' ".($progetto->pagato?'checked':'').">Pagato</label>
                </div>
                <div class='form-check'>
                    <label class='form-check-label'><input type='checkbox' name='completato' class='form-check-input' ".($progetto->completato?'checked':'').">Completato</label>
                </div>
            </div>
        </div>
        </div>
        ";
        echo $html;

        // TASTI REGISTRAZIONE E ANNULLA
        $html = "
        <div class='row'>
            <div class='col-md-6 paddingBottom20'>
	            <a class='btn btn-secondary btn-block btn-lg text-white' href='$annullaLink'> ANNULLA</a>
            </div>
            <div class='col-md-6 paddingBottom20'>
                <input type='hidden' name='id' value='$progetto->progettoid'>
                <input type='hidden' name='ok' value='1'>
                <input type='hidden' name='$csrfname' value='$csrf'>
	            <button type='submit' class='btn btn-danger btn-block btn-lg'><i class='fa fa-plus-square' aria-hidden='true'></i> REGISTRA</button>
            </div>
        </div>  
        </form>
        ";
        echo $html;
    }

}