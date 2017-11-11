<?php
class Tempo {
    public $tempoid;
    public $progettofk;
    public $descrizione;
    public $utentefk;
    private $datainizio;
    private $datafine;

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

    public function DB_Add() {
        // 2017-11-11 22:12:42
        $database = new db();
        $database->query('INSERT INTO tempo (progettofk, descrizione, utentefk, datainizio, datafine) VALUES(:progettofk, :descrizione, :utentefk, :datainizio, :datafine)');
        $database->bind(':progettofk', $this->progettofk);
        $database->bind(':descrizione', Utilita::HTML2DB($this->descrizione));
        $database->bind(':utentefk', $this->utentefk);
        $database->bind(':datainizio', $this->getDatainizio2DB());
        $database->bind(':datafine', $this->getDatafine2DB());
        $database->execute();

    }

    public function DB_Find_by_ID() {
        throw new Exception('Non implementato');
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
        // DATI FAKE

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