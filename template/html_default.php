<?php

class Html_default {
    public static function HEAD($titolo) {
        $html = "
        <!DOCTYPE html>
        <html lang='it'>
        <head>
            <meta charset='utf-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>

            <title>$titolo</title>

            <link rel='stylesheet' href='vendor/bootstrap/bootstrap.min.css'>
            <link rel='stylesheet' href='vendor/awesome/css/font-awesome.min.css'>
            <link href='https://fonts.googleapis.com/css?family=Ubuntu+Mono' rel='stylesheet'>
            <link href='css/stile.css' rel='stylesheet'>
        </head>
        <body>
        ";
        echo $html;
    }

    public static function OPENCONTAINER() {
        $html = "
        <div class='container theme-showcase' role='main'>
        ";
        echo $html;
    }

    public static function CLOSECONTAINER() {
        $html = "
        </div> <!-- /container -->
        ";
        echo $html;
    }

    public static function END() {
        $html = "
        </body>
        </html>
        ";
        echo $html;
    }

    public static function MENU($file) {
        $html = "
        <nav class='navbar navbar-expand-lg navbar-light'>
            <a class='navbar-brand' href='index.php'>Home</a>
            <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
            </button>
            <div class='collapse navbar-collapse' id='navbarNav'>
                <ul class='navbar-nav'>
        ";
        echo $html;

        $html = "
        <li class='nav-item'><a class='nav-link' href='admin_codici.php'>Codici</a></li>
        <li class='nav-item'><a class='nav-link' href='admin_libri.php'>Libri</a></li>
        ";
        echo $html;

        $html = "
                </ul>
            </div>
        </nav>
        ";
        echo $html;
    }

    public static function JUMBOTRON($titolo, $sottotitolo) {
        echo '<div class="jumbotron">';
        if(!empty($titolo)){
            echo "<h1>$titolo</h1>";
        }
        if(!empty($sottotitolo)){
            echo "<h3>$sottotitolo</h3>";
        }
        echo '</div>';
    }

    public static function SCRIPT($attivi) {
        if($attivi){
            $html = "
            <script src='vendor/jquery/jquery-3.2.1.min.js'></script>
            <script src='vendor/popper/popper.min.js'></script>
            <script src='vendor/bootstrap/bootstrap.min.js'></script>
            ";
            echo $html;
        }
    }

    public static function HEADER($header) {
        if(!empty($header)){
            echo "<div class='page-header'>";
            echo "<h4>$header</h4>";
            echo "</div>";
        }
    }

    public static function ALERT($titolo, $messaggio) {
        $html = "
        <div class='alert alert-danger alert-dismissible'>
            <h4>
                <i class='fa fa-ban'></i> $titolo
            </h4>
            $messaggio
        </div>
        ";
        echo $html;
    }

    public static function SUCCESS($titolo, $messaggio) {
        $html = "
        <div class='alert alert-success alert-dismissible'>
            <h4>
                <i class='fa fa-check'></i> $titolo
            </h4>
            $messaggio
        </div>
        ";
        echo $html;
    }

    public static function BUTTON($text, $link) {
        $html = "
        <div class='row'>
        <div class='col-md-12'>
            <a href='$link'>$text<a>
        </div>
        </div>        
        ";
        echo $html;
    }

    public static function SHOW_NOTICES($notices, $linkback="") {
        // Controllo se c'è il success
        if(!empty($notices['ok'])) {
            self::SUCCESS("OK!", $notices['ok']);
            $notices=[];
            if(!empty($linkback)) {
                self::BUTTON("Torna indietro", $linkback);
            }
        }

        // Se ci sono errori
        if(!empty($notices)) {
            foreach($notices as $notice) {
                self::ALERT("ATTENZIONE!", $notice);
            }
            if(!empty($linkback)) {
                self::BUTTON("Torna indietro", $linkback);
            }
        }
    }
}