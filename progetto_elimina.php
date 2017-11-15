<?php
require_once('classi/file.php');
$filename_corrente = File::FILENAME(__FILE__);
$basename_corrente = File::BASENAME(__FILE__);
require_once('loader.php');

/* -----------------------------
 *           LOGGIN
 * -----------------------------
 */

Autaut::CHECK_CREDENTIAL(['Amministrazione','Lavoratore']);

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
if (empty($notices) && !Progetto::EXIST($id)) {
    $notices[] = 'Nessun progetto con questo ID';
}

// MOSTRO LA SCELTA
if(empty($notices) && $ok != 1) {
    $progetto = new Progetto();
    $progetto->getDataByID($id);
    $HTML->scelta("ATTENZIONE! CANCELLARE IL PROGETTO E I RELATIVI TEMPI?", $progetto->getInfo(), "CANCELLA", "$basename_corrente?id=$id&ok=1", "progetto.php");
}

// SE INVECE HO ACCETTATO
if(empty($notices) && $ok == 1) {
    $progetto = new Progetto();
    $progetto->getDataByID($id);

    // CANCELLA DAL DB
    if(!Progetto::DELETE_BY_ID_AND_TEMPO($id)) {
        $notices[] = 'Errore nella cancellazione sulla base dati';
    }
    $notices['ok'] = "Progetto cancellato";
}

Html_default::SHOW_NOTICES($notices, "progetto.php");

/* -----------------------------
*      FINE CORPO FILE
* -----------------------------
*/

// Elementi di chiusura
Html_default::CLOSECONTAINER();
Html_default::SCRIPT(True);
Html_default::END();