<?php
header("Content-type: application/json; charset=utf-8");
require_once("mysqli.php");
$conn = apriConnessione();
$sql = "SELECT *FROM citta";
$data= eseguiQuery($conn, $sql);
echo json_encode($data);