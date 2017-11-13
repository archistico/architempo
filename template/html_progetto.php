<?php

class Html_progetto {

    public function Table_progetto($progetti) {
        $columShowOnlyLarge = 'd-none d-md-block';
        $html = "
        <div class='row'>
        <div class='col-md-12'>
        <table class='table table-bordered'>
          <thead>
            <tr>
              <th>Descrizione</th>
              <th class='$columShowOnlyLarge'>Tipologia</th>
              <th class='$columShowOnlyLarge'>Acconto/Compenso</th>
              <th class='$columShowOnlyLarge'>Pagato/Completato</th>
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
            echo " <td class='$columShowOnlyLarge'>".$elemento->getTipologia()->descrizione."</td>";
            echo " <td class='$columShowOnlyLarge'>&euro; ".$elemento->acconto." / &euro; ".$elemento->compenso."</td>";
            echo " <td class='$columShowOnlyLarge'>".($elemento->pagato==0?'NO':'SÍ')." - ".($elemento->completato==0?'NO':'SÍ')."</td>";
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