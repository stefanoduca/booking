<?php

    $hotel = $_GET['hotel'];

    $query = "SELECT * FROM hotel WHERE codHotel = '$hotel'";
    $hotel = eseguiQuery($conn, $query)[0];

	// Do per scontato di non avere un'utente in sessione
	$utente = false;

	if (isset($_SESSION['username'])) {

		$query = "SELECT * FROM utenti WHERE username = '{$_SESSION['username']}'";
		// Se l'utente cercato non esite, utente diventa false
		$utente = eseguiQuery($conn, $query)[0] ?? false;
	}

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
                            Suites Incluse
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
                <h1 class="h5 mt-3">Camere Disponibili:</h1>
                <p>Stanze Singole: <?= ($hotel['stanzeSingole'] - $hotel['singolePrenotate']) ?></p>
                <p>Stanze Doppie: <?= ($hotel['stanzeDoppie'] - $hotel['doppiePrenotate']) ?></p>
                <p>Stanze Triple: <?= ($hotel['stanzeTriple'] - $hotel['triplePrenotate']) ?></p>
                <p>Stanze Quadruple: <?= ($hotel['stanzeQuadruple'] - $hotel['quadruplePrenotate']) ?></p>
                <p>Suites: <?= ($hotel['suites'] - $hotel['suitesPrenotate']) ?></p>
            </div>

            <hr />
        </div>

        <div class="col-12 mb-3">
            <h1 class="h5">Recensioni degli ospiti</h1>
        </div>

        <?php

			$sql = "SELECT * FROM recensioni, utenti WHERE codHotel = " . $hotel["codHotel"] . " AND recensioni.codUtente = utenti.codUtente";
			$recensioni = eseguiQuery($conn, $sql);

        ?>

        <div class="col-12 mb-3">
            <div class="row">

				<?php foreach($recensioni as $recensione) : ?>
                <div class="col-12 col-md-4 mb-3">

					<div class="border rounded p-3 h-100">
                    
						<?php
						
							$immagineProfilo = "/img/utenti/" . $recensione['imgProfilo'];

							// Controlla se il file esiste partendo dalla cartella padre.
							// Se il file non esiste, mette un immagine di default
							if (!file_exists(dirname(__DIR__) . $immagineProfilo)) {
								$immagineProfilo = "/img/avatar.png";
							}
						?>

						<div class="d-flex justify-content-between align-items-center mb-4">
							<div>
								<img class="rounded-circle mr-2 mb-2" style="width: 2rem;" src=".<?= $immagineProfilo ?>">
								<p><b><?= $recensione['username'] ?></b></p>
							</div>
							<div>
								<?php for ($i = 0; $i < $recensione['stelle']; $i++) : ?>
                            		<img src="img/star.png" alt="stella" style="width: 1.2rem;">
                        		<?php endfor; ?>
							</div>
						</div>
						<p><?= $recensione['testoRecensione'] ?></p>
					</div>

                </div>
				<?php endforeach; ?>

            </div>
        </div>

		<div class="col-12 mb-5">

			<?php if ($utente) : ?>	
			<button id="btnScriviRecensione" class="btn btn-outline-primary" data-hotel-id="<?= $hotel['codHotel'] ?>">Scrivi una recensione</button>
			<?php else : ?>
			<a href="./?page=login">Accedi per scrivere una recensione</a>
			<?php endif; ?>

		</div>

		<?php if ($utente) : ?>
		<div class="position-fixed shadow" style="bottom: 1rem; right: 5rem;">
			<button id="btnPrenota" class="btn btn-primary" data-utente-id="<?= $utente['codUtente'] ?>" data-hotel="<?= $hotel['nomeHotel'] ?>" data-hotel-id="<?= $hotel['codHotel'] ?>"><span class="h4">Prenota ora!</span></button>
		</div>
		<?php endif; ?>

    </div>

</section>