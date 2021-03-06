<?php
/* --------------------------------------
 *           CLASS PROGETTO
 * --------------------------------------
 */

class Progetto {
    public $progettoid;
    public $descrizione;
    public $clientefk;
    public $cliente;
    public $tipologiafk;
    public $tipologia;
    public $compenso;
    public $acconto;
    public $pagato;
    public $completato;

    public function DB_Add() {
        $result = false;

        try {
            $database = new db();
            $database->query('INSERT INTO progetto (descrizione, clientefk, tipologiafk, compenso, acconto, completato ) VALUES(:descrizione, :clientefk, :tipologiafk, :compenso, :acconto, :completato)');
            $database->bind(':descrizione', Utilita::HTML2DB($this->descrizione));
            $database->bind(':clientefk', $this->clientefk);
            $database->bind(':tipologiafk', $this->tipologiafk);
            $database->bind(':compenso', $this->compenso);
            $database->bind(':acconto', $this->acconto);
            $database->bind(':completato', $this->completato);
            $result = $database->execute();
        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }

        // chiude il database
        $database = NULL;

        return $result;
    }

    public function DB_Update($id) {
        $result = false;

        try {
            $database = new db();
            $database->query('UPDATE progetto SET descrizione=:descrizione, clientefk=:clientefk, tipologiafk=:tipologiafk, compenso=:compenso, acconto=:acconto, completato=:completato WHERE progettoid = :id');
            $database->bind(':descrizione', Utilita::HTML2DB($this->descrizione));
            $database->bind(':clientefk', $this->clientefk);
            $database->bind(':tipologiafk', $this->tipologiafk);
            $database->bind(':compenso', $this->compenso);
            $database->bind(':acconto', $this->acconto);
            $database->bind(':completato', $this->completato);
            $database->bind(':id', $id);
            $result = $database->execute();
        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }

        // chiude il database
        $database = NULL;

        return $result;
    }
    
    public static function DB_Find_by_ID($id) {
        try {
            $database = new db();
            $database->query('SELECT * FROM progetto WHERE progettoid = :id');
            $database->bind(':id', $id);
            $row = $database->single();

            $instance = new Progetto();

            $instance->progettoid = $row['progettoid'];
            $instance->clientefk = $row['clientefk'];
            $instance->cliente = Utente::FIND_BY_ID($row['clientefk']);
            $instance->descrizione = Utilita::DB2HTML($row['descrizione']);
            $instance->tipologiafk = $row['tipologiafk'];
            $tipologie = new Tipologie();
            $instance->tipologia = $tipologie->find_by_id($row['tipologiafk']);
            $instance->compenso = $row['compenso'];
            $instance->acconto = $row['acconto'];
            $instance->completato = $row['completato'];
          
        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }

        if($instance!=null) {
            return $instance;
        }
    }

    public static function NUOVO($id, $descrizione) {
        $instance = new self();
        $instance->progettoid = $id;
        $instance->descrizione = $descrizione;
        return $instance;
    }

    public function getCliente() {
        return $this->cliente;
    }

    public function getTipologia() {
        return $this->tipologia;
    }

    public function getDataByID($id) {
        try {
            $database = new db();
            $database->query('SELECT * FROM progetto WHERE progettoid = :id');
            $database->bind(':id', $id);
            $row = $database->single();

            $this->progettoid = $row['progettoid'];
            $this->clientefk = $row['clientefk'];
            $this->cliente = Utente::FIND_BY_ID($row['clientefk']);
            $this->descrizione = Utilita::DB2HTML($row['descrizione']);
            $this->tipologiafk = $row['tipologiafk'];
            $tipologie = new Tipologie();
            $this->tipologia = $tipologie->find_by_id($row['tipologiafk']);
            $this->compenso = $row['compenso'];
            $this->acconto = $row['acconto'];
            $this->completato = $row['completato'];

        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }

        return empty($this->descrizione)?false:true;
    }

    public function getInfo() {
        return $this->descrizione ." - ". $this->getCliente()->denominazione;
    }

