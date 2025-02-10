<?php
session_start();
$response = ($_SESSION['logado'] == true ? true : false);
echo json_encode($response);
?>