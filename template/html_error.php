<?php

class Html_error {

    public function Show_Error($loginlink) {
        $html = "
        <div class='row'>
            <div class='col-md-12'>
                <h4>!!! NON DISPONIBILE PER L'UTENTE !!!</h4>
                <a href='$loginlink'>Pagina iniziale</a>
            </div>
        </div>
        ";
        echo $html;
    }
}