    public function getTempo() {
        // CERCARE TUTTI I TEMPI CON UN PROGETTO ID E SOMMARE LE DURATE
        $totale = 0;
        try {
            $database = new db();
            $database->query('SELECT datainizio, datafine FROM tempo WHERE progettofk = :id');
            $database->bind(':id', $this->progettoid);
            $rows = $database->resultset();

            foreach ($rows as $row) {
                $t = new Tempo();
                $t->setDatainizioDB($row['datainizio']);
                $t->setDatafineDB($row['datafine']);

                $totale += $t->getDurata_Secondi();
            }

        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }

        $hours = floor($totale / 3600);
        $totale -= $hours * 3600;
        $minutes = floor($totale / 60);
        $totale -= $minutes * 60;
        $seconds = $totale;

        $durata = str_pad($hours, 2, "0",STR_PAD_LEFT). ":".str_pad($minutes, 2, "0",STR_PAD_LEFT).":".str_pad($seconds, 2, "0",STR_PAD_LEFT);

        if(empty($durata)) {
            return "00:00:00";
        } else {
            return $durata;
        }
    }

    public static function EXIST($id) {
        $exist = false;

        try {
            $database = new db();
            $database->query('SELECT * FROM progetto WHERE progettoid = :id');
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

    public static function DELETE_BY_ID_AND_TEMPO($id) {
        $resultTempo = false;
        $resultProgetto = false;

        try {
            $database = new db();
            $database->beginTransaction();

            $database->query('DELETE FROM tempo WHERE progettofk = :id');
            $database->bind(':id', $id);
            $resultTempo = $database->execute();

            $database->query('DELETE FROM progetto WHERE progettoid = :id');
            $database->bind(':id', $id);
            $resultProgetto = $database->execute();

            $database->endTransaction();
        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }

        // chiude il database
        $database = NULL;

        if($resultTempo && $resultProgetto) {
            return true;
        } else {
            return false;
        }
    }
}

/* --------------------------------------
 *           CLASS PROGETTI
 * --------------------------------------
 */

class Progetti
{
    public $progetti;

    public function __construct()
    {
        $this->progetti = [];
    }

    public function Add($obj)
    {
        $this->progetti[] = $obj;
    }

    public function getProgetti()
    {
        return $this->progetti;
    }

    public function getDB_All()
    {
        try {
            $database = new db();
            $database->query('SELECT * FROM progetto');
            $rows = $database->resultset();

            foreach ($rows as $row) {
                $t = new Progetto();
                $t->progettoid = $row['progettoid'];
                $t->clientefk = $row['clientefk'];
                $t->cliente = Utente::FIND_BY_ID($row['clientefk']);
                $t->descrizione = Utilita::DB2HTML($row['descrizione']);
                $t->tipologiafk = $row['tipologiafk'];

                $tipologie = new Tipologie();
                $t->tipologia = $tipologie->find_by_id($row['tipologiafk']);

                $t->compenso = $row['compenso'];
                $t->acconto = $row['acconto'];
                $t->completato = $row['completato'];

                $this->Add($t);
            }
        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }
    }

    // getDB_All_by_Cliente
    public function getDB_All_by_Cliente($clientefk)
    {
        try {
            $database = new db();
            $database->query('SELECT * FROM progetto WHERE clientefk = :clientefk');
            $database->bind(':clientefk', $clientefk);
            $rows = $database->resultset();

            foreach ($rows as $row) {
                $t = new Progetto();
                $t->progettoid = $row['progettoid'];
                $t->clientefk = $row['clientefk'];
                $t->cliente = Utente::FIND_BY_ID($row['clientefk']);
                $t->descrizione = Utilita::DB2HTML($row['descrizione']);
                $t->tipologiafk = $row['tipologiafk'];

                $tipologie = new Tipologie();
                $t->tipologia = $tipologie->find_by_id($row['tipologiafk']);

                $t->compenso = $row['compenso'];
                $t->acconto = $row['acconto'];
                $t->completato = $row['completato'];

                $this->Add($t);
            }

        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }
    }


    public function find_by_id($id) {
        $item = null;
        foreach($this->progetti as $el) {
            if ($id == $el->progettoid) {
                $item = $el;
                break;
            }
        }
        return $item;
    }

    public function TOTALE_ACCONTI() {
        $totale = 0;
        foreach ($this->progetti as $t) {
            $valore = $t->acconto;
            $totale += $valore;
        }
        return $totale;
    }

    public function TOTALE_COMPENSI() {
        $totale = 0;
        foreach ($this->progetti as $t) {
            $valore = $t->compenso;
            $totale += $valore;
        }
        return $totale;
    }
}