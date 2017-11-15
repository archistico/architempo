<?php
// Classe Autenticazione/Autorizzazione
class Login {
    public $loginid;    // int
    public $utentefk;   // int
    public $datalogin;  // timestamp
    public $progressivo;// int
    public $ip;         // text
    public $accesso;    // boolean

    public $utente;     // utente

    public static function ADD($utentefk, $accesso) {
        // Aggiungi alla base dati
    }
}

