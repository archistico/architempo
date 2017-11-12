<?php
class Tempo {
    public $tempoid;

    public $progettofk;
    public $progetto;

    public $descrizione;

    public $utentefk;
    public $utente;

    private $datainizio;
    private $datafine;

    public function getProgetto() {
        return $this->progetto;
    }

    public function setDatainizio($data) {
        $this->datainizio = DateTime::createFromFormat('d/m/Y H:i:s', $data);
    }

    public function setDatafine($data) {
        $this->datafine = DateTime::createFromFormat('d/m/Y H:i:s', $data);
    }

    public function getDatainizio() {
        return $this->datainizio->format('d/m/Y H:i:s');

    }

    public function getDatafine() {
        return $this->datafine->format('d/m/Y H:i:s');
    }

    public function getDatainizio2DB() {
        return $this->datainizio->format('Y-m-d H:i:s');
    }

    public function getDatafine2DB() {
        return $this->datafine->format('Y-m-d H:i:s');
    }

    public function DB_Add() {
        // 2017-11-11 22:12:42
        $database = new db();
        $database->query('INSERT INTO tempo (progettofk, descrizione, utentefk, datainizio, datafine) VALUES(:progettofk, :descrizione, :utentefk, :datainizio, :datafine)');
        $database->bind(':progettofk', $this->progettofk);
        $database->bind(':descrizione', Utilita::HTML2DB($this->descrizione));
        $database->bind(':utentefk', $this->utentefk);
        $database->bind(':datainizio', $this->getDatainizio2DB());
        $database->bind(':datafine', $this->getDatafine2DB());
        $database->execute();
    }

    public function DB_Find_by_ID() {
        throw new Exception('Non implementato');
    }

    public static function NUOVO($tempoid, $progetto, $descrizione, $utente, $datainizio, $datafine) {
        $instance = new self();
        $instance->tempoid = $tempoid;
        $instance->progetto = $progetto;
        $instance->descrizione = $descrizione;
        $instance->utente = $utente;
        $instance->datainizio = DateTime::createFromFormat('d/m/Y H:i:s', $datainizio);
        $instance->datafine = DateTime::createFromFormat('d/m/Y H:i:s', $datafine);
        return $instance;
    }

    public function getDurata() {
        $secondi = $this->datainizio->diff($this->datafine)->format("%S");
        $minuti = $this->datainizio->diff($this->datafine)->format("%I");
        $ore = $this->datainizio->diff($this->datafine)->format("%H");
        $giorni = $this->datainizio->diff($this->datafine)->format("%D");
        $ore = $ore + $giorni * 24;
        return $ore.":".$minuti.":".$secondi;
    }
}


/* --------------------------------------
 *           CLASS TEMPI
 * --------------------------------------
 */

class Tempi
{
    public $tempi;

    public function __construct()
    {
        $this->tempi = [];
    }

    public function Add($obj)
    {
        $this->tempi[] = $obj;
    }

    public function getTempi()
    {
        return $this->tempi;
    }

    public function getDB_All()
    {
        // DATI FAKE

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