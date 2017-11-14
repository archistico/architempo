<?php

class Html_tipologia {

    public function Show() {
        $html = "
        
        ";
        echo $html;
    }

    public function Table_tipologie($tipologie) {
        $html = "
        <div class='row'>
        <div class='col-md-12'>
        <table class='table table-bordered'>
          <thead>
            <tr>
              <th>Descrizione</th>
              <!-- <th>#</th> -->
            </tr>
          </thead>
          <tbody>
        ";
        echo $html;
        foreach ($tipologie as $elemento) {
            echo "<tr>";
            echo " <td>".$elemento->descrizione."</td>";
            echo " <!--  <td><a href='tipologia_elimina.php?id=$elemento->tipologiaid&ok=0'><i class='fa fa-times fa-lg rosso' aria-hidden='true'></i></a></td> -->";
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