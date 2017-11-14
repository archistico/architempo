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
$csrfname = $filename_corrente.":".$utentefk.":csrf";
/* -----------------------------
 *       CORPO FILE
 * -----------------------------
 */


// SE SONO VUOTI TUTTI NON VALIDARE -> FORM NON SUBMIT
if (isset($_POST['progettofk'], $_POST['descrizione'], $_POST['datainizio'], $_POST['datafine'], $_POST['orainizio'], $_POST['minutiinizio'], $_POST['orafine'], $_POST['minutifine'])
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

    if (empty($_POST['progettofk'])) {
        $notices[] = 'Progetto non passato';
    } else {
        $progettofk = Utilita::PULISCISTRINGA($_POST['progettofk']);
    }

    if (empty($_POST['datainizio']) || !isset($_POST['orainizio'], $_POST['minutiinizio'])) {
        $notices[] = 'Data inizio non passata';
    } else {
        $inizio_str = $_POST['datainizio']." ".str_pad($_POST['orainizio'],2,'0').":".str_pad($_POST['minutiinizio'],2,'0').":00";
        if(Utilita::VALIDATE_DATE($inizio_str)) {
            $datainizio = $inizio_str;
        } else {
            $notices[] = 'Data inizio non valida';
        }
    }

    if (empty($_POST['datafine']) || !isset($_POST['orafine'], $_POST['minutifine'])) {
        $notices[] = 'Data fine non passata';
    } else {
        $fine_str = $_POST['datafine']." ".str_pad($_POST['orafine'],2,'0').":".str_pad($_POST['minutifine'],2,'0').":00";
        if(Utilita::VALIDATE_DATE($fine_str)) {
            $datafine = $fine_str;
        } else {
            $notices[] = 'Data fine non valida';
        }
    }

    if(empty($notices)) {
      if($datainizio > $datafine) {
          $notices[] = 'Data fine precedente a quella iniziale';
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
            $notices['ok'] = "Tempo manuale inserito";
        }
    }

    unset($_POST);
    $_POST = array();
} else {
    // Creo il formid per questa sessione
    $_SESSION[$csrfname] = $utentefk . "-" . md5(rand(0,10000000));

    // HOME CARICA DATI PER FORM - NUOVO TEMPO
    $progetti = new Progetti();
    $progetti->getDB_All();

    $HTML->Form_tempo_nuovo($progetti->getProgetti(), $basename_corrente, 'tempo.php', htmlspecialchars($_SESSION[$csrfname]), $csrfname);
}

Html_default::SHOW_NOTICES($notices, "tempo.php");

/* -----------------------------
 *      FINE CORPO FILE
 * -----------------------------
 */

// Elementi di chiusura
Html_default::CLOSECONTAINER();
Html_default::SCRIPT(true, true);
$HTML->CaricaJS($filename_corrente);
Html_default::END();