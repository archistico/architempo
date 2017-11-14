<?php
header('Content-Type: application/json');

// Caricamento configurazione e utilita
require_once('config.php');
require_once('classi/utilita.php');
Utilita::PARAMETRI_INIZIALI();

require_once('classi/ruolo.php');
require_once('classi/utente.php');
require_once('classi/database.php');
require_once('classi/tipologia.php');
require_once('classi/progetto.php');
require_once('classi/tempo.php');

$data = array();

function somma () {

    $totale = 0;
    foreach ($this->tempi as $t) {
        $secondi = $t->getDatainizioObj()->diff($t->getDatafineObj())->format("%S");
        $minuti = $t->getDatainizioObj()->diff($t->getDatafineObj())->format("%I");
        $ore = $t->getDatainizioObj()->diff($t->getDatafineObj())->format("%H");
        $giorni = $t->getDatainizioObj()->diff($t->getDatafineObj())->format("%D");

        $totale += $ore + $giorni * 24 + $minuti /60 + $secondi/3600;
    }
    return number_format($totale, 1, ',', ' ');

}


try {
    $database = new db();
    $database->query("SELECT tempo.datainizio, tempo.datafine, tipologia.descrizione 
                            FROM tempo 
                            INNER JOIN progetto ON tempo.progettofk = progetto.progettoid 
                            INNER JOIN tipologia ON progetto.tipologiafk = tipologia.tipologiaid
                            ");

    $rows = $database->resultset();

    foreach ($rows as $row) {
        $tipologia = $row['descrizione'];

        $t = new Tempo();

        $t->setDatainizioDB($row['datainizio']);
        $t->setDatafineDB($row['datafine']);
        $data[] = $row;
    }
} catch (PDOException $e) {
    throw new PDOException("Error  : " . $e->getMessage());
}

print json_encode($data);