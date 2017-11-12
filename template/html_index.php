<?php

class Html_index {

    public function Form_nuovo_tempo($progetti, $formLink) {
        $html = "
        <div class='row'>
        <div class='col-md-12'>
            <h1 id='durata' class='text-center'>00:00:00</h1>
        </div>
        </div>
        <div class='row paddingBottom20'>
        <div class='col-md-6'>
            <button type='submit' class='btn btn-secondary btn-block'>PLAY</button>
        </div>
        <div class='col-md-6'>
            <button type='submit' class='btn btn-secondary btn-block'>PAUSE</button>
        </div>
        </div>
        ";
        echo $html;

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
            echo "<option value='$opz->progettoid'>$opz->descrizione</option>";
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