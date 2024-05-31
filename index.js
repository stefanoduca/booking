'use strict'

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
				alert("Accesso avvenuto con successo!");
			} else {
				$('#password-note').show();
			}
		})
	});
})

