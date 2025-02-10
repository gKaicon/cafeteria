<?php
session_start();
$response;
$response["logado"] = ($_SESSION['logado'] ? "true" : "false");

echo json_encode($response);
?>