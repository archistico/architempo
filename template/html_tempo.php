<?php

class Html_tempo {

    public function Scelta_tempo() {
        $html = "
        <div class='row paddingBottom20'>
            <div class='col-md-6 paddingBottom20'>
                <a class='btn btn-info btn-block btn-lg' href='index.php'>NUOVO TEMPO CON CRONOMETRO</a>
            </div>
            <div class='col-md-6'>
                <a class='btn btn-info btn-block btn-lg' href='tempo_nuovo.php'>NUOVO TEMPO MANUALE</a>
            </div>
        </div>
        ";
        echo $html;
    }

    public function Table_tempo($tempi) {
        $colunneNascoste = 'd-none d-md-table-cell';
        $html = "
        <div class='row'>
        <div class='col-md-12'>
        <table class='table table-bordered'>
          <thead>
            <tr>
              <th>Progetto</th>
              <th>Descrizione</th>
              <th class='$colunneNascoste'>Inizio</th>
              <th class='$colunneNascoste'>Fine</th>
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
            echo " <td class='$colunneNascoste'>".$tem->getDatainizio()."</td>";
            echo " <td class='$colunneNascoste'>".$tem->getDatafine()."</td>";
            echo " <td>".$tem->getDurata()."</td>";
            echo " <td><a href='tempo_elimina.php?id=$tem->tempoid&ok=0'><i class='fa fa-times fa-lg rosso' aria-hidden='true'></i></a></td>";
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
}