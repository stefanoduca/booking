<?php

$page = $_GET['page'] ?? 'index.php';

$template = '/home.php';

if ($page == 'login' ) {
    $template = '/login.php';
}

if ($page == 'hotel' && isset($_GET['citta']) ) {
    $template = '/hotel.php';
}

if ($page == 'hotel-detail' && isset($_GET['citta']) ) {
    $template = '/hotel.php';
}

include __DIR__ . $template;