<?php

class Html_tempo {

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