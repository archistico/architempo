<?php

class Html_progetto {

    public function Table_progetto($progetti) {
        $html = "
        <div class='row'>
        <div class='col-md-12'>
        <table class='table table-bordered'>
          <thead>
            <tr>
              <th>Descrizione</th>
              <th>Tipologia</th>
              <th>Acconto/Compenso</th>
              <th>Pagato/Completato</th>
              <th>Tempo</th>
              <th>#</th>
            </tr>
          </thead>
          <tbody>
        ";
        echo $html;
        foreach ($progetti as $elemento) {
            echo "<tr>";
            echo " <td>".$elemento->descrizione." - ".$elemento->getCliente()->denominazione."</td>";
            echo " <td>".$elemento->getTipologia()->descrizione."</td>";
            echo " <td>&euro; ".$elemento->acconto." / &euro; ".$elemento->compenso."</td>";
            echo " <td>".($elemento->pagato==0?'NO':'SÍ')." - ".($elemento->completato==0?'NO':'SÍ')."</td>";
            echo " <td>".$elemento->getTempo()."</td>";
            echo " <td><a href='progetto_elimina.php?id=$elemento->progettoid&ok=0'><i class='fa fa-times fa-lg rosso' aria-hidden='true'></i></a></td>";
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