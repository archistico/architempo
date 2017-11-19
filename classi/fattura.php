<?php
class Fattura
{
    public $fatturaid;
    public $numero;
    public $data;
    public $anno;
    public $progettofk;
    public $oggetto;
    public $importo;
    public $totale;
    public $tipologiafatturafk;

    public $progetto;

    public function getInfo() {
        return "";
    }

    public function getProgetto() {
        return $this->progetto;
    }

    public function getTipologiaFattura() {
        return $this->tipologiafattura;
    }

    // SETTA DATA
    public function setData($data) {
        $this->data = DateTime::createFromFormat('d/m/Y', $data);
    }

    // RESTITUISCI DATA STRINGA
    public function getDataStr() {
        return $this->data->format('d/m/Y');
    }

    // RESTITUISCI DATA STRINGA
    public function getAnno() {
        return $this->data->format('Y');
    }

    // RESTITUISCI DATA OGGETTO
    public function getDataObj() {
        return $this->data;
    }

    // DB
    public function getDataDB() {
        return $this->data->format('Y-m-d H:i:s');
    }

    public function setDataDB($data) {
        $this->data = DateTime::createFromFormat('Y-m-d H:i:s', $data);
    }

    public function DB_Add() {
        $result = false;

        try {
            $database = new db();
            $database->query('INSERT INTO fattura (numero, data, anno, progettofk, oggetto, importo, totale, tipologiafatturafk) VALUES(:numero, :data, :anno, :progettofk, :oggetto, :importo, :totale, :tipologiafatturafk)');

            $database->bind(':numero', $this->numero);
            $database->bind(':data', $this->getDataDB());
            $database->bind(':anno', $this->anno);
            $database->bind(':progettofk', $this->progettofk);
            $database->bind(':oggetto', Utilita::HTML2DB($this->oggetto));
            $database->bind(':importo', $this->importo);
            $database->bind(':totale', $this->totale);
            $database->bind(':tipologiafatturafk', 1);

            $result = $database->execute();
        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }

        // chiude il database
        $database = NULL;

        return $result;
    }

    public function FIND_BY_ID($id) {
        $result = false;

        try {
            $database = new db();
            $database->query('SELECT * FROM fattura WHERE fatturaid=:id');
            $database->bind(':id', $id);
            $row = $database->single();

            $this->fatturaid = $row['fatturaid'];
            $this->numero = $row['numero'];
            $this->setDataDB($row['data']);
            $this->anno = $row['anno'];
            $this->progettofk = $row['progettofk'];
            $this->progetto = Progetto::DB_FIND_BY_ID($row['progettofk']);
            $this->oggetto = Utilita::DB2HTML($row['oggetto']);
            $this->importo = $row['importo'];
            $this->totale = $row['totale'];
            $this->tipologiafatturafk = $row['tipologiafatturafk'];

            $result = true;
        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }

        // chiude il database
        $database = NULL;

        return $result;
    }

}

/* --------------------------------------
 *           CLASS FATTURE
 * --------------------------------------
 */

class Fatture
{
    public $fatture;

    public function __construct()
    {
        $this->fatture = [];
    }

    public function Add($obj)
    {
        $this->fatture[] = $obj;
    }

    public function getFatture()
    {
        return $this->fatture;
    }

    public function getDB_All()
    {
        try {
            $database = new db();
            $database->query('SELECT * FROM fattura ORDER BY anno DESC, numero DESC');
            $rows = $database->resultset();

            foreach ($rows as $row) {
                $t = new Fattura();
                $t->fatturaid = $row['fatturaid'];
                $t->numero = $row['numero'];
                $t->anno = $row['anno'];
                $t->setDataDB($row['data']);
                $t->progettofk = $row['progettofk'];
                $t->progetto = Progetto::DB_FIND_BY_ID($row['progettofk']);
                $t->oggetto = Utilita::DB2HTML($row['oggetto']);
                $t->importo = $row['importo'];
                $t->totale = $row['totale'];
                $t->tipologiafatturafk = $row['tipologiafatturafk'];

                $this->Add($t);
            }

        } catch (PDOException $e) {
            throw new PDOException("Error  : " . $e->getMessage());
        }
    }

    public function find_by_id($id) {
        $item = null;
        foreach($this->tempi as $el) {
            if ($id == $el->tempoid) {
                $item = $el;
                break;
            }
        }
        return $item;
    }
}
