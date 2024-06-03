<?php

session_start();
header("Content-type: application/json; charset=utf-8");
require_once("mysqli.php");
$conn = apriConnessione();
$username=getValidParameter("username", $conn);
$password=getValidParameter("password", $conn);

$sql="SELECT username
 FROM utenti 
 WHERE username='$username'
 AND psw='".md5($password)."'";

$data=eseguiQuery($conn, $sql);

$_SESSION["username"]=$username;

$result = count($data);

echo json_encode(["success" => $result]);