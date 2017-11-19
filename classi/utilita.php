<?php

class Utilita {

    public static function PARAMETRI_INIZIALI() {
        define('CHARSET', 'UTF-8');
        define('REPLACE_FLAGS', ENT_COMPAT | ENT_XHTML);

        ini_set('display_errors',1);
        error_reporting(E_ALL);

        session_start();
    }

    /* --------------------------------------------------
     *                 UTENTI E LOG
     * --------------------------------------------------
     */

    public static function LOG($descrizione_log, $codice_log, $download_log, $login_log) {
        include 'config.php';
        try {
            $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');
            $ip_log = get_client_ip();
            $sql = "INSERT INTO accesso (accessoid, descrizione, codice, data, ip, download, login) VALUES (NULL, '{$descrizione_log}', '{$codice_log}', CURRENT_TIMESTAMP, '{$ip_log}', '{$download_log}', '{$login_log}');";
            $db->exec($sql);
            // chiude il database
            $db = NULL;
        } catch (PDOException $e) {
            echo "Errore nel loggin<br>";
        }
    }

    public static function GET_CLIENT_IP() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    /* --------------------------------------------------
     *                    STRINGHE
     * --------------------------------------------------
     */

    public static function WRITELINE($str){
        echo $str."<br>";
    }

    public static function PULISCISTRINGA($str){
        $str = str_replace("  ", " ", $str);
        $str = str_replace("'", " ", $str);
        $str = str_replace("’", " ", $str);
        $str = str_replace("–", "-", $str);
        $str = str_replace("“", " ", $str);
        $str = str_replace("”", " ", $str);
        $str = str_replace("\"", " ", $str);
        return trim($str);
    }

    public static function DB2HTML($stringa) {
        return utf8_encode($stringa);
    }
    public static function HTML2DB($stringa) {
        return utf8_decode($stringa);
    }

    public static function SANITIZE_NUMERI($str) {
        // FILTER_SANITIZE_MAGIC_QUOTES
        return filter_var(str_replace(array('+','-','_','|','%',';',':','"','\'','/'), '', $str), FILTER_SANITIZE_NUMBER_INT);
    }

    public static function SANITIZE_NUMERILETTERE($str) {
        return preg_replace("/[^a-zA-Z0-9]+/", "", $str);
    }

    public static function VALIDATE_DATE($date, $format = 'd/m/Y H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public static function VALIDATE_DATE_SHORT($date, $format = 'd/m/Y')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public static function REDIRECT($link = 'login.php')
    {
        header ("Location: $link");
        exit();
    }

    public static function EURO($valore) {
        return "&euro; ".number_format($valore, 2, ',', ' ');
    }
}
