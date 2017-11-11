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

    }
}