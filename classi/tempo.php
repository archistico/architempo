<?php
class Tempo {
    public $tempoid;

    public $progettofk;
    public $progetto;

    public $descrizione;

    public $utentefk;
    public $utente;

    private $datainizio;
    private $datafine;

    public function getProgetto() {
        return $this->progetto;
    }

    public function setDatainizio($data) {
        $this->datainizio = DateTime::createFromFormat('d/m/Y H:i:s', $data);
    }

    public function setDatafine($data) {
        $this->datafine = DateTime::createFromFormat('d/m/Y H:i:s', $data);
    }

    public function getDatainizio() {
        return $this->datainizio->format('d/m/Y H:i:s');
    }

    public function getDatafine() {
        return $this->datafine->format('d/m/Y H:i:s');
    }

    public function getDatainizio2DB() {
        return $this->datainizio->format('Y-m-d H:i:s');
    }

    public function getDatafine2DB() {
        return $this->datafine->format('Y-m-d H:i:s');
    }

    public function setDatainizioDB($data) {
        $this->datainizio = DateTime::createFromFormat('Y-m-d H:i:s', $data);
    }

    public function setDatafineDB($data) {
        $this->datafine = DateTime::createFromFormat('Y-m-d H:i:s', $data);
    }

    public function DB_Add() {
        $result = false;

        try {
            $database = new db();
            $database->query('INSERT INTO tempo (progettofk, descrizione, utentefk, datainizio, datafine) VALUES(:progettofk, :descrizione, :utentefk, :datainizio, :datafine)');
            $database->bind(':progettofk', $this->progettofk);
            $database->bind(':descrizione', Utilita::HTML2DB($this->descrizione));
            $database->bind(':utentefk', $this->utentefk);
            $database->bind(':datainizio', $this->getDatainizio2DB());
            $database->bind(':datafine', $this->getDatafine2DB());
            $result = $database->execute();
        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }

        // chiude il database
        $database = NULL;

        return $result;
    }

    public function DB_Find_by_ID() {
        throw new Exception('Non implementato');
    }

    public static function NUOVO($tempoid, $progetto, $descrizione, $utente, $datainizio, $datafine) {
        $instance = new self();
        $instance->tempoid = $tempoid;
        $instance->progetto = $progetto;
        $instance->descrizione = $descrizione;
        $instance->utente = $utente;
        $instance->datainizio = DateTime::createFromFormat('d/m/Y H:i:s', $datainizio);
        $instance->datafine = DateTime::createFromFormat('d/m/Y H:i:s', $datafine);
        return $instance;
    }

    public function getDurata() {
        $secondi = $this->datainizio->diff($this->datafine)->format("%S");
        $minuti = $this->datainizio->diff($this->datafine)->format("%I");
        $ore = $this->datainizio->diff($this->datafine)->format("%H");
        $giorni = $this->datainizio->diff($this->datafine)->format("%D");
        $ore = $ore + $giorni * 24;
        return $ore.":".$minuti.":".$secondi;
    }

    public function getDataByID($id) {
        try {
            $database = new db();
            $database->query('SELECT * FROM tempo WHERE tempoid = :id');
            $database->bind(':id', $id);
            $row = $database->single();

            $this->tempoid = $row['tempoid'];
            $this->progettofk = $row['progettofk'];
            $this->progetto = Progetto::FIND_BY_ID($row['progettofk']);
            $this->descrizione = $row['descrizione'];
            $this->utentefk = $row['utentefk'];
            $this->utente = Utente::FIND_BY_ID($row['utentefk']);
            $this->setDatainizioDB($row['datainizio']);
            $this->setDatafineDB($row['datafine']);

        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }
    }

    public function getInfo() {
        return $this->descrizione . " : ".$this->getDurata();
    }

    public static function EXIST($id) {
        $exist = false;

        try {
            $database = new db();
            $database->query('SELECT * FROM tempo WHERE tempoid = :id');
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

    public static function DELETE_BY_ID($id) {
        $result = false;

        try {
            $database = new db();
            $database->query('DELETE FROM tempo WHERE tempoid = :id');
            $database->bind(':id', $id);
            $result = $database->execute();
        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }

        // chiude il database
        $database = NULL;

        return $result;
    }
}


/* --------------------------------------
 *           CLASS TEMPI
 * --------------------------------------
 */

class Tempi
{
    public $tempi;

    public function __construct()
    {
        $this->tempi = [];
    }

    public function Add($obj)
    {
        $this->tempi[] = $obj;
    }

    public function getTempi()
    {
        return $this->tempi;
    }

    public function getDB_All()
    {
        try {
            $database = new db();
            $database->query('SELECT * FROM tempo');
            $rows = $database->resultset();

            foreach ($rows as $row) {
                $t = new Tempo();
                $t->tempoid = $row['tempoid'];
                $t->progettofk = $row['progettofk'];
                $t->progetto = Progetto::FIND_BY_ID($row['progettofk']);
                $t->descrizione = $row['descrizione'];
                $t->utentefk = $row['utentefk'];
                $t->utente = Utente::FIND_BY_ID($row['utentefk']);
                $t->setDatainizioDB($row['datainizio']);
                $t->setDatafineDB($row['datafine']);

                $this->Add($t);
            }

        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }
    }

    public function find_by_id($id) {
        $item = null;
        foreach($this->tempi as $el) {
            if ($id == $el->tempoid) {
                $item = $el;
                break;
            }
        }
        return $item;
    }
}