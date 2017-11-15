<?php
require_once('classi/file.php');
$filename_corrente = File::FILENAME(__FILE__);
$basename_corrente = File::BASENAME(__FILE__);
require_once('loader.php');


/* -----------------------------
 *     LOGICA APPLICAZIONE
 * -----------------------------
 */

if(isset($_GET['logout']) && $_GET['logout']== 1 ) {
    unset($_SESSION[$_COOKIE[GLOBAL_COOKIENAME]]);
    unset($_COOKIE[GLOBAL_COOKIENAME]);
}

if(isset($_GET['email'], $_GET['password'])) {

    // VALIDARE I DATI

    // SE NON CI SONO ERRORI
    // CONTROLLA SU DB SE: EMAIL E PASSWORD CORRISPONDONO

    $_SESSION[$_COOKIE[GLOBAL_COOKIENAME]] = 1;
    Utilita::REDIRECT('index.php');
    exit();

}

/* -----------------------------
 *       CORPO FILE
 * -----------------------------
*/

Html_default::HEAD("Architempo - ".strtoupper($filename_corrente), true);
Html_default::OPENCONTAINER();

$HTML->Login();

/* -----------------------------
 *      FINE CORPO FILE
 * -----------------------------
 */

// Elementi di chiusura
Html_default::CLOSECONTAINER();
Html_default::SCRIPT(True);
Html_default::END();
