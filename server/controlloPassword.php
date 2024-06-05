<?php

session_start();
header("Content-type: application/json; charset=utf-8");
require_once("mysqli.php");
$conn = apriConnessione();
$username=getValidParameter("username", $conn);
$password=getValidParameter("password", $conn);

// l'MD5 è un particolare algoritmo di hashing che permette (attraverso una stringa usata come "password") di generarne un'"impronta".
// Tale impronta si manifesta sottoforma di stringa alfanumerica e rappresenta una sorta di chiave da cui, una volta ottenuta,
// non è più possibile tornare indietro e ottenere la stringa originaria.
// Questo è molto importante perchè le password in un database non vanno MAI SALVATE IN CHIARO: proprio a garanzia della sicurezza
// della privacy degli utenti che usano il nostro sito.
// Attenzione: è sempre una buona norma usare password lunghe e complesse per evitare fenomeni spiacevoli come il "brute force"
// https://www.serverplan.com/blog/attacco-brute-force/#gref
$sql="SELECT username
 FROM utenti 
 WHERE username='$username'
 AND psw='".md5($password)."'";

// Anche l'inserimento di parametri a "crudo" come viene fatto nella maggior parte degli esercizi dovrebbe
// essere utilizzato con cautela: soprattutto se questi parametri che vengono inseriti nella query arrivano da
// valori recuperati da una query string
// https://www.w3schools.com/sql/sql_injection.asp

$data=eseguiQuery($conn, $sql);

// Una volta verificato che il nome utente è assegnato alla password corretta, salvo il suo nome in sessione
// N.B: sarebbe più corretto salvare l'ID dell'utente più del nome per garantirne l'univocità!
$_SESSION["username"]=$username;

$result = count($data);

echo json_encode(["success" => $result]);