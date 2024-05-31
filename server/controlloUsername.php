<?php
header("Content-type: application/json; charset=utf-8");
require_once("mysqli.php");
$conn = apriConnessione();
$username=getValidParameter("username", $conn);


$sql="SELECT username
 FROM utenti 
 WHERE username='$username'";

$data=eseguiQuery($conn, $sql);
echo json_encode(["success" => count($data)]);