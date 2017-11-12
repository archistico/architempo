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

// SE SONO VUOTI TUTTI NON VALIDARE -> FORM NON SUBMIT
if (!empty($_POST['descrizione']) && !empty($_POST['progettofk']) && !empty($_POST['datainizio']) && !empty($_POST['datafine'])
    && (isset($_POST['csrf']) && isset($_SESSION['csrf']) && $_POST["csrf"] == $_SESSION["csrf"])
    ) {

    // cancello il CSRF
    $_SESSION["csrf"] = '';

    // VALIDAZIONE
    if (empty($_POST['descrizione'])) {
        $notices[] = 'Descrizione non passato';
    } else {
        $descrizione = Utilita::PULISCISTRINGA($_POST['descrizione']);
    }

    if (empty($_POST['progettofk'])) {
        $notices[] = 'Progetto non passato';
    } else {
        $progettofk = Utilita::PULISCISTRINGA($_POST['progettofk']);
    }

    if (empty($_POST['datainizio'])) {
        $notices[] = 'Data inizio non passata';
    } else {
        if(Utilita::VALIDATE_DATE($_POST['datainizio'])) {
            $datainizio = $_POST['datainizio'];
        } else {
            $notices[] = 'Data inizio non valida';
        }
    }

    if (empty($_POST['datafine'])) {
        $notices[] = 'Data fine non passata';
    } else {
        if(Utilita::VALIDATE_DATE($_POST['datafine'])) {
            $datafine = $_POST['datafine'];
        } else {
            $notices[] = 'Data fine non valida';
        }
    }

    if(empty($notices)) {

        // AGGIUNGO IL TEMPO NEL DB

        $t = new Tempo();
        $t->progettofk = $progettofk;
        $t->descrizione = $descrizione;
        $t->setDatainizio($datainizio);
        $t->setDatafine($datafine);
        $t->utentefk = $utentefk;

        if(!$t->DB_Add()) {
            $notices[] = 'Errore nella query sulla base dati';
        } else {
            $notices['ok'] = "Inserito";
        }
    }

    unset($_POST);
    $_POST = array();
}

// Creo il formid per questa sessione
$_SESSION["csrf"] = $utentefk . "-" . md5(rand(0,10000000));

Html_default::SHOW_NOTICES($notices);

// HOME CARICA DATI PER FORM - NUOVO TEMPO
$progetti = new Progetti();
$progetti->getDB_All();

$HTML->Form_nuovo_tempo($progetti->getProgetti(), $basename_corrente, htmlspecialchars($_SESSION["csrf"]));

Html_default::HEADER("Lista Registrazioni");
$tempi = new Tempi();
$tempi->getDB_All();
$HTML->Table_tempo($tempi->getTempi());

/* -----------------------------
 *      FINE CORPO FILE
 * -----------------------------
 */

// Elementi di chiusura
Html_default::CLOSECONTAINER();
Html_default::SCRIPT(True);
$HTML->CaricaJS($filename_corrente);
Html_default::END();