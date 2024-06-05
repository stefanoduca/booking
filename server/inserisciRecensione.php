<?php

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ./');
}

header("Content-type: application/json; charset=utf-8");
require_once("mysqli.php");
$conn = apriConnessione();
$codHotel=getValidParameter("codHotel", $conn);
$recensione=getValidParameter("recensione", $conn);
$stelle=getValidParameter("stelle", $conn);

// Le parentesi graffe ti permettono di incapsulare anche un singolo elemento di un vettore
$query = "SELECT * FROM utenti WHERE username = '{$_SESSION['username']}'";
$utente = eseguiQuery($conn, $query)[0];

$sql = "INSERT INTO recensioni(`codUtente`, `codHotel`, `testoRecensione`, `stelle`, `data`)
    VALUES('{$utente['codUtente']}', '$codHotel', '$recensione', '$stelle', NOW());";
$result = eseguiQuery($conn, $sql);

echo json_encode(["success" => $result]);