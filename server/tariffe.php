<?php
header("Content-type: application/json; charset=utf-8");
require_once("mysqli.php");
$conn = apriConnessione();
$codHotel=getValidParameter("codHotel", $conn);
$sql = "SELECT *FROM tariffe
 WHERE codHotel='$codHotel'";
 $data=eseguiQuery($conn, $sql);
echo json_encode($data);