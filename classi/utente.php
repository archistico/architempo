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
        $result = false;

        try {
            $database = new db();
            $database->query('INSERT INTO utente (denominazione, indirizzo, cf, piva, telefono, email, password, ruolofk, note) VALUES(:denominazione, :indirizzo, :cf, :piva, :telefono, :email, :password, :ruolofk, :note)');
            $database->bind(':denominazione', Utilita::HTML2DB($this->denominazione));
            $database->bind(':indirizzo', Utilita::HTML2DB($this->indirizzo));
            $database->bind(':cf', Utilita::HTML2DB($this->cf));
            $database->bind(':piva', Utilita::HTML2DB($this->piva));
            $database->bind(':telefono', Utilita::HTML2DB($this->telefono));
            $database->bind(':email', Utilita::HTML2DB($this->email));
            $database->bind(':password', Utilita::HTML2DB($this->password));
            $database->bind(':note', Utilita::HTML2DB($this->note));

            $database->bind(':ruolofk', $this->ruolofk);

            $result = $database->execute();
        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }

        // chiude il database
        $database = NULL;

        return $result;
    }

    public function getInfo() {
        return $this->denominazione;
    }

    public function DB_Update($id) {
        $result = false;

        try {
            $database = new db();
            $database->query('UPDATE utente SET denominazione=:denominazione, indirizzo=:indirizzo, cf=:cf, piva=:piva, telefono=:telefono, email=:email, password=:password, note=:note, ruolofk=:ruolofk WHERE utenteid = :id');

            $database->bind(':denominazione', Utilita::HTML2DB($this->denominazione));
            $database->bind(':indirizzo', Utilita::HTML2DB($this->indirizzo));
            $database->bind(':cf', Utilita::HTML2DB($this->cf));
            $database->bind(':piva', Utilita::HTML2DB($this->piva));
            $database->bind(':telefono', Utilita::HTML2DB($this->telefono));
            $database->bind(':email', Utilita::HTML2DB($this->email));
            $database->bind(':password', Utilita::HTML2DB($this->password));
            $database->bind(':note', Utilita::HTML2DB($this->note));
            $database->bind(':ruolofk', $this->ruolofk);
            $database->bind(':id', $id);
            $result = $database->execute();
        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }

        // chiude il database
        $database = NULL;

        return $result;
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

    public static function EXIST($id) {
        $exist = false;

        try {
            $database = new db();
            $database->query('SELECT * FROM utente WHERE utenteid = :id');
            $database->bind(':id', $id);
            $database->execute();
            if($database->rowCount()>0) {
                $exist = true;
            }
        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }

        // chiude il database
        $database = NULL;

        return $exist;
    }

    public static function PROGETTI_COLLEGATI($id) {
        $exist = false;

        try {
            $database = new db();
            $database->query('SELECT * FROM progetto WHERE clientefk = :id');
            $database->bind(':id', $id);
            $database->execute();
            if($database->rowCount()>0) {
                $exist = true;
            }
        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }

        // chiude il database
        $database = NULL;

        return $exist;
    }

    public function getDataByID($id) {
        try {
            $database = new db();
            $database->query('SELECT * FROM utente WHERE utenteid = :id');
            $database->bind(':id', $id);
            $row = $database->single();

            $this->utenteid = $row['utenteid'];
            $this->denominazione = Utilita::DB2HTML($row['denominazione']);
            $this->indirizzo = Utilita::DB2HTML($row['indirizzo']);
            $this->cf = Utilita::DB2HTML($row['cf']);
            $this->piva = Utilita::DB2HTML($row['piva']);
            $this->telefono = Utilita::DB2HTML($row['telefono']);
            $this->email = Utilita::DB2HTML($row['email']);
            $this->password = Utilita::DB2HTML($row['password']);
            $this->ruolofk = $row['ruolofk'];
            $this->ruolo = Ruolo::FIND_BY_ID($row['ruolofk']);
            $this->note = Utilita::DB2HTML($row['note']);

        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }

        return empty($this->descrizione)?false:true;
    }

    public static function DELETE_BY_ID($id) {
        $result = false;

        try {
            $database = new db();
            $database->query('DELETE FROM utente WHERE utenteid = :id');
            $database->bind(':id', $id);
            $result = $database->execute();
        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }

        // chiude il database
        $database = NULL;

        return $result;
    }

    public static function AUTENTICATO() {
        return true;
    }

    public static function AUTORIZZATO() {
        return true;
    }

    public static function LOGGATO() {
        // Ritorna il utentefk se è stato loggato
        return 1;
    }

    public static function TIPOLOGIA($id) {
        // Ritorna la tipologia dell'utente loggato
        return 'Cliente';
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