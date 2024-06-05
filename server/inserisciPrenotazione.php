<?php

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ./');
}

header("Content-type: application/json; charset=utf-8");
require_once("mysqli.php");
$conn = apriConnessione();
$codHotel=getValidParameter("codHotel", $conn);
$codUtente=getValidParameter("codUtente", $conn);
$dataInizio=getValidParameter("dataInizio", $conn);
$dataFine=getValidParameter("dataFine", $conn);
$numeroPersone=getValidParameter("numeroPersone", $conn);
$suite=getValidParameter("suite", $conn);
$prezzo=getValidParameter("prezzoPerPersona",$conn);

$dataInizio = new DateTime($dataInizio);

// Le parentesi graffe ti permettono di incapsulare anche un singolo elemento di un vettore
$query = "SELECT * FROM utenti WHERE username = '{$_SESSION['username']}'";
$utente = eseguiQuery($conn, $query)[0];

$sql = "INSERT INTO prenotazioni(`codUtente`, `codHotel`, `dataInizio`, `dataFine`, `nPersone`,`prezzoPerPersona`,`tipoSTanza`)
    VALUES('{$utente['codUtente']}', '$codHotel', '{$dataInizio->format('Y-m-d')}', '$dataFine','$numeroPersone','$prezzo','$suite')";
$result = eseguiQuery($conn, $sql);

echo json_encode(["success" => $result]);   