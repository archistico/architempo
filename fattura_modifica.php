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

// SE SONO VUOTI TUTTI NON VALIDARE -> FORM NON SUBMIT
if (isset($_POST['id'], $_POST['data'], $_POST['numero'], $_POST['progettofk'], $_POST['oggetto'], $_POST['importo'], $_POST['totale'])
    && (isset($_POST[$csrfname]) && isset($_SESSION[$csrfname]) && $_POST[$csrfname] == $_SESSION[$csrfname])
) {

    // cancello il CSRF
    $_SESSION[$csrfname] = '';

    // VALIDAZIONE
    if (empty($_POST['id'])) {
        $notices[] = 'ID non passato';
    } else {
        $id = Utilita::PULISCISTRINGA($_POST['id']);
    }

    if (empty($_POST['data'])) {
        $notices[] = 'Data non passata';
    } else {
        if(Utilita::VALIDATE_DATE_SHORT($_POST['data'])) {
            $data = $_POST['data'];
        } else {
            $notices[] = 'Data non valida: '.$_POST['data'];
        }
    }

    if (!isset($_POST['numero'])) {
        $notices[] = 'Numero non passato';
    } else {
        $numero = Utilita::PULISCISTRINGA($_POST['numero']);
    }

    if (empty($_POST['progettofk'])) {
        $notices[] = 'Progetto non passato';
    } else {
        $progettofk = Utilita::PULISCISTRINGA($_POST['progettofk']);
    }

    if (empty($_POST['oggetto'])) {
        $notices[] = 'Oggetto non passato';
    } else {
        $oggetto = Utilita::PULISCISTRINGA($_POST['oggetto']);
    }

    if (!isset($_POST['importo'])) {
        $notices[] = 'Importo non passato';
    } else {
        $importo = Utilita::PULISCISTRINGA($_POST['importo']);
    }

    if (!isset($_POST['totale'])) {
        $notices[] = 'Totale non passato';
    } else {
        $totale = Utilita::PULISCISTRINGA($_POST['totale']);
    }

    // Checkbox
    if (!isset($_POST['pagato'])) {
        $pagato = 0;
    } else {
        $pagato = 1;
    }

    if(empty($notices)) {

        // AGGIUNGO IL TEMPO NEL DB

        $t = new Fattura();

        $t->numero = $numero;
        $t->setData($data);
        $t->anno = $t->getAnno();
        $t->progettofk = $progettofk;
        $t->oggetto = $oggetto;
        $t->importo = $importo;
        $t->totale = $totale;
        $t->pagato = $pagato;

        if(!$t->DB_Update($id)) {
            $notices[] = 'Errore nella query sulla base dati';
        } else {
            $notices['ok'] = "Fattura modificata";
        }
    }

    unset($_POST);
    $_POST = array();
}

// --------------------------------------------------------------------------------------------------------

// Creo il formid per questa sessione
$_SESSION[$csrfname] = $utentefk . "-" . md5(rand(0,10000000));

// SE DEVO ANCORA MODIFICARE I DATI
if(isset($_GET['ok'], $_GET['id']) && $_GET['ok']==0) {
    // Per nuovo progetto
    Html_default::HEADER("Modifica progetto");

    // VALIDAZIONE DATI INSERITI
    if (empty($_GET['id'])) {
        $notices[] = 'ID non inserito';
    } else {
        $id = Utilita::PULISCISTRINGA($_GET['id']);
    }

    // CONTROLLO ID ESISTENTE
    if (empty($notices) && !Fattura::EXIST($id)) {
        $notices[] = 'Nessun progetto con questo ID';
    } else {

        // Carica dati da iniettare
        $progetti = new Progetti();
        $progetti->getDB_All();

        // carica dati fattura
        $fattura = new Fattura();
        $fattura->FIND_BY_ID($id);

        $HTML->FORM_FATTURA_MODIFICA($fattura, $progetti->getProgetti(), $basename_corrente, "fattura.php",  htmlspecialchars($_SESSION[$csrfname]), $csrfname);
    }
}

Html_default::SHOW_NOTICES($notices, "fattura.php");

/* -----------------------------
 *      FINE CORPO FILE
 * -----------------------------
 */

// Elementi di chiusura
Html_default::CLOSECONTAINER();
Html_default::SCRIPT(true, true);
$HTML->CaricaJS($filename_corrente);
Html_default::END();