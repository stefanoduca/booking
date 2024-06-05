<?php

// Recupera la pagina attraverso il parametro "page" in query string e, se non è specificato,
// usa come "fallback" -> index.php
$page = $_GET['page'] ?? 'index.php';

// Definisce il template da utilizzare
$template = '/home.php';

// Se la pagina richiesta è "login" verifichiamo che NON ESISTA nessun nome utente salvato in sessione
// Non ha senso accedere alla pagina di login se esiste già un utente salvato in sessione
if ($page == 'login' && !(isset($_SESSION['username'])) ) {
    $template = '/login.php';
}

// Se la pagina richiesta è "hotel", verifichiamo che esista ALMENO UNO dei due parametri in query string:
// "città" oppure "filtro" vedi file hotel.php riga 6
if ($page == 'hotel' && (isset($_GET['citta']) || isset($_GET['filtro'])) ) {
    $template = '/hotel.php';
}

// Se la pagina richiesta è "hotel-detail" verifichiamo che esista NECESSARIAMENTE almeno il parametro "hotel".
// Tale parametro ci permetterà di recuperare con maggiore facilità i dati legati al dettaglio del singolo hotel.
if ($page == 'hotel-detail' && isset($_GET['hotel']) ) {
    $template = '/hotel-detail.php';
}

// Include il file del template
// N.B: __DIR__ ritorna il percorso della cartella in cui il file è contenuto
// Attenzione! Si può accedere al percorso della cartella "padre" utilizzando dirname(__DIR__) nel caso in cui il
// file desiderato non si trovi nè nella cartella corrente nè in una sottocartella
include __DIR__ . $template;