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
              <th>Indirizzo</th>
              <th>CF/PIVA</th>
              <th>Telefono</th>
              <th>Email</th>
              <th>#</th>
            </tr>
          </thead>
          <tbody>
        ";
        echo $html;
        foreach ($utenti as $elemento) {
            echo "<tr>";
            echo " <td>".$elemento->denominazione."</td>";
            echo " <td>".$elemento->indirizzo."</td>";
            echo " <td>".$elemento->cf."/".$elemento->piva."</td>";
            echo " <td>".$elemento->telefono."</td>";
            echo " <td>".$elemento->email."</td>";
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