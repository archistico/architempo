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

    public static function ADD($utentefk, $accesso) {
        // Aggiungi alla base dati
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