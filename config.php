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

    // DATI PER FATTURAZIONE
    define(STUDIO_LOGO, "img/Logo.png");

    define(STUDIO_DENOMINAZIONE, "Studio Archistico");
    define(STUDIO_PROPRIETA, "di Rollandin Emilie");
    define(STUDIO_INDIRIZZO, "Via delle Xyzw, 25  - 11100 Moon-Heart (AO)");

    define(STUDIO_TELEFONO, "000 00 00 000");
    define(STUDIO_EMAIL, "info@archistico.com");
    define(STUDIO_RECAPITI, "Tel: ".STUDIO_TELEFONO." Email: ".STUDIO_EMAIL);

    define(STUDIO_PIVA, "000 00 00 00 00");
    define(STUDIO_CF, "XXX XXX 00X00 X000X");
    define(STUDIO_DATI_FISCALI, "P.IVA: ".STUDIO_PIVA." C.F. : ".STUDIO_CF);

    define(STUDIO_PAGAMENTO_MODALITA, "Bonifico");
    define(STUDIO_PAGAMENTO_CONTO, "Conto BancoMoon");
    define(STUDIO_PAGAMENTO_IBAN, "IT 00 ....");
    define(STUDIO_PAGAMENTO_INTESTAZIONE, "Rollandin Emilie");

    // STRINGHE UTILI
    define('EURO',chr(128));
}