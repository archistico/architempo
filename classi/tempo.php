<?php
class Tempo {
    public $tempoid;
    public $progettofk;
    public $descrizione;
    public $utentefk;
    public $datainizio;
    public $datafine;

    public function DB_Add() {

        $database = new db();
        $database->query('INSERT INTO tempo (progettofk, descrizione, utentefk, datainizio, datafine) VALUES(:progettofk, :descrizione, :utentefk, :datainizio, :datafine)');
        $database->bind(':progettofk', $this->progettofk);
        $database->bind(':descrizione', Utilita::HTML2DB($this->descrizione));
        $database->bind(':utentefk', $this->utentefk);
        $database->bind(':datainizio', $this->datainizio);
        $database->bind(':datafine', $this->datafine);
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
}