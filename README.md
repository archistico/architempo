# ARCHITEMPO
Time tracker per liberi professionisti
  
[![Screenshot-2017-11-16_Architempo_-_INDEX.png](https://s7.postimg.org/evhdp4gqj/Screenshot-2017-11-16_Architempo_-_INDEX.png)](https://postimg.org/image/t1x4kcrlj/)
  
[![Screenshot-2017-11-16_Architempo_-_TEMPO.png](https://s7.postimg.org/v6hhlgvt7/Screenshot-2017-11-16_Architempo_-_TEMPO.png)](https://postimg.org/image/8hsalwefb/)
  
## Requisiti
+ PHP 7
+ mysql / mariadb

## Install
git clone https://github.com/archistico/architempo.git  
set db host, user, password on file config.php 

## sql
+ mysql -u root -p'toor'    
  + create database architempo;  
  + exit  
+ mysql -u root -p'toor' architempo < sql/tabella_tempo.sql
+ mysql -u root -p'toor' architempo < sql/tabella_progetto.sql
+ mysql -u root -p'toor' architempo < sql/tabella_ruolo.sql
+ mysql -u root -p'toor' architempo < sql/tabella_tipologia.sql
+ mysql -u root -p'toor' architempo < sql/tabella_utente.sql
+ mysql -u root -p'toor' architempo < sql/tabella_login.sql
  
[![schemadb.jpg](https://s7.postimg.org/grhy5fp4r/schemadb.jpg)](https://postimg.org/image/z72f2u393/)
  
## fake data
+ mysql -u root -p'toor' architempo < sql/tabella_progetto_insert_fake.sql
+ mysql -u root -p'toor' architempo < sql/tabella_ruolo_insert_fake.sql
+ mysql -u root -p'toor' architempo < sql/tabella_tipologia_insert_fake.sql
+ mysql -u root -p'toor' architempo < sql/tabella_utente_insert_fake.sql

## dump dati
+ mysqldump --user='root' --password='toor' architempo> dump.sql

## Accesso con dati fake
+ Email: indirizzo1@email.com
+ Password: toor

## File config.php
Aggiungere il file nella cartella principale

<?php  
if(file_exists('config_dist.php')) {  
    // SE DISTANTE  
    require_once('config_dist.php');  
} else {  
    // DEFINIZIONI GLOBALI LOCALI  
    define(GLOBAL_DB_HOST, "localhost");  
    define(GLOBAL_DB_NAME, "architempo");  
    define(GLOBAL_DB_USER, "root");  
    define(GLOBAL_DB_PSWD, "");  
    define(GLOBAL_DB_SALT, "");  
    define(GLOBAL_COOKIENAME, "");  
  
    // DATI PER FATTURAZIONE  
    define(STUDIO_LOGO, "img/Logo.png");  
  
    define(STUDIO_DENOMINAZIONE, "Denominazione");  
    define(STUDIO_PROPRIETA, "di XXXXXX");  
    define(STUDIO_INDIRIZZO, "Indirizzo, CAP, Città");  
  
    define(STUDIO_TELEFONO, "000 00 00 000");  
    define(STUDIO_EMAIL, "xxxx@xxxx.xxx");  
    define(STUDIO_RECAPITI, "Tel: ".STUDIO_TELEFONO." Email: ".STUDIO_EMAIL);  
  
    define(STUDIO_PIVA, "000 00 00 00 00");  
    define(STUDIO_CF, "XXX XXX 00X00 X000X");  
    define(STUDIO_DATI_FISCALI, "P.IVA: ".STUDIO_PIVA." C.F. : ".STUDIO_CF);  
  
    define(STUDIO_PAGAMENTO_MODALITA, "Bonifico");  
    define(STUDIO_PAGAMENTO_CONTO, "Conto ...");  
    define(STUDIO_PAGAMENTO_IBAN, "IT 00 ....");  
    define(STUDIO_PAGAMENTO_INTESTAZIONE, "");  
  
    // STRINGHE UTILI  
    define('EURO',chr(128));  
}  

## Altro

### Database class

https://gist.github.com/danferth/9512172#file-zdb-php-L9  
  
[![Screenshot-2017-11-16_Architempo_-_STATISTICHE.png](https://s7.postimg.org/ydc154qjv/Screenshot-2017-11-16_Architempo_-_STATISTICHE.png)](https://postimg.org/image/o39m5w0o7/)