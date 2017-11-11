<?php
/* --------------------------------------
 *           CLASS PROGETTO
 * --------------------------------------
 */

class Progetto {
    public $progettoid;
    public $descrizione;
    public $clientefk;
    public $tipologiafk;
    public $compenso;
    public $acconto;
    public $pagato;
    public $completato;

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
        // DATI FAKE

    }
}