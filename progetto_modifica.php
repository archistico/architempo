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
$csrfname = $filename_corrente.":".$utentefk."-csrf";
/* -----------------------------
 *       CORPO FILE
 * -----------------------------
 */

// SE FORM INVIATO
// SE SONO VUOTI TUTTI NON VALIDARE -> FORM NON SUBMIT
if (!empty($_POST['descrizione']) && !empty($_POST['clientefk']) && !empty($_POST['tipologiafk']) && isset($_POST['compenso']) && isset($_POST['acconto'], $_POST['id'], $_POST['ok']) && $_POST['ok']==1
    && (isset($_POST[$csrfname]) && isset($_SESSION[$csrfname]) && $_POST[$csrfname] == $_SESSION[$csrfname])
) {

    // cancello il CSRF
    $_SESSION[$csrfname] = '';

    // VALIDAZIONE
    if (empty($_POST['descrizione'])) {
        $notices[] = 'Descrizione non passato';
    } else {
        $descrizione = Utilita::PULISCISTRINGA($_POST['descrizione']);
    }

    if (empty($_POST['clientefk'])) {
        $notices[] = 'Cliente non passato';
    } else {
        $clientefk = Utilita::PULISCISTRINGA($_POST['clientefk']);
    }

    if (empty($_POST['tipologiafk'])) {
        $notices[] = 'Tipologia non passata';
    } else {
        $tipologiafk = Utilita::PULISCISTRINGA($_POST['tipologiafk']);
    }

    // valore che potrebbero essere zero
    if (!isset($_POST['id'])) {
        $notices[] = 'Id non passato';
    } else {
        $id = Utilita::PULISCISTRINGA($_POST['id']);
    }

    if (!isset($_POST['compenso'])) {
        $notices[] = 'Compenso non passato';
    } else {
        $compenso = Utilita::PULISCISTRINGA($_POST['compenso']);
    }

    // valore che potrebbero essere zero
    if (!isset($_POST['acconto'])) {
        $notices[] = 'Acconto non passato';
    } else {
        $acconto = Utilita::PULISCISTRINGA($_POST['acconto']);
    }

    // Checkbox
    if (!isset($_POST['pagato'])) {
        $pagato = 0;
    } else {
        $pagato = 1;
    }

    // Checkbox
    if (!isset($_POST['completato'])) {
        $completato = 0;
    } else {
        $completato = 1;
    }

    if(empty($notices)) {

        // AGGIUNGO IL TEMPO NEL DB
        $p = new Progetto();
        $p->descrizione = $descrizione;
        $p->clientefk = $clientefk;
        $p->tipologiafk = $tipologiafk;
        $p->compenso = $compenso;
        $p->acconto = $acconto;
        $p->pagato = $pagato;
        $p->completato = $completato;

        if(!$p->DB_Update($id)) {
            $notices[] = 'Errore nella query sulla base dati';
        } else {
            $notices['ok'] = "Modificato";
        }
    }

    unset($_POST);
    $_POST = array();
}

// --------------------------------------------------------------------------------------------------------

// Creo il formid per questa sessione
$_SESSION[$csrfname] = $utentefk . "-" . md5(rand(0,10000000));

Html_default::SHOW_NOTICES($notices, "progetto.php");

// SE DEVO ANCORA MODIFICARE I DATI
if(isset($_GET['ok'], $_GET['id']) && $_GET['ok']==0) {
    // Per nuovo progetto
    Html_default::HEADER("Modifica progetto");

    // Carica dati da iniettare
    $utenti = new Utenti();
    $utenti->getDB_All();

    $tipologie = new Tipologie();
    $tipologie->getDB_All();

    // VALIDAZIONE DATI INSERITI
    if (empty($_GET['id'])) {
        $notices[] = 'ID non inserito';
    } else {
        $id = Utilita::PULISCISTRINGA($_GET['id']);
    }

    // CONTROLLO ID ESISTENTE
    if (empty($notices) && !Progetto::EXIST($id)) {
        $notices[] = 'Nessun progetto con questo ID';
    }

    $progetto = new Progetto();
    $progetto->getDataByID($id);

    $HTML->FORM_MODIFICA_PROGETTO($progetto, $utenti->getUtenti(), $tipologie->getTipologie(), $basename_corrente, "progetto.php",  htmlspecialchars($_SESSION[$csrfname]), $csrfname);
}


/* -----------------------------
 *      FINE CORPO FILE
 * -----------------------------
 */

// Elementi di chiusura
Html_default::CLOSECONTAINER();
Html_default::SCRIPT(True);
Html_default::END();