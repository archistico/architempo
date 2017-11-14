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

if (isset($_POST['denominazione'], $_POST['ruolofk'], $_POST['indirizzo'], $_POST['cf'], $_POST['piva'], $_POST['telefono'], $_POST['email'], $_POST['password'], $_POST['note'], $_POST['id'], $_POST['ok']) && $_POST['ok']==1
    && (isset($_POST[$csrfname]) && isset($_SESSION[$csrfname]) && $_POST[$csrfname] == $_SESSION[$csrfname])
) {

    // cancello il CSRF
    $_SESSION[$csrfname] = '';

    // VALIDAZIONE
    if (empty($_POST['denominazione'])) {
        $notices[] = 'Denominazione non passata';
    } else {
        $denominazione = Utilita::PULISCISTRINGA($_POST['denominazione']);
    }

    if (empty($_POST['ruolofk'])) {
        $notices[] = 'Ruolo non passato';
    } else {
        $ruolofk = Utilita::PULISCISTRINGA($_POST['ruolofk']);
    }

    if (empty($_POST['indirizzo'])) {
        $notices[] = 'Indirizzo non passato';
    } else {
        $indirizzo = Utilita::PULISCISTRINGA($_POST['indirizzo']);
    }

    if (empty($_POST['cf'])) {
        $notices[] = 'Codice fiscale non passato';
    } else {
        $cf = Utilita::PULISCISTRINGA($_POST['cf']);
    }

    if (empty($_POST['piva'])) {
        $notices[] = 'Partiva iva non passata';
    } else {
        $piva = Utilita::PULISCISTRINGA($_POST['piva']);
    }

    if (empty($_POST['telefono'])) {
        $notices[] = 'Telefono non passato';
    } else {
        $telefono = Utilita::PULISCISTRINGA($_POST['telefono']);
    }

    if (empty($_POST['email'])) {
        $notices[] = 'Email non passato';
    } else {
        $email = Utilita::PULISCISTRINGA($_POST['email']);
    }

    if (empty($_POST['password'])) {
        $notices[] = 'Password non passata';
    } else {
        $password = Utilita::PULISCISTRINGA($_POST['password']);
    }

    if (empty($_POST['note'])) {
        $notices[] = 'Note non passato';
    } else {
        $note = Utilita::PULISCISTRINGA($_POST['note']);
    }

    if (!isset($_POST['id'])) {
        $notices[] = 'Id non passato';
    } else {
        $id = Utilita::PULISCISTRINGA($_POST['id']);
    }

    if(empty($notices)) {

        // AGGIUNGO IL TEMPO NEL DB
        $u= new Utente();
        $u->denominazione = $denominazione;
        $u->indirizzo = $indirizzo;
        $u->cf = $cf;
        $u->piva = $piva;
        $u->telefono = $telefono;
        $u->email = $email;
        $u->password = $password;
        $u->ruolofk = $ruolofk;
        $u->note = $note;

        if(!$u->DB_Update($id)) {
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

Html_default::SHOW_NOTICES($notices, "utente.php");

// SE DEVO ANCORA MODIFICARE I DATI
if(isset($_GET['ok'], $_GET['id']) && $_GET['ok']==0) {

    Html_default::HEADER("Modifica utente");

    // Carica dati da iniettare
    $ruoli = new Ruoli();
    $ruoli->getDB_All();

    // VALIDAZIONE DATI INSERITI
    if (empty($_GET['id'])) {
        $notices[] = 'ID non inserito';
    } else {
        $id = Utilita::PULISCISTRINGA($_GET['id']);
    }

    // CONTROLLO ID ESISTENTE
    if (empty($notices) && !Utente::EXIST($id)) {
        $notices[] = 'Nessun progetto con questo ID';
    }

    $utente = new Utente();
    $utente->getDataByID($id);

    $HTML->FORM_MODIFICA_UTENTE($utente, $ruoli->getRuoli(), $basename_corrente, "utente.php",  htmlspecialchars($_SESSION[$csrfname]), $csrfname);
}


/* -----------------------------
 *      FINE CORPO FILE
 * -----------------------------
 */

// Elementi di chiusura
Html_default::CLOSECONTAINER();
Html_default::SCRIPT(True);
Html_default::END();