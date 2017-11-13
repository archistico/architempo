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

    public function getDescrizione() {
        return $this->descrizione;
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
        $this->Add(new Ruolo(1, 'Amministratore'));
        $this->Add(new Ruolo(2, 'Lavoratore'));
        $this->Add(new Ruolo(3, 'Cliente'));
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