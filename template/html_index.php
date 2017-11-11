<?php

class Html_index {

    public function Form_nuovo_tempo($progetti, $formLink) {
        $html = "
        <div class='row'>
        <div class='col-md-12'>
            <form action='$formLink' method='post'>
                        
            <div class='form-group'>
                <label for='librofk'>Seleziona il progetto</label>
                <select class='form-control' style='width: 100%;' name='progettofk' required>
        ";
        echo $html;
        foreach ($progetti as $opz) {
            echo "<option value='$opz->id'>$opz->descrizione</option>";
        }
        $html = "
                </select>
            </div>    
            <div class='form-group'>
                <label for='Denominazione'>Denominazione</label>
                <input type='text' class='form-control' id='Denominazione' placeholder='Denominazione' name='denominazione' required>
            </div>
            <div class='form-group'>
                <button type='submit' class='btn btn-info btn-block btn-lg'>NUOVO</button>
            </div>
            </form>
        </div>
        </div>
        ";
        echo $html;
    }
}