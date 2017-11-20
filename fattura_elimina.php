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
if (empty($notices) && !Fattura::EXIST($id)) {
    $notices[] = 'Nessuna fattura con questo ID';
}

// MOSTRO LA SCELTA
if(empty($notices) && $ok != 1) {
    $fattura = new Fattura();
    $fattura->FIND_BY_ID($id);

    $HTML->scelta("ATTENZIONE! CANCELLARE LA FATTURA?", $fattura->getInfo(), "CANCELLA", "$basename_corrente?id=$id&ok=1", "fattura.php");
}

// SE INVECE HO ACCETTATO
if(empty($notices) && $ok == 1) {

    // CANCELLA DAL DB
    if(!Fattura::DELETE_BY_ID($id)) {
        $notices[] = 'Errore nella cancellazione sulla base dati';
    }
    $notices['ok'] = "Fattura cancellata";
}

Html_default::SHOW_NOTICES($notices, "fattura.php");

/* -----------------------------
*      FINE CORPO FILE
* -----------------------------
*/

// Elementi di chiusura
Html_default::CLOSECONTAINER();
Html_default::SCRIPT(True);
Html_default::END();