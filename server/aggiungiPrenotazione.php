<?php
header("Content-type: application/json; charset=utf-8");
require_once("mysqli.php");
$conn = apriConnessione();
$codUtente=getValidParameter("codUtente", $conn);
$dataInzio=getValidParameter("dataInizio", $conn);
$dataFine=getValidParameter("dataFine", $conn);
$sql="UPDATE prenotazioni 
SET codUtente='$codUtente', dataInizio='$dataInizio', dataFine='$dataFine'
WHERE codUtente='$codUtente";
$data=eseguiQuery($conn, $sql);
echo json_encode($data);