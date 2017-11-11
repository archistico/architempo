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
    public $mail;
    public $password;
    public $ruolofk;
    public $note;

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

    public static function Nuovo($id, $denominazione, $ruolofk) {
        $instance = new self();
        $instance->utenteid = $id;
        $instance->denominazione = $denominazione;
        $instance->ruolofk = $ruolofk;
        return $instance;
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
        // DATI FAKE
        Add(Utente::Nuovo(1, 'Emilie Rollandin', 1));
        Add(Utente::Nuovo(2, 'Elettra Groppo', 1));
        Add(Utente::Nuovo(3, 'Lavoratore 1', 2));
        Add(Utente::Nuovo(4, 'Cliente 1', 3));
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