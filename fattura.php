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

// Creo il formid per questa sessione
$_SESSION[$csrfname] = $utentefk . "-" . md5(rand(0,10000000));

/*
Html_default::HEADER("Crea nuova fattura");
Html_default::BUTTON("NUOVO", "fattura_nuova.php", "info");
*/

Html_default::HEADER("Nuova fattura");
$progetti = new Progetti();
$progetti->getDB_All();
$HTML->Form_fattura_nuova($progetti->getProgetti(), $basename_corrente, 'tempo.php', htmlspecialchars($_SESSION[$csrfname]), $csrfname);

Html_default::HEADER("Lista fatture");
$fatture = new Fatture();
$fatture->getDB_All();
$HTML->Table_fatture($fatture->getFatture());


/* -----------------------------
 *      FINE CORPO FILE
 * -----------------------------
 */

// Elementi di chiusura
Html_default::CLOSECONTAINER();
Html_default::SCRIPT(True);
Html_default::END();