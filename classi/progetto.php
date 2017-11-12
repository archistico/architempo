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

    public static function NUOVO($id, $descrizione) {
        $instance = new self();
        $instance->progettoid = $id;
        $instance->descrizione = $descrizione;
        return $instance;
    }

    public static function FIND_BY_ID($id) {
        // FAKE
        $p = new Progetto();
        $p->descrizione = 'Progetto di test';
        return $p;
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
        $this->Add(Progetto::NUOVO(1, 'Test 1'));
        $this->Add(Progetto::NUOVO(2, 'Test 2'));
        $this->Add(Progetto::NUOVO(3, 'Test 3'));
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