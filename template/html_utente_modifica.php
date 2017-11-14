<?php

class Html_utente_modifica {

    public function FORM_MODIFICA_UTENTE($utente, $ruoli, $formLink, $annullaLink, $csrf, $csrfname) {

        $html = "
        <form action='$formLink' method='post' id='form'>
        <div class='row'>
            <div class='col-md-6'>
                <div class='form-group'>
                    <label for='denominazione'>Denominazione</label>
                    <input type='text' class='form-control' placeholder='Denominazione' name='denominazione' value='$utente->denominazione' required>
                </div>
            </div>
            <div class='col-md-6'>
                <div class='form-group'>
                    <label for='indirizzo'>Indirizzo</label>
                    <input type='text' class='form-control' placeholder='Indirizzo' name='indirizzo' value='$utente->indirizzo' required>
                </div>
            </div>
        </div>
        
        <div class='row'>
            <div class='col-md-6'>
                <div class='form-group'>
                    <label for='cf'>Codice fiscale</label>
                    <input type='text' class='form-control' placeholder='Codice fiscale' name='cf' value='$utente->cf' required>
                </div>
            </div>
            <div class='col-md-6'>
                <div class='form-group'>
                    <label for='piva'>Partita iva</label>
                    <input type='text' class='form-control' placeholder='Partita iva' name='piva' value='$utente->piva' required>
                </div>
            </div>
        </div>
        
        <div class='row'>
            <div class='col-md-6'>
                <div class='form-group'>
                    <label for='telefono'>Telefono</label>
                    <input type='text' class='form-control' placeholder='Telefono' name='telefono' value='$utente->telefono' required>
                </div>
            </div>
            <div class='col-md-6'>
                <div class='form-group'>
                    <label for='email'>Email</label>
                    <input type='text' class='form-control' placeholder='Email' name='email' value='$utente->email' required>
                </div>
            </div>
        </div>
        
        <div class='row'>
            <div class='col-md-3'>
                <div class='form-group'>
                    <label for='note'>Note</label>
                    <input type='text' class='form-control' placeholder='Note' name='note' value='$utente->note' required>
                </div>
            </div>
            <div class='col-md-3'>
                <div class='form-group'>
                    <label for='password'>Password</label>
                    <input type='text' class='form-control' placeholder='Password' name='password' value='$utente->password' required>
                </div>
            </div>
            <div class='col-md-6'>
                <div class='form-group'>
                    <label for='ruolofk'>Ruolo</label>
                        <select class='form-control' style='width: 100%;' name='ruolofk' required>
        ";
        echo $html;

        foreach ($ruoli as $opz) {
            if($opz->ruoloid == $utente->ruolofk) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            echo "<option value='$opz->ruoloid' ".$selected.">$opz->descrizione</option>";
        }
        $html = "
                        </select>
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
                <input type='hidden' name='id' value='$utente->utenteid'>
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