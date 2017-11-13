<?php
/* --------------------------------------
 *           CLASS UTENTE
 * --------------------------------------
 */

class Utente {
    public $utenteid;
    public $denominazione;
    public $indirizzo;
    public $cf;
    public $piva;
    public $telefono;
    public $email;
    public $password;
    public $ruolofk;
    public $ruolo;
    public $note;

    public function DB_Add() {
        throw new Exception('Non implementato');
    }

    public function DB_Find_by_ID() {
        throw new Exception('Non implementato');
    }

    public function DB_Delete_by_ID() {
        throw new Exception('Non implementato');
    }

    public function DB_Update_by_ID() {
        throw new Exception('Non implementato');
    }

    public function getRuolo() {
        return $this->ruolo;
    }

    public static function NUOVO($id, $denominazione, $ruolofk) {
        $instance = new self();
        $instance->utenteid = $id;
        $instance->denominazione = $denominazione;
        $instance->ruolofk = $ruolofk;
        return $instance;
    }

    public static function UTENTE_LOGGATO_ID() {
        // DATI FAKE
        return 1;
    }

    public static function FIND_BY_ID($id) {
        $u = new Utente();

        try {
            $database = new db();
            $database->query('SELECT * FROM utente WHERE utenteid = :id');
            $database->bind(':id', $id);
            $row = $database->single();

            $u->utenteid = $row['utenteid'];
            $u->denominazione = Utilita::DB2HTML($row['denominazione']);
            $u->indirizzo = Utilita::DB2HTML($row['indirizzo']);
            $u->cf = Utilita::DB2HTML($row['cf']);
            $u->piva = Utilita::DB2HTML($row['piva']);
            $u->telefono = Utilita::DB2HTML($row['telefono']);
            $u->email = Utilita::DB2HTML($row['email']);
            $u->password = Utilita::DB2HTML($row['password']);
            $u->ruolofk = $row['ruolofk'];
            $u->ruolo = Ruolo::FIND_BY_ID($row['ruolofk']);
            $u->note = Utilita::DB2HTML($row['note']);

        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }
        return $u;
    }
}

/* --------------------------------------
 *           CLASS UTENTI
 * --------------------------------------
 */

class Utenti
{
    public $utenti;

    public function __construct()
    {
        $this->utenti = [];
    }

    public function Add($obj)
    {
        $this->utenti[] = $obj;
    }

    public function getUtenti()
    {
        return $this->utenti;
    }

    public function getDB_All()
    {
        try {
            $database = new db();
            $database->query('SELECT * FROM utente');
            $rows = $database->resultset();

            foreach ($rows as $row) {
                $u = new Utente();
                $u->utenteid = $row['utenteid'];
                $u->denominazione = Utilita::DB2HTML($row['denominazione']);
                $u->indirizzo = Utilita::DB2HTML($row['indirizzo']);
                $u->cf = Utilita::DB2HTML($row['cf']);
                $u->piva = Utilita::DB2HTML($row['piva']);
                $u->telefono = Utilita::DB2HTML($row['telefono']);
                $u->email = Utilita::DB2HTML($row['email']);
                $u->password = Utilita::DB2HTML($row['password']);
                $u->ruolofk = $row['ruolofk'];
                $u->ruolo = Ruolo::FIND_BY_ID($row['ruolofk']);
                $u->note = Utilita::DB2HTML($row['note']);

                $this->Add($u);
            }

        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }
    }

    public function find_by_id($id) {
        $item = null;
        foreach($this->utenti as $el) {
            if ($id == $el->utenteid) {
                $item = $el;
                break;
            }
        }
        return $item;
    }
}