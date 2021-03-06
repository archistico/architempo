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
    if(isset($_COOKIE[GLOBAL_COOKIENAME])) {
        unset($_COOKIE[GLOBAL_COOKIENAME]);
        setcookie(GLOBAL_COOKIENAME, null, -1, '/architempo');
        setcookie(GLOBAL_COOKIENAME, null, -1, '/');
    }
}

$csrfname = $filename_corrente.":csrf";

if(isset($_GET['email'], $_GET['password']) && (isset($_GET[$csrfname]) && isset($_SESSION[$csrfname]) && $_GET[$csrfname] == $_SESSION[$csrfname])) {

    // cancello il CSRF
    $_SESSION[$csrfname] = '';

    // VALIDARE I DATI
    if (empty($_GET['password'])) {
        $notices[] = 'La password non può essere vuota';
    } else {
        $password = Utilita::PULISCISTRINGA($_GET['password']);
    }

    if (empty($_GET['email'])) {
        $notices[] = 'Email non passata';
    } else {
        $email = Utilita::PULISCISTRINGA($_GET['email']);
    }

    // CONTROLLA SU DB SE: EMAIL E PASSWORD CORRISPONDONO
    if(empty($notices)) {
        if(Utente::Check_email_password($email, $password)) {

            $utente = Utente::FIND_BY_EMAIL($email);

            if(isset($_COOKIE[GLOBAL_COOKIENAME])) {
                unset($_COOKIE[GLOBAL_COOKIENAME]);
                setcookie(GLOBAL_COOKIENAME, null, -1, '/architempo');
                setcookie(GLOBAL_COOKIENAME, null, -1, '/');
                sleep(1);
            }

            if(!isset($_COOKIE[GLOBAL_COOKIENAME])) {
                $value = md5(rand(0,10000000));
                setcookie(GLOBAL_COOKIENAME, $value, time()+86400);

                // Messo interno perché la prima volta il valore dal cookie non viene letto
                // Cosi riesco a settarlo comunque

                // USARE TABELLA DATABASE INVECE DELLA SESSIONE
                //$_SESSION[$value.":utenteid"] = $utente->utenteid;
                //$_SESSION[$value.":ruolo"] = $utente->getRuolo()->descrizione;

                // NUOVO GESTIONE PER DB
                $accesso = new Accesso();
                $accesso->cookiename = $value;
                $accesso->utentefk = $utente->utenteid;
                $accesso->utenteruolo= $utente->getRuolo()->descrizione;
                $accesso->setNow();
                $accesso->ip = Utilita::GET_CLIENT_IP();         
                $accesso->errore = '-';    
                
                $accesso->Insert();
            }

            Utilita::REDIRECT('index.php');
            exit();
        } else {
            $notices[] = 'Password non corretta';

            // INSERISCO UN ACCESSO FALLATO
            // NUOVO GESTIONE PER DB
            $accesso = new Accesso();
            $accesso->cookiename = 'Non impostato';
            $accesso->utentefk = -1;
            $accesso->utenteruolo= "-";
            $accesso->setNow();
            $accesso->ip = Utilita::GET_CLIENT_IP(); 
            $accesso->errore = $email;    
            
            $accesso->Insert();
        }
    }
}

/* -----------------------------
 *       CORPO FILE
 * -----------------------------
*/

Html_default::HEAD("Architempo - ".strtoupper($filename_corrente), true);
Html_default::OPENCONTAINER();

// Creo il formid per questa sessione
$_SESSION[$csrfname] = md5(rand(0,10000000));
$HTML->Login(htmlspecialchars($_SESSION[$csrfname]), $csrfname);
$HTML->errors($notices);

/* -----------------------------
 *      FINE CORPO FILE
 * -----------------------------
 */

// Elementi di chiusura
Html_default::CLOSECONTAINER();
Html_default::SCRIPT(True, false, false, true);
$HTML->CaricaJS($filename_corrente);
Html_default::END();
