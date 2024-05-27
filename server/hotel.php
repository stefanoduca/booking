<?php
header("Content-type: application/json; charset=utf-8");
require_once("mysqli.php");
$conn = apriConnessione();
$citta=getValidParameter("citta", $conn);
$sql = "SELECT * FROM hotel 
WHERE citta='$citta'";
$data= eseguiQuery($conn, $sql);
echo json_encode($data);