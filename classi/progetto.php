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

    public function getCliente() {
        return $this->cliente;
    }

    public function getTipologia() {
        return $this->tipologia;
    }

    public function getTempo() {
        return "00:00:00";
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