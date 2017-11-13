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

    public static function FIND_BY_ID($id) {
        try {
            $database = new db();
            $database->query('SELECT * FROM ruolo WHERE ruoloid = :id');
            $database->bind(':id', $id);
            $row = $database->single();

            $r = new Ruolo($row['ruoloid'], Utilita::DB2HTML($row['descrizione']));

        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }
        return $r;
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

    }

    public function Add($obj)
    {
        $this->ruoli[] = $obj;
    }

    public function getTipologie()
    {
        return $this->ruoli;
    }

    public function getDB_All()
    {
        try {
            $database = new db();
            $database->query('SELECT * FROM utente');
            $rows = $database->resultset();

            foreach ($rows as $row) {
                $r = new Ruolo($row['ruoloid'], Utilita::DB2HTML($row['descrizione']));
                $this->Add($r);
            }

        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }
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