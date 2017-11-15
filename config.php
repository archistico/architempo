<?php
if(file_exists('config_dist.php')) {
    // SE DISTANTE
    require_once('config_dist.php');
} else {
    // DEFINIZIONI GLOBALI LOCALI
    define(GLOBAL_DB_HOST, "localhost");
    define(GLOBAL_DB_NAME, "architempo");
    define(GLOBAL_DB_USER, "root");
    define(GLOBAL_DB_PSWD, "toor");
    define(GLOBAL_DB_SALT, "qwerty");
    define(GLOBAL_COOKIENAME, "Architempo");
}