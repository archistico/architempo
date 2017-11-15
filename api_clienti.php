<?php
header('Content-Type: application/json');

// Caricamento configurazione e utilita
require_once('config.php');
require_once('classi/utilita.php');
Utilita::PARAMETRI_INIZIALI();
require_once('classi/database.php');

$data = array();
$oggetti = array();
$tempi = array();

function differenza_ore($inizio, $fine) {
    $totale = 0;

    $secondi = $inizio->diff($fine)->format("%S");
    $minuti = $inizio->diff($fine)->format("%I");
    $ore = $inizio->diff($fine)->format("%H");
    $giorni = $inizio->diff($fine)->format("%D");

    $totale += $ore + $giorni * 24 + $minuti /60 + $secondi/3600;

    return $totale;
}

try {
    $database = new db();
    $database->query("SELECT tempo.datainizio, tempo.datafine, utente.denominazione 
                            FROM tempo 
                            INNER JOIN progetto ON tempo.progettofk = progetto.progettoid 
                            INNER JOIN utente ON progetto.clientefk = utente.utenteid 
                            ");

    $rows = $database->resultset();

    foreach ($rows as $row) {
        $denominazione = $row['denominazione'];
        $inizio = DateTime::createFromFormat('Y-m-d H:i:s', $row['datainizio']);
        $fine = DateTime::createFromFormat('Y-m-d H:i:s', $row['datafine']);

        $riga = [];
        $riga['denominazione'] = $denominazione;
        $riga['ore'] = differenza_ore($inizio, $fine);

        $tempi[] = $riga;
    }

    foreach ($tempi as $riga) {
        if(in_array($riga['denominazione'], array_column($oggetti, 'denominazione'))) {
            $key = array_search($riga['denominazione'], array_column($oggetti, 'denominazione'));
            $oggetti[$key]['ore'] += $riga['ore'];
        } else {
            $oggetti[] = $riga;
        }
    }

    foreach ($oggetti as $ris) {
        $riga = [];
        $riga[] = $ris['denominazione'];
        $riga[] = number_format($ris['ore'],1);
        $data[] = $riga;
    }

} catch (PDOException $e) {
    throw new PDOException("Error  : " . $e->getMessage());
}

print json_encode($data);