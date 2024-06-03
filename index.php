<?php
    session_start();

    if (($_GET['page'] ?? '') == 'logout' ) {
        unset($_SESSION['username']);

        header('Location: ./');
    }

    require 'server/mysqli.php';

    $conn = apriConnessione();
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./index.css">
    
</head>

<body>

    <header class="bg-primary py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <a href="./" class="text-white text-decoration-none">
                        <div class="d-flex align-items-center h-100">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 180 30" width="110" height="24"
                                class="icon-logo">
                                <path fill="#fff"
                                    d="M70.6 2.74a2.74 2.74 0 1 1 5.48.02 2.74 2.74 0 0 1-5.48-.02zm45.9 21.03a2.753 2.753 0 0 0 2.548-1.69 2.755 2.755 0 0 0-.59-3.001 2.748 2.748 0 0 0-4.234.412 2.755 2.755 0 0 0 .338 3.47c.513.515 1.21.806 1.938.809zM25.7 6.73a8.55 8.55 0 1 0 8.64 8.55 8.292 8.292 0 0 0-8.64-8.55zm0 13.1c-2.35 0-4-1.87-4-4.55 0-2.68 1.64-4.55 4-4.55 2.36 0 4 1.87 4 4.55 0 2.68-1.59 4.55-4 4.55zm39.6-4.12a3.661 3.661 0 0 0-.65-.92l-.15-.16.16-.15c.252-.272.482-.563.69-.87l4.39-6.55h-5.33l-3.31 5.13a1.299 1.299 0 0 1-1.13.41h-.75V2.91c0-1.93-1.21-2.2-2.51-2.2h-2.23v22.87h4.73v-6.86h.44c.54 0 .91.06 1.08.36l2.62 4.89a2.62 2.62 0 0 0 2.82 1.57h3.63l-2.71-4.47-1.79-3.36zm22.97-9.02a6.42 6.42 0 0 0-4.8 2l-.29.29-.1-.4a2.17 2.17 0 0 0-2.38-1.5h-2.13v16.49h4.72v-7.6a6.11 6.11 0 0 1 .29-2 3.86 3.86 0 0 1 3.81-2.89c1.46 0 2 .77 2 2.78v7.19a2.19 2.19 0 0 0 2.51 2.51h2.22V13.07c.03-4.17-2-6.38-5.85-6.38zm-14.88.37h-2.22v16.52h4.7v-14a2.2 2.2 0 0 0-2.48-2.52zm-29.23-.33a8.55 8.55 0 1 0 8.64 8.55 8.292 8.292 0 0 0-8.64-8.55zm0 13.1c-2.35 0-4-1.87-4-4.55 0-2.68 1.64-4.55 4-4.55 2.36 0 4 1.87 4 4.55 0 2.68-1.59 4.55-4 4.55zm100.73-13.1a8.549 8.549 0 0 0-1.545 16.942 8.548 8.548 0 0 0 10.185-8.392 8.277 8.277 0 0 0-.585-3.336 8.291 8.291 0 0 0-8.055-5.214zm0 13.1c-2.35 0-4-1.87-4-4.55 0-2.68 1.64-4.55 4-4.55 2.36 0 4 1.87 4 4.55 0 2.68-1.59 4.55-4 4.55zM109.74 7.02a2.002 2.002 0 0 0-1.93 1l-.12.25-.22-.19a6.39 6.39 0 0 0-4.33-1.44c-4.39 0-7.36 3.31-7.36 8.23s3.07 8.35 7.45 8.35a5.81 5.81 0 0 0 3.62-1.06l.36-.28v.46c0 2.21-1.43 3.43-4 3.43a9.463 9.463 0 0 1-3.16-.59 1.39 1.39 0 0 0-2 1l-.91 2.28.33.17a12.82 12.82 0 0 0 5.76 1.34c4 0 8.67-2.06 8.67-7.83V7.02h-2.16zm-5.68 12.09c-2.56 0-3.48-2.25-3.48-4.35 0-.93.23-4 3.23-4 1.49 0 3.49.42 3.49 4.1 0 3.52-1.76 4.25-3.24 4.25zm-90.97-7.26l-.69-.38.6-.5a5.54 5.54 0 0 0 1.88-4.31c0-3.6-2.79-5.92-7.09-5.92H2.31A2.4 2.4 0 0 0 0 3.1v20.4h7.88c4.79 0 7.89-2.61 7.89-6.66a5.57 5.57 0 0 0-2.68-4.99zM4.37 6.08c0-1.06.45-1.56 1.43-1.62h2a2.47 2.47 0 0 1 2.68 2.69 2.55 2.55 0 0 1-2.66 2.82H4.37V6.08zM8.2 19.64H4.37v-4.58c0-1 .39-1.49 1.22-1.61H8.2a3.1 3.1 0 0 1 0 6.19zm166.33-12.9a6.478 6.478 0 0 0-5.05 2.45l-.34.44-.27-.49a4.67 4.67 0 0 0-4.45-2.4 6 6 0 0 0-4.33 1.95l-.44.48-.17-.63a2.11 2.11 0 0 0-2.3-1.42h-2v16.45h4.46v-7.26a8.452 8.452 0 0 1 .24-1.92c.43-1.76 1.61-3.65 3.59-3.46 1.22.12 1.82 1.06 1.82 2.89v9.75h4.52v-7.26a6.626 6.626 0 0 1 .25-2c.36-1.67 1.59-3.39 3.5-3.39 1.38 0 1.89.78 1.89 2.89v7.36c0 1.66.74 2.4 2.4 2.4H180v-10.5c0-4.2-1.85-6.33-5.47-6.33zm-40.84 11.12a6.882 6.882 0 0 1-4.48 2.11 4.403 4.403 0 0 1-4.367-2.798 4.394 4.394 0 0 1-.293-1.812 4.35 4.35 0 0 1 2.665-4.382A4.334 4.334 0 0 1 129 10.65c.84 0 1.8.3 1.95.81v.09a1.659 1.659 0 0 0 1.6 1.21H135v-2.15c0-2.84-3.61-3.87-6-3.87-5.19 0-9 3.63-9 8.61 0 4.98 3.73 8.62 8.86 8.62a9.637 9.637 0 0 0 7-3.12L134 17.58l-.31.28z">
                                </path>
                            </svg>
                        </div>
                    </a>
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-flex justify-content-end align-items-center h-100 gap-3" style="gap: 0.5rem;">
                        <?php if (!isLogged()) : ?>
                        <!-- <a class="btn btn-outline-light">Iscriviti</a> -->
                        <a href="./?page=login" class="btn btn-light mr-2">Accedi</a>
                        <?php else : ?>
                        <a href="./?page=logout" class="btn btn-light mr-2">Esci</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <ul class="navbar-nav mr-auto" style="height: 6vh;">
                <li class="nav-item">
                    <a href="./?page=hotel&filtro=suites" class="nav-link" href="#">
                        <i class="fa-solid fa-bed mr-2"></i>
                        <span>Suites Incluse</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./?page=hotel&filtro=wifi" class="nav-link" href="#">
                        <i class="fa-solid fa-wifi"></i>
                        <span>Wi-Fi Gratuito</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./?page=hotel&filtro=piscina" class="nav-link" href="#">
                        <i class="fa-solid fa-water-ladder"></i>
                        <span>Piscina Inclusa</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./?page=hotel&filtro=spa" class="nav-link" href="#">
                        <i class="fa-solid fa-spa"></i>
                        <span>SPA Inclusa</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./?page=hotel&filtro=colazioneInclusa" class="nav-link" href="#">
                        <i class="fa-solid fa-mug-hot"></i>
                        <span>Colazione Inclusa</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./?page=hotel&filtro=cenaInclusa" class="nav-link" href="#">
                        <i class="fa-solid fa-utensils"></i>
                        <span>Cena Inclusa</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <?php include './template/index.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a3b677b2d0.js" crossorigin="anonymous"></script>
    <script src="./lib/axios@1.1.2.min.js"></script>
    <script src="./lib/libreria.js"></script>
    <script src="./index.js"></script>