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

Html_default::HEADER("Lista tipologie");
$tipologie = new Tipologie();
$HTML->Table_tipologie($tipologie->getTipologie());

/* -----------------------------
 *      FINE CORPO FILE
 * -----------------------------
 */

// Elementi di chiusura
Html_default::CLOSECONTAINER();
Html_default::SCRIPT(True);
Html_default::END();