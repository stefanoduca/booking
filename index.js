'use strict'

$(document).ready(function(){

    let sezione2 = $(".row").eq(1) 
    let sezione3 = $(".row").eq(2).hide()
	
	let sezCitta = $(".citta")
	let sezHotel = $(".hotel")
	let sezDettagli = $(".dettagli")
	
   let request = inviaRichiesta("get", "server/citta.php")
   request.catch(errore)
   request.then(function(response){
	console.log(response.data)
	response.data.forEach(function(citta) {
		console.log(citta["citta"])
		let div=$("<div>").addClass("form-check form-check-inline").appendTo(sezCitta)	
		$("<input>").prop("type","radio").prop("name","inlineRadioOptions").prop("id","inlineRadio"+citta["id"]).prop("value","option-"+citta["id"]).addClass("form-check-input").appendTo(div)
		.on("click",function(){
			let request = inviaRichiesta("get", "server/hotel.php",{"citta":citta["citta"]})
			request.catch(errore)
			request.then(function(response){
				console.log(response.data)
				response.data.forEach(function(hotel){
				let div=$("<div>").appendTo(sezHotel)
				let img=$("<img>").prop("src","img/hotels/"+hotel["img"]).appendTo(div)
				let div2=$("<div>").appendTo(div)
				let h4=$("<h4>").appendTo(div2)
				$("<span>").text(hotel["nomeHotel"]).appendTo(h4)
				for(let i=0;i<hotel["stelle"];i++){
					$("<img>").prop("src","img/star.png").appendTo(h4)
				}
				$("<p>").html(hotel["descrizione"]).appendTo(div2)
				$("<a>").prop("href","#").addClass("btn btn-primary").html("Dettagli").appendTo(div2)
				.on("click",function(){
					sezione2.hide()
					sezione3.show()
					$("#dataInizio").on("change",function(){
						$("#dataFine").prop("disabled",false).val($("#dataInizio").val()).prop("min",$("#dataInizio").val())
					})
					$("<h3>").text(hotel["nomeHotel"]).appendTo(sezDettagli)
					$("<p>").text(hotel["indirizzo"]+"-"+hotel["cap"]+hotel["citta"]).appendTo(sezDettagli)
					let codiceHotel=hotel["codHotel"]
					let div=$("<div>").appendTo(sezDettagli)
					let request=inviaRichiesta("GET","server/foto.php",{"codHotel":codiceHotel})
					request.catch(errore)
					request.then(function(response){
						console.log(response)
						response.data.forEach(function(foto){
							$("<img>").prop("src","img/hotels/"+foto["url"]).appendTo(div)
						})
					})
					let div2=$("<div>").appendTo(sezDettagli)
					$("<p>").text(hotel["descrizione"]).appendTo(div2)
					$("<h3>").text("Tariffe").appendTo(div2)
					request=inviaRichiesta("GET","server/tariffe.php",{"codHotel":codiceHotel})
					request.catch(errore)
					request.then(function(response){
						response.data.forEach(function(tariffa){
							$("<p>").html("dal"+" "+tariffa["dataInizio"]+" "+ "al"+" "+tariffa["dataFine"]+" "+tariffa["prezzo"]+"€").appendTo(div2)
						})
					})
				
				})
				let p=$("<p>").html("Prezzi a partire da :").appendTo(div2)
				$("<span>").html("80€").addClass("prezzo").appendTo(p)
				//$(".btn.btn-primary").on("click",function(){
				//	let dataInzio=$("#dataInizio").val()
				//	let dataFine=$("#dataFine").val()
				//	let codUtente=9
				//	let rq=inviaRichiesta("POST","server/aggiungiPrenotazione.php",{"codUtente":codUtente,"dataInizio":dataInzio,"dataFine":dataFine})
				//	rq.catch(errore)
				//	rq.then(function(){
				//		alert("Prenotazione effettuata con successo")
				//	})
				//})
				// commentato perche senno si pianta tutto
			})
		})
	})
	$("<label>").addClass("form-check-label").prop("for","inlineRadio"+citta["id"]).html(citta["citta"]).appendTo(div)
   })
});
})

