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

    public static function NUOVO($id, $denominazione, $ruolofk) {
        $instance = new self();
        $instance->utenteid = $id;
        $instance->denominazione = $denominazione;
        $instance->ruolofk = $ruolofk;
        return $instance;
    }

    public static function UTENTE_LOGGATO_ID() {
        // DATI FAKE
        return 1;
    }

    public static function FIND_BY_ID($id) {
        // FAKE
        $u = new Utente();
        $u->denominazione = 'Utente di test';
        $u->utenteid = 1;
        return $u;
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
        $this->Add(Utente::NUOVO(1, 'Emilie Rollandin', 1));
        $this->Add(Utente::NUOVO(2, 'Elettra Groppo', 1));
        $this->Add(Utente::NUOVO(3, 'Lavoratore 1', 2));
        $this->Add(Utente::NUOVO(4, 'Cliente 1', 3));
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