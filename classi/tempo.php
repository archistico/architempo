<?php
class Tempo {
    public $id;
    public $progettofk;
    public $descrizione;
    public $utentefk;
    public $data;
    public $durata;

    public function AddDB() {
        if(!empty($this->data)) {
            $database = new db();
            $database->query('INSERT INTO tempo (progettofk, descrizione, utentefk, data, durata) VALUES(:progettofk, :descrizione, :utentefk, :data, :durata)');
            $database->bind(':progettofk', $this->progettofk);
            $database->bind(':descrizione', Utilita::HTML2DB($this->descrizione));
            $database->bind(':utentefk', $this->utentefk);
            $database->bind(':data', $this->data);
            $database->bind(':durata', $this->durata);
            $database->execute();
        } else {
            $database = new db();
            $database->query('INSERT INTO tempo (progettofk, descrizione, utentefk, durata) VALUES(:progettofk, :descrizione, :utentefk, :durata)');
            $database->bind(':progettofk', $this->progettofk);
            $database->bind(':descrizione', Utilita::HTML2DB($this->descrizione));
            $database->bind(':utentefk', $this->utentefk);
            $database->bind(':durata', $this->durata);
            $database->execute();
        }
    }

}