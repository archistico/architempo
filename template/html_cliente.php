<?php

class Html_cliente {

    public function Table_progetti($progetti) {
        $colonneVisibili = '';
        $colunneNascoste = 'd-none d-md-table-cell';
        $html = "
        <div class='row'>
        <div class='col-md-12'>
        <table class='table table-bordered'>
          <thead>
            <tr>
              <th class='$colonneVisibili'>Descrizione</th>
              <th class='$colunneNascoste'>Tipologia</th>
              <th class='$colunneNascoste'>Acconto/Compenso</th>
              <th class='$colunneNascoste'>Pagato/Completato</th>
              <th class='$colonneVisibili'>Tempo</th>
            </tr>
          </thead>
          <tbody>
        ";
        echo $html;
        foreach ($progetti as $elemento) {
            echo "<tr>";
            echo " <td class='$colonneVisibili'>".$elemento->descrizione." - ".$elemento->getCliente()->denominazione."</td>";
            echo " <td class='$colunneNascoste'>".$elemento->getTipologia()->descrizione."</td>";
            echo " <td class='$colunneNascoste'>&euro; ".$elemento->acconto." / &euro; ".$elemento->compenso."</td>";
            echo " <td class='$colunneNascoste'>".($elemento->pagato==0?"<i class='fa fa-thumbs-down rosso' aria-hidden='true'></i>":"<i class='fa fa-thumbs-up verde' aria-hidden='true'></i>")." / ".($elemento->completato==0?"<i class='fa fa-thumbs-down rosso' aria-hidden='true'></i>":"<i class='fa fa-thumbs-up verde' aria-hidden='true'></i>")."</td>";
            echo " <td class='$colonneVisibili'>".$elemento->getTempo()."</td>";
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