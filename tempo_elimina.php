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

// VALIDAZIONE
if (empty($_GET['id'])) {
    $notices[] = 'ID non inserito';
} else {
    $id = Utilita::PULISCISTRINGA($_GET['id']);
}
if (!isset($_GET['ok'])) {
    $notices[] = 'Bypass non attivo';
} else {
    $ok = Utilita::PULISCISTRINGA($_GET['ok']);
}

// CONTROLLO ID ESISTENTE
if (empty($notices) && !Tempo::EXIST($id)) {
    $notices[] = 'Nessun tempo con questo ID';
}

// MOSTRO LA SCELTA
if(empty($notices) && $ok != 1) {
    $tempo = new Tempo();
    $tempo->getDataByID($id);
    $HTML->scelta("ATTENZIONE! CANCELLARE IL TEMPO?", $tempo->getInfo(), "CANCELLA", "$basename_corrente?id=$id&ok=1", "tempo.php");
}

// SE INVECE HO ACCETTATO
if(empty($notices) && $ok == 1) {
    $tempo = new Tempo();
    $tempo->getDataByID($id);

    // CANCELLA LIBRO DAL DB
    if(!Tempo::DELETE_BY_ID($id)) {
        $notices[] = 'Errore nella cancellazione sulla base dati';
    }
    $notices['ok'] = "Tempo cancellato";
}

Html_default::SHOW_NOTICES($notices, "tempo.php");

/* -----------------------------
*      FINE CORPO FILE
* -----------------------------
*/

// Elementi di chiusura
Html_default::CLOSECONTAINER();
Html_default::SCRIPT(True);
Html_default::END();