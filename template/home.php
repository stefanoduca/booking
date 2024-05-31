<?php

    require_once 'server/mysqli.php';

    $conn = apriConnessione();

?>

<section class="jumbotron jumbotron-fluid bg-image text-white d-flex justify-content-center align-items-start" style="height: 70vh">
    <div class="container text-center">
        <h1 class="display-4">Trova l'alloggio che fa per te</h1>
        <p class="lead pb-5">Cerca offerte su hotel, case e tanto altro...</p>
        <div class="input-group mb-3 shadow" style="border-width: 0.8rem;">
            <input type="text" class="form-control" placeholder="Dove vuoi andare?">
            <div class="input-group-append">
                <button class="btn btn-warning" type="button">Cerca</button>
            </div>
        </div>
    </div>
</section>

<?php 
    $query = "SELECT * FROM citta";
    $citta = eseguiQuery($conn, $query);
?>

<div class="container">
    <div class="mb-3">
        <h1 class="h3">Le nostre mete:</h1>
    </div>
    <div class="row">
        <?php foreach ($citta as $singleCitta): ?>
        <div class="col-12 col-md-4 mb-5">
            <div class="card bg-transparent border-0 text-center">
                <div class="card-body card-bg-image shadow text-left text-white" style="background-image: url(img/citta/<?= $singleCitta['citta'] ?>.jpg)">
                    <h3 class="mt-3" style="font-size: 1.8rem;"><b class="border-text"><?= $singleCitta['citta'] ?></b></h3>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>