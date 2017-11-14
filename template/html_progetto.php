<?php

class Html_progetto {

    public function Table_progetto($progetti) {
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
              <th class='$colonneVisibili'>#</th>
              <th class='$colonneVisibili'>#</th>
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
            echo " <td class='$colonneVisibili'><a href='progetto_modifica.php?id=$elemento->progettoid&ok=0'><i class='fa fa fa-pencil fa-lg arancione' aria-hidden='true'></i></a></td>";
            echo " <td class='$colonneVisibili'><a href='progetto_elimina.php?id=$elemento->progettoid&ok=0'><i class='fa fa-times fa-lg rosso' aria-hidden='true'></i></a></td>";
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