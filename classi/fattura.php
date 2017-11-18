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

    public function getProgetto() {
        return $this->progetto;
    }

    public function getTipologiaFattura() {
        return $this->tipologiafattura;
    }


}

