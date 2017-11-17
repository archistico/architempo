<?php
class Autaut {
    public static function CHECK_CREDENTIAL($admitted_role) {
        if(self::AUTENTICATO()) {
            // SE E' AUTENTICATO
            if(!self::AUTORIZZATO($admitted_role)) {
                // SE NO E' AUTORIZZATO
                Utilita::REDIRECT("error.php");
            }
        } else {
            // SE NON E' AUTENTICATO
            Utilita::REDIRECT("login.php");
        }
    }

    public static function AUTENTICATO() {
        // Ogni volta che autentico guardo se ho un cookie in cui c'è il name della session da controllare
        // Se non c'è lo creo

        if(empty($_COOKIE[GLOBAL_COOKIENAME].":utenteid")) {
            $value = md5(rand(0,10000000));
            setcookie(GLOBAL_COOKIENAME, $value);
            // Attivo il login in cui i dati di sessione saranno da cercare nel SESSION[$_COOKIE[GLOBAL_COOKIENAME]]
            // I dati nel SESSION[$_COOKIE[GLOBAL_COOKIENAME]] me li deve mettere il form di login
            return false;
        } else {
            // Se ho già il cookie
            // Cerco nel session se ho i dati di login
            // Salvo nel session utentefk
            if(!empty($_SESSION[$_COOKIE[GLOBAL_COOKIENAME].":utenteid"])) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function AUTORIZZATO($admitted_role) {
        // $admitted_role is array
        if(in_array($_SESSION[$_COOKIE[GLOBAL_COOKIENAME].":ruolo"], $admitted_role)) {
            return true;
        } else {
            return false;
        }
    }

    public static function LOGGATO() {
        // Ritorna il utentefk se è stato loggato
        return $_SESSION[$_COOKIE[GLOBAL_COOKIENAME].":utenteid"];
    }

    public static function LOGGATO_RUOLO() {
        // Ritorna il utentefk se è stato loggato
        return $_SESSION[$_COOKIE[GLOBAL_COOKIENAME].":ruolo"];
    }
}