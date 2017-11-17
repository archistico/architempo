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

// SE FORM INVIATO
// SE SONO VUOTI TUTTI NON VALIDARE -> FORM NON SUBMIT
if (!empty($_POST['denominazione']) && !empty($_POST['ruolofk'])
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
        if(filter_var(Utilita::PULISCISTRINGA($_POST['email']), FILTER_VALIDATE_EMAIL)) {
            $email = Utilita::PULISCISTRINGA($_POST['email']);
        } else {
            $notices[] = 'Email non valida';
        }        
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

    if(empty($notices)) {

        // AGGIUNGO NEL DB

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

        if(!$u->DB_Add()) {
            $notices[] = 'Errore nella query sulla base dati';
        } else {
            $notices['ok'] = "Inserito";
        }
    }

    unset($_POST);
    $_POST = array();
}

// --------------------------------------------------------------------------------------------------------

// Creo il formid per questa sessione
$_SESSION[$csrfname] = $utentefk . "-" . md5(rand(0,10000000));

Html_default::SHOW_NOTICES($notices);

// Per nuovo utente
Html_default::HEADER("Crea nuovo utente");

// Carica dati da iniettare
$ruoli = new Ruoli();
$ruoli->getDB_All();

$HTML->FORM_NUOVO_UTENTE($ruoli->getRuoli(), $basename_corrente, "utente.php",  htmlspecialchars($_SESSION[$csrfname]), $csrfname);

/* -----------------------------
 *      FINE CORPO FILE
 * -----------------------------
 */

// Elementi di chiusura
Html_default::CLOSECONTAINER();
Html_default::SCRIPT(True);
Html_default::END();