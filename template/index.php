<?php

$page = $_GET['page'] ?? 'index.php';

$template = '/home.php';

if ($page == 'login' ) {
    $template = '/login.php';
}

include __DIR__ . $template;