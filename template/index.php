<?php

require 'server/mysqli.php';

$conn = apriConnessione();

$page = $_GET['page'] ?? 'index.php';

$template = '/home.php';

if ($page == 'login' ) {
    $template = '/login.php';
}

if ($page == 'hotel' && isset($_GET['citta']) ) {
    $template = '/hotel.php';
}

include __DIR__ . $template;