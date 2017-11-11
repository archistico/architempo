<?php

/* --------------------------------------
 *           CLASS RUOLO
 * --------------------------------------
 */

class Ruolo {
    public $ruoloid;
    public $descrizione;

    public function __construct($id, $des)
    {
        $this->ruoloid = $id;
        $this->descrizione = $des;
    }
}

/* --------------------------------------
 *           CLASS RUOLI
 * --------------------------------------
 */

class Ruoli
{
    public $ruoli;

    public function __construct()
    {
        $this->ruoli = [];
        Add(new Ruolo(1, 'Amministratore'));
        Add(new Ruolo(2, 'Lavoratore'));
        Add(new Ruolo(3, 'Cliente'));
    }

    public function Add($obj)
    {
        $this->ruoli[] = $obj;
    }

    public function getTipologie()
    {
        return $this->ruoli;
    }

    public function find_by_id($id) {
        $item = null;
        foreach($this->ruoli as $el) {
            if ($id == $el->ruoloid) {
                $item = $el;
                break;
            }
        }
        return $item;
    }
}