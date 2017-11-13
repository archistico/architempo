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
        throw new Exception('Non implementato');
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
            $instance->pagato = $row['pagato'];
            $instance->completato = $row['completato'];
          
        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }

        if($instance!=null) {
            return $instance;
        }
    }

    public function DB_Delete_by_ID() {
        throw new Exception('Non implementato');
    }

    public function DB_Update_by_ID() {
        throw new Exception('Non implementato');
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

        if($totale == 0) {
            return "00:00:00";
        } else {
            return $durata;
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
                $t->pagato = $row['pagato'];
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
}