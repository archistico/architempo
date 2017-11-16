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

## fake data
+ mysql -u root -p'toor' architempo < sql/tabella_progetto_insert_fake.sql
+ mysql -u root -p'toor' architempo < sql/tabella_ruolo_insert_fake.sql
+ mysql -u root -p'toor' architempo < sql/tabella_tipologia_insert_fake.sql
+ mysql -u root -p'toor' architempo < sql/tabella_utente_insert_fake.sql

## Accesso con dati fake
+ Email: indirizzo1@email.com
+ Password: toor

### Database class

https://gist.github.com/danferth/9512172#file-zdb-php-L9  
  
[![Screenshot-2017-11-16_Architempo_-_STATISTICHE.png](https://s7.postimg.org/ydc154qjv/Screenshot-2017-11-16_Architempo_-_STATISTICHE.png)](https://postimg.org/image/o39m5w0o7/)