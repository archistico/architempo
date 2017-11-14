<?php
require_once('classi/file.php');
$filename_corrente = File::FILENAME(__FILE__);
$basename_corrente = File::BASENAME(__FILE__);
require_once('loader.php');

Html_default::HEAD("Architempo - ".strtoupper($filename_corrente));
Html_default::OPENCONTAINER();
Html_default::MENU($basename_corrente);
Html_default::JUMBOTRON("Studio Archistico", "Time tracker");

/* -----------------------------
 *           LOGGIN
 * -----------------------------
 */
$utentefk = Utente::UTENTE_LOGGATO_ID();

/* -----------------------------
 *       CORPO FILE
 * -----------------------------
 */

Html_default::HEADER("Statistiche");

$tempi = new Tempi();
$tempi->getDB_All();
$totale_ore_lavorate = $tempi->TOTALE_ORE_LAVORATE();

$HTML->show($totale_ore_lavorate);

/* -----------------------------
 *      FINE CORPO FILE
 * -----------------------------
 */

// Elementi di chiusura
Html_default::CLOSECONTAINER();
Html_default::SCRIPT(true, false, true);
$HTML->CaricaJS($filename_corrente);
Html_default::END();