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

    }

    public function Add($obj)
    {
        $this->tipologie[] = $obj;
    }

    public function getTipologie()
    {
        return $this->tipologie;
    }

    public function getDB_All()
    {
        try {
            $database = new db();
            $database->query('SELECT * FROM tipologia');
            $rows = $database->resultset();

            foreach ($rows as $row) {
                $t = new Tipologia($row['tipologiaid'], Utilita::DB2HTML($row['descrizione']));
                $this->Add($t);
            }

        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }
    }

    public function find_by_id($id) {
        $this->getDB_All();
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