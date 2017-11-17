<?php
require_once('classi/file.php');
$filename_corrente = File::FILENAME(__FILE__);
$basename_corrente = File::BASENAME(__FILE__);
require_once('loader.php');

/* -----------------------------
 *           LOGGIN
 * -----------------------------
 */

Autaut::CHECK_CREDENTIAL(['Amministrazione']);

// POSSO ACCEDERE ALLA RISORSA
$utentefk = Autaut::LOGGATO();
$csrfname = $filename_corrente.":".$utentefk.":csrf";

/* -----------------------------
 *           HTML
 * -----------------------------
 */

Html_default::HEAD("Architempo - ".strtoupper($filename_corrente));
Html_default::OPENCONTAINER();
Html_default::MENU($basename_corrente);
Html_default::JUMBOTRON("Studio Archistico", "Time tracker");

/* -----------------------------
 *       CORPO FILE
 * -----------------------------
 */

Html_default::HEADER("Statistiche");

$tempi = new Tempi();
$tempi->getDB_All();
$totale_ore_lavorate = $tempi->TOTALE_ORE_LAVORATE();

$progetti = new Progetti();
$progetti->getDB_All();
$totale_acconti = $progetti->TOTALE_ACCONTI();
$totale_compensi = $progetti->TOTALE_COMPENSI();

$HTML->show($totale_ore_lavorate, $totale_acconti, $totale_compensi);

/* -----------------------------
 *      FINE CORPO FILE
 * -----------------------------
 */

// Elementi di chiusura
Html_default::CLOSECONTAINER();
Html_default::SCRIPT(true, false, true);
$HTML->CaricaJS($filename_corrente);
Html_default::END();