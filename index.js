'use strict'

window.onload = async function () {

    await caricaGoogleMaps();
}

$(document).ready(function(){
	
	$("#btnUsername").click(function(){
		let username=$("#username").val()
		inviaRichiesta("POST","server/controlloUsername.php",{"username":username})
		.catch(errore)
		.then(function({data}){
			if(data.success) {
				$('#selected-username').text($('input[name="username"]').val());
				$('.login-validation').toggle();
			} else {
				$('#username-note').show();
			}
		})
	})

	$('#btnPassword').click(function(){
		let username=$("#username").val()
		let password=$("#password").val()
		inviaRichiesta("POST","server/controlloPassword.php",{"username":username, "password":password})
		.catch(errore)
		.then(function({data}){
			if(data.success) {
				Swal.fire({
					"icon": "success",
					"title": "Accesso avvenuto con successo!"
				}).then(function(){

					window.location.href = "index.php";
				});
			} else {
				$('#password-note').show();
			}
		})
	});

	$('#btnApriMappa').click(function(){
		
		let city = $(this).data('city') ? $(this).data('city') : 'Piemonte';
		let hotel = $(this).data('hotel');
		
		let divMap = $(`<div id="divMap" style="height: 600px"></div>`);
		let geocoder = new google.maps.Geocoder();
		let zoom = $(this).data('city') ? 13 : 9;

		geocoder.geocode({ "address": city }, function (results, status) {

			if (status == google.maps.GeocoderStatus.OK) {
				let position = results[0].geometry.location
				let mapOptions = {
					"center": position,
					"zoom": zoom,
					"styles": [
						{
							"featureType": "poi",
							"stylers": [
								{"visibility": "off"}
							]
						}
					]
				}
				let map = new google.maps.Map(divMap.get(0), mapOptions)

				drawMarkers(map, hotel);
			}
			else {
				alert("indirizzo non valido")
			}
		})

		Swal.fire({
			html: divMap.get(0),
			width: 1400,
			showCloseButton: true,
			showConfirmButton: false,
		});
	});

	$('#btnScriviRecensione').click(function () {

		Swal.fire({
			html: `
				<input type="hidden" id="txtCodHotel" value="${$(this).data('hotel-id')}"></textarea>
				<div>
					<label for="txtRecensione">Recensione</label>
					<textarea id="txtRecensione" class="form-control mb-2"></textarea>
				</div>
				<div>
					<label for="ranStelle">Dai una preferenza di gradimento da 1 a 5</label>
					<input id="ranStelle" class="form-control" type="range" min="1" max="5">
				</div>
			`,
			preConfirm: () => {
				let codHotel = document.getElementById("txtCodHotel").value;
				let recensione = document.getElementById("txtRecensione").value;
				let stelle = document.getElementById("ranStelle").value;
			
				// Se la recensione è vuota, ritorna un messaggio di errore https://sweetalert2.github.io/#input-types
				if (!recensione.length) {
					Swal.showValidationMessage(`
						E' obbligatorio inserire una recensione!
					`);
				}

				// Ritorna i valori da riutilizzare nella risposta https://sweetalert2.github.io/#input-types
				return {
					codHotel: codHotel,
					recensione: recensione,
					stelle: stelle,
				};
			},
			confirmButtonText: "Invia",
		}).then(function(response) {

			if (response.isConfirmed) {

				// response.value contiene già l'oggetto json validato con le informazioni che mi servono!
				inviaRichiesta("POST", "server/inserisciRecensione.php", response.value).then(function (response) {

					if (response) {

						Swal.fire({
							icon: "success",
							title: "Recensione inserita con successo!"
						}).then(function () {

							window.location.reload();
						});
					} else {
						Swal.fire({
							icon: "error",
							title: "Qualcosa è andato storto! Riprova più tardi"
						})
					}
				})
			}
		})
	});

	
})

function drawMarkers(map, hotel) {
	
	let geocoder = new google.maps.Geocoder();

	for(let singleHotel of hotel) {
		geocoder.geocode({ "address": `${singleHotel.indirizzo}, ${singleHotel.citta}, (${singleHotel.siglaProvincia})` }, function (results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				let position = results[0].geometry.location
				new google.maps.Marker({
					map: map,
					position: position,
					title: singleHotel.nomeHotel
				})
			}
			else {
				alert("indirizzo non valido")
			}
		})
	}
}