<?php
class Html_progetto_elimina
{
    public function scelta($message, $elemento, $tasto, $linkTasto, $linkAnnulla)
    {
        $html = "
        <div class='box-body'>
            <div class='row'>
                <div class='col-md-12'>
                    <h1>$message</h1>
                    <h6>$elemento</h6>
                </div>
            </div>
            <div class='row paddingTop20'>
            <div class='col-md-6 paddingBottom20'>
                <a class='btn btn-block btn-secondary btn-lg' href='$linkAnnulla'>Annulla</a>
            </div>
            <div class='col-md-6'>
                <a class='btn btn-block btn-danger btn-lg' href='$linkTasto'>$tasto</a>
            </div>
        </div>
        ";
        echo $html;
    }
}