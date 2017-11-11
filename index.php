<?php
// Caricamento configurazione e utilita
require_once('config.php');
require_once('classi/utilita.php');
Utilita::PARAMETRI_INIZIALI();
$notices = [];

require_once('classi/file.php');
require_once('classi/ruolo.php');
require_once('classi/utente.php');
require_once('classi/database.php');
require_once('classi/tipologia.php');
require_once('classi/progetto.php');
require_once('classi/tempo.php');

// Caricamento template HTML
$filename_corrente = File::FILENAME(__FILE__);
$basename_corrente = File::BASENAME(__FILE__);
require_once('template/html_default.php');
require_once('template/html_'.$filename_corrente.'.php');
$nameclassHTML = "Html_".$filename_corrente;
$HTML = new $nameclassHTML();

Html_default::HEAD("Architempo - ".strtoupper($filename_corrente));
Html_default::OPENCONTAINER();
Html_default::MENU($basename_corrente);
Html_default::JUMBOTRON("Studio Archistico", "Time tracker");

/* -----------------------------
 *       CORPO FILE
 * -----------------------------
 */

$progetti = new Progetti();
$progetti->getDB_All();

$HTML->Form_nuovo_tempo($progetti->getProgetti(), $basename_corrente);



/* -----------------------------
 *      FINE CORPO FILE
 * -----------------------------
 */

Html_default::SHOW_NOTICES($notices);

// Elementi di chiusura
Html_default::CLOSECONTAINER();
Html_default::SCRIPT(True);
Html_default::END();