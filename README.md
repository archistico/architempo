# architempo
Time tracker per liberi professionisti

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

### Database class

https://gist.github.com/danferth/9512172#file-zdb-php-L9  
 
