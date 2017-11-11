<?php
// Caricamento configurazione e utilita
require_once('config.php');
require_once('classi/utilita.php');
Utilita::PARAMETRI_INIZIALI();

require_once('classi/file.php');

// Caricamento template HTML
$file_corrente = File::FILENAME(__FILE__);
require_once('template/html_default.php');
require_once('template/html_'.$file_corrente.'.php');

Html_default::HEAD("Architempo - ".strtoupper($file_corrente));
Html_default::OPENCONTAINER();
Html_default::MENU($file_corrente);
Html_default::JUMBOTRON("Studio Archistico", "Time tracker");

// Elementi di chiusura
Html_default::CLOSECONTAINER();
Html_default::SCRIPT(True);
Html_default::END();