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

Html_default::HEADER("Crea nuovo progetto");
Html_default::BUTTON("NUOVO", "progetto_nuovo.php", "info");

Html_default::HEADER("Lista Registrazioni");
$progetti = new Progetti();
$progetti->getDB_All();
$HTML->Table_progetto($progetti->getProgetti());

/* -----------------------------
 *      FINE CORPO FILE
 * -----------------------------
 */

// Elementi di chiusura
Html_default::CLOSECONTAINER();
Html_default::SCRIPT(True);
Html_default::END();