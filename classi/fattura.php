<?php
class Fattura
{
    public $fatturaid;
    public $numero;
    public $data;
    public $progettofk;
    public $oggetto;
    public $importo;
    public $totale;
    public $tipologiafatturafk;

    public $progetto;
    public $tipologiafattura;

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
        $this->data = DateTime::createFromFormat('d/m/Y H:i:s', $data);
    }

    // RESTITUISCI DATA STRINGA
    public function getDataStr() {
        return $this->data->format('d/m/Y H:i:s');
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

}

