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
    unset($_SESSION[$_COOKIE[GLOBAL_COOKIENAME]]);
    unset($_COOKIE[GLOBAL_COOKIENAME]);
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
            $_SESSION[$_COOKIE[GLOBAL_COOKIENAME]] = 1;
            Utilita::REDIRECT('index.php');
            exit();
        } else {
            $notices[] = 'Password non corretta';
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
