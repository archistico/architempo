<?php

/* --------------------------------------
 *           CLASS TIPOLOGIA
 * --------------------------------------
 */

class Tipologia {
    public $tipologiaid;
    public $descrizione;

    public function __construct($id, $des)
    {
        $this->tipologiaid = $id;
        $this->descrizione = $des;
    }
}

/* --------------------------------------
 *           CLASS TIPOLOGIE
 * --------------------------------------
 */

class Tipologie
{
    public $tipologie;

    public function __construct()
    {
        $this->tipologie = [];
        Add(new Tipologia(1, 'Grafica'));
        Add(new Tipologia(2, 'Programmazione'));
        Add(new Tipologia(3, 'Architettura'));
        Add(new Tipologia(4, 'Lavoro dipendente'));
        Add(new Tipologia(5, 'Editoria'));

    }

    public function Add($obj)
    {
        $this->tipologie[] = $obj;
    }

    public function getTipologie()
    {
        return $this->tipologie;
    }

    public function find_by_id($id) {
        $item = null;
        foreach($this->tipologie as $el) {
            if ($id == $el->tipologiaid) {
                $item = $el;
                break;
            }
        }
        return $item;
    }
}