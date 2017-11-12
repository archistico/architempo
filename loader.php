<?php
// Caricamento configurazione e utilita
require_once('config.php');
require_once('classi/utilita.php');
Utilita::PARAMETRI_INIZIALI();
$notices = [];

require_once('classi/ruolo.php');
require_once('classi/utente.php');
require_once('classi/database.php');
require_once('classi/tipologia.php');
require_once('classi/progetto.php');
require_once('classi/tempo.php');

// Caricamento template HTML

require_once('template/html_default.php');
require_once('template/html_'.$filename_corrente.'.php');
$nameclassHTML = "Html_".$filename_corrente;
$HTML = new $nameclassHTML();