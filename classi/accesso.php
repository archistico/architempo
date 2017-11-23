<?php
/* --------------------------------------
 *           CLASS ACCESSI
 * --------------------------------------
 */

class Accesso {
    public $accessoid;  // int
    
    public $cookiename; // string
    public $utentefk;   // int
    public $utenteruolo;// string

    public $data;       // timestamp
    public $ip;         // text

    public $errore;       // string
        
    // Tengo anche la classe
    public $utente;     // utente

    public function getData2DB() {
        return $this->data->format('Y-m-d H:i:s');
    }

    public function setNow() {
        $dtz = new DateTimeZone("Europe/Rome"); //Your timezone
        $now = new DateTime(date("Y-m-d H:i:s"), $dtz);

        $this->data = $now;
    }

    public function Insert() {
        // Aggiungi alla base dati
        $result = false;

        try {
            $database = new db();
            $database->query('INSERT INTO accesso (cookiename, utentefk, utenteruolo, data, ip, errore) VALUES(:cookiename, :utentefk, :utenteruolo, :data, :ip, :errore)');
            $database->bind(':cookiename', $this->cookiename);
            $database->bind(':utentefk', $this->utentefk);
            $database->bind(':utenteruolo', Utilita::HTML2DB($this->utenteruolo));
            $database->bind(':data', $this->getData2DB());  
            $database->bind(':ip', Utilita::HTML2DB($this->ip));
            $database->bind(':errore', Utilita::HTML2DB($this->descrizione));

            $result = $database->execute();
        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }

        // chiude il database
        $database = NULL;

        return $result;
    }

    public function Update($data) {
        // Modifica in base al cookiename

    }

    /* -------- FUNZIONI STATICHE ----------*/
    public static function EXIST($cookiename) {
        
    }

    public static function CHECK($cookiename) {
        
    }
}

/* --------------------------------------
 *           CLASS ACCESSI
 * --------------------------------------
 */

class Accessi
{
    public $accessi;

    public function __construct()
    {
        $this->accessi = [];
    }

    public function Add($obj)
    {
        $this->accessi[] = $obj;
    }

    public function getAccessi()
    {
        return $this->accessi;
    }

    public function loadAll()
    {
        try {
            $database = new db();
            $database->query('SELECT * FROM accesso');
            $rows = $database->resultset();

            foreach ($rows as $row) {
                $t = new Accesso();
                /*
                $t->fatturaid = $row['fatturaid'];
                $t->setDataDB($row['data']);
                $t->progettofk = $row['progettofk'];
                $t->progetto = Progetto::DB_FIND_BY_ID($row['progettofk']);
                $t->oggetto = Utilita::DB2HTML($row['oggetto']);
                */
                $this->Add($t);
            }

        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }
    }
}