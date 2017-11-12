<?php

class Html_index {

    public function Form_nuovo_tempo($progetti, $formLink) {
        $html = "
        <div class='row'>
        <div class='col-md-12'>
            <h1 id='durata' class='text-center'>00:00:00</h1>
        </div>
        </div>
        ";
        echo $html;

        $html = "
        <form action='$formLink' method='post'>
        <div class='row'>
        <div class='col-md-6'>
            <div class='form-group'>
                <label for='librofk'>Seleziona il progetto</label>
                <select class='form-control' style='width: 100%;' name='progettofk' required>
        ";
        echo $html;

        foreach ($progetti as $opz) {
            echo "<option value='$opz->progettoid'>$opz->descrizione</option>";
        }
        $html = "
                </select>
            </div>
        </div>
        <div class='col-md-6'>    
            <div class='form-group'>
                <label for='Denominazione'>Denominazione</label>
                <input type='text' class='form-control' id='Denominazione' placeholder='Denominazione' name='denominazione' required>
            </div>
            <input id='datainizio' name='datainizio' type='hidden' value=''>
            <input id='datafine' name='datafine' type='hidden' value=''>
        </div>
        </div>
        <div class='row'>
            <div class='col-md-6 paddingBottom20'>
	            <button type='submit' class='btn btn-danger btn-block btn-lg' id='btnPlay'>PLAY</button>
            </div>
            <div class='col-md-6 paddingBottom20'>
	            <button type='submit' class='btn btn-success btn-block btn-lg' id='btnRegistra'>REGISTRA</button>
            </div>
        </div>  
        </form>
        ";
        echo $html;
    }

    public function Table_tempo($tempi) {
        $html = "
        <div class='row'>
        <div class='col-md-12'>
        <table class='table table-bordered'>
          <thead>
            <tr>
              <th>Progetto</th>
              <th>Descrizione</th>
              <th class='hidden-xs'>Inizio</th>
              <th class='hidden-xs'>Fine</th>
              <th>Durata</th>
              <th>#</th>
            </tr>
          </thead>
          <tbody>
        ";
        echo $html;
        foreach ($tempi as $tem) {
            echo "<tr>";
            echo " <td>".$tem->getProgetto()->descrizione."</td>";
            echo " <td>".$tem->descrizione."</td>";
            echo " <td class='hidden-xs'>".$tem->getDatainizio()."</td>";
            echo " <td class='hidden-xs'>".$tem->getDatafine()."</td>";
            echo " <td>".$tem->getDurata()."</td>";
            echo " <td><a href=''><i class='fa fa-times fa-lg rosso' aria-hidden='true'></i></a></td>";
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