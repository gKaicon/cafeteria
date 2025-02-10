<?php
session_start();
$response;
$response["logado"] = ($_SESSION['logado'] ? "true" : "false");
$response["tipoUser"] = ((($_SESSION['tipo'] == 'admin') || ($_SESSION['tipo'] == 'default')) ? 0 : 1);

echo json_encode($response);
?>