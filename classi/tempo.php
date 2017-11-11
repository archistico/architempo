<?php
class Tempo {
    public $tempoid;
    public $progettofk;
    public $descrizione;
    public $utentefk;
    public $data;
    public $durata;

    public function DB_Add() {
        if(!empty($this->data)) {
            $database = new db();
            $database->query('INSERT INTO tempo (progettofk, descrizione, utentefk, data, durata) VALUES(:progettofk, :descrizione, :utentefk, :data, :durata)');
            $database->bind(':progettofk', $this->progettofk);
            $database->bind(':descrizione', Utilita::HTML2DB($this->descrizione));
            $database->bind(':utentefk', $this->utentefk);
            $database->bind(':data', $this->data);
            $database->bind(':durata', $this->durata);
            $database->execute();
        } else {
            $database = new db();
            $database->query('INSERT INTO tempo (progettofk, descrizione, utentefk, durata) VALUES(:progettofk, :descrizione, :utentefk, :durata)');
            $database->bind(':progettofk', $this->progettofk);
            $database->bind(':descrizione', Utilita::HTML2DB($this->descrizione));
            $database->bind(':utentefk', $this->utentefk);
            $database->bind(':durata', $this->durata);
            $database->execute();
        }
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