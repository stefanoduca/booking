<?php

    $hotel = $_GET['hotel'];

    $query = "SELECT * FROM hotel WHERE codHotel = '$hotel'";
    $hotel = eseguiQuery($conn, $query)[0];

?>

<section class="container mt-3">

    <div class="row">

        <div class="col-12">
            <h1 class="h4"><?= $hotel['nomeHotel'] ?></h1>
            <p>
                <i class="text-primary fa-solid fa-location-dot"></i>
                <span><?= $hotel['indirizzo'] ?>, <?= $hotel['CAP'] ?>, <?= $hotel['citta'] ?></span>
            </p>
        </div>
        
        <div class="col-12 col-md-6 mt-4">
            <div class="card-bg-image" style="background-image: url(./img/hotels/<?= $hotel['img'] ?>); border-radius: 10px"></div>
        </div>
        
        <div class="col-12 col-md-6 mt-4">
            <div>
                <div>
                    <?= $hotel['descrizione'] ?>
                </div>
                <div class="mt-3">
                    <?php if ($hotel['suites']): ?>
                    <span class="badge badge-light border shadow-sm">
                        <i class="fa-solid fa-bed mr-2"></i>
                        <span>
                            <?= $hotel['suites'] ?> suites
                        </span>
                    </span>
                    <?php endif; ?>
                    <?php if ($hotel['wifi']): ?>
                    <span class="badge badge-light border shadow-sm">
                        <i class="fa-solid fa-wifi"></i>
                        <span>
                            Wi-Fi Gratuito
                        </span>
                    </span>
                    <?php endif; ?>
                    <?php if ($hotel['piscina']): ?>
                    <span class="badge badge-light border shadow-sm">
                        <i class="fa-solid fa-water-ladder"></i>
                        <span>
                            Piscina Inclusa
                        </span>
                    </span>
                    <?php endif; ?>
                    <?php if ($hotel['spa']): ?>
                    <span class="badge badge-light border shadow-sm">
                        <i class="fa-solid fa-spa"></i>
                        <span>
                            SPA Inclusa
                        </span>
                    </span>
                    <?php endif; ?>
                    <?php if ($hotel['colazioneInclusa']): ?>
                    <span class="badge badge-light border shadow-sm">
                        <i class="fa-solid fa-mug-hot"></i>
                        <span>
                            Colazione Inclusa
                        </span>
                    </span>
                    <?php endif; ?>
                    <?php if ($hotel['cenaInclusa']): ?>
                    <span class="badge badge-light border shadow-sm">
                        <i class="fa-solid fa-utensils"></i>
                        <span>
                            Cena Inclusa
                        </span>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>

</section>