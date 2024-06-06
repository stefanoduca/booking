<?php

    $citta = $_GET['citta'] ?? null;
    $filtro = $_GET['filtro'] ?? null;

    // Se esiste la città, recupero la lista degli hotel per citta
    if (isset($citta)) {
        $query = "SELECT * FROM hotel WHERE citta = '$citta'";
        $hotel = eseguiQuery($conn, $query);
    } else {
        // Se non esiste la città, deve esistere un parametro filtro
        // >= 1 serve a verificare la presenza delle suites che, a differenza degli altri filtri,
        // può avere un valore maggiore o uguale a 1
        $query = "SELECT * FROM hotel WHERE $filtro >= 1";
        $hotel = eseguiQuery($conn, $query);
    }

?>

<section class="container mt-3">

    <div class="row">

        <div class="col-12 col-md-3">
            <div class="map-bg">
                <button id="btnApriMappa" class="btn btn-primary" data-city="<?= $citta ?>" data-hotel="<?= htmlentities(json_encode($hotel), ENT_QUOTES) ?>">Vedi su mappa</button>
            </div>
        </div>
        <div class="col-12 col-md-9">
            
            <h1 class="h5"><?= isset($citta) ? ($citta . ':') : '' ?> <?= count($hotel) ?> strutture trovate</h1>

            <?php foreach ($hotel as $singleHotel) : ?>

            <div class="row my-3 p-3 border rounded-lg no-gutters">

                <div class="col-12 col-md-4">
                    <div class="card-bg-hotel border rounded-lg shadow-sm" style="background-image: url(img/hotels/<?= $singleHotel['img'] ?>);">
                    </div>
                </div>

                <div class="col-12 col-md-7 ml-3">
                    <h1 class="h5 text-lowercase text-hotel">
                        <b><?= $singleHotel['nomeHotel'] ?></b>
                        <?php for ($i = 0; $i < $singleHotel['stelle']; $i++) : ?>
                            <img src="img/star.png" alt="stella" style="width: 1.2rem;">
                        <?php endfor; ?>
                    </h1>
                    <p class="text-hotel" style="font-size: 0.8rem"><?= $singleHotel['indirizzo'] ?>, <?= $singleHotel['citta'] ?></p>
                    <p style="font-size: 0.8rem"><?= $singleHotel['descrizione'] ?></p>
                    <a href="./?page=hotel-detail&hotel=<?= $singleHotel['codHotel'] ?>" class="btn btn-primary">Dettagli</a>
                    <div class="mt-3">
                        <p>Prezzo: 80€</p>
                    </div>
                </div>
            
            </div>

            <?php endforeach; ?>
        </div>

    </div>

</section>