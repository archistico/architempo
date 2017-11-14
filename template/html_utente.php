<?php

class Html_utente {

    public function Table_utente($utenti) {
        $html = "
        <div class='row'>
        <div class='col-md-12'>
        <table class='table table-bordered'>
          <thead>
            <tr>
              <th>Denominazione</th>
              <th class='d-none d-md-table-cell'>Indirizzo</th>
              <th class='d-none d-md-table-cell'>CF/PIVA</th>
              <th class='d-none d-md-table-cell'>Telefono</th>
              <th class='d-none d-md-table-cell'>Email</th>
              <th>#</th>
              <th>X</th>
            </tr>
          </thead>
          <tbody>
        ";
        echo $html;
        foreach ($utenti as $elemento) {
            echo "<tr>";
            echo " <td>".$elemento->denominazione."</td>";
            echo " <td class='d-none d-md-table-cell'>".$elemento->indirizzo."</td>";
            echo " <td class='d-none d-md-table-cell'>".$elemento->cf."/".$elemento->piva."</td>";
            echo " <td class='d-none d-md-table-cell'>".$elemento->telefono."</td>";
            echo " <td class='d-none d-md-table-cell'>".$elemento->email."</td>";
            echo " <td><a href='utente_modifica.php?id=$elemento->utenteid&ok=0'><i class='fa fa fa-pencil fa-lg arancione' aria-hidden='true'></i></a></td>";
            echo " <td><a href='utente_elimina.php?id=$elemento->utenteid&ok=0'><i class='fa fa-times fa-lg rosso' aria-hidden='true'></i></a></td>";
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