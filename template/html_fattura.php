<?php

class Html_fattura {

    public function Form_fattura_nuova($progetti, $formLink, $annullaLink, $csrf, $csrfname) {

        // CLIENTE E DESCRIZIONE
        $html = "
        <form action='$formLink' method='post' id='form'>
        <div class='row'>
        
        <div class='col-md-6'>    
            <div class='form-group'>
                <label for='data'>Data</label>
                <input type='text' class='form-control' name='data' id='data' placeholder='Data fattura' required>
            </div>
        </div>
        
        <div class='col-md-6'>    
            <div class='form-group'>
                <label for='numero'>Numero Fattura</label>
                <input type='number' class='form-control' required name='numero' min='1' max='999' value='1' step='1'>
            </div>
        </div>
        
        </div> <!-- chiudi row -->
        
        <div class='row'>
        
        <div class='col-md-12'>
            <div class='form-group'>
                <label for='clientefk'>Seleziona il progetto</label>
                <select class='form-control' style='width: 100%;' name='progettofk' required>
        ";
        echo $html;

        foreach ($progetti as $opz) {
            $cliente = $opz->getCliente()->denominazione;
            $tipologia = $opz->getTipologia()->descrizione;
            echo "<option value='$opz->progettoid'>$opz->descrizione - $cliente ($tipologia)</option>";
        }
        $html = "
                </select>
            </div>
        </div>
        
        </div> <!-- chiudi row -->
        
        <div class='row'>
        
        <div class='col-md-12'>    
            <div class='form-group'>
                <label for='oggetto'>Oggetto</label>
                <input type='text' class='form-control' id='oggetto' placeholder='Oggetto' name='oggetto' required>
            </div>
        </div>
        
        </div> <!-- chiudi row -->
        
        <div class='row'>
        
        <div class='col-md-6'>    
            <div class='form-group'>
                <label for='importo'>Importo</label>
                <input type='number' class='form-control' required name='importo' min='0' max='999999' value='0' step='0.01'>
            </div>
        </div>
        
        <div class='col-md-6'>    
            <div class='form-group'>
                <label for='totale'>Totale</label>
                <input type='number' class='form-control' required name='totale' min='0' max='999999' value='0' step='0.01'>
            </div>
        </div>
        
        </div> <!-- chiudi row -->

        ";
        echo $html;

        // TASTI REGISTRAZIONE E ANNULLA
        $html = "
        <div class='row'>
            <div class='col-md-6 paddingBottom20'>
	            <a class='btn btn-secondary btn-block btn-lg text-white' href='$annullaLink'> ANNULLA</a>
            </div>
            <div class='col-md-6 paddingBottom20'>
                <input type='hidden' name='$csrfname' value='$csrf'>
	            <button type='submit' class='btn btn-danger btn-block btn-lg'><i class='fa fa-plus-square' aria-hidden='true'></i> REGISTRA</button>
            </div>
        </div>  
        </form>
        ";
        echo $html;
    }

    public function Table_fatture($fatture) {
        $colunneNascoste = 'd-none d-md-table-cell';
        $html = "
        <div class='row'>
        <div class='col-md-12'>
        <table class='table table-bordered'>
          <thead>
            <tr>
              <th>Numero</th>
              <th>Data</th>
              <th>Progetto</th>
              <th class='$colunneNascoste'>Importo</th>
              <th class='$colunneNascoste'>Totale</th>
              <th>PDF</th>
              <th>#</th>
            </tr>
          </thead>
          <tbody>
        ";
        echo $html;
        foreach ($fatture as $tem) {
            echo "<tr>";
            echo " <td>".$tem->anno." - ".$tem->numero."</td>";
            echo " <td>".$tem->getDataStr()."</td>";
            echo " <td>".$tem->getProgetto()->getInfo()."</td>";
            echo " <td class='$colunneNascoste'>".$tem->importo."</td>";
            echo " <td class='$colunneNascoste'>".$tem->totale."</td>";
            echo " <td>PDF</td>";
            echo " <td><a href='fattura_elimina.php?id=$tem->fatturaid&ok=0'><i class='fa fa-times fa-lg rosso' aria-hidden='true'></i></a></td>";
            echo "</tr>";
        }
        $html = "
          </tbody>
        </table>
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