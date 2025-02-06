<?php
require_once 'UserLogin.class.php';

$dados = json_decode(file_get_contents("php://input"));
$entrada = $dados->entrada;
$pwd = $dados->password;

$u = new UserLogin();
if (strpos($entrada, "@")) {
    $u->setEmail($entrada);
} else {
    $u->setUsername($entrada);
}
$u->setPwd($pwd);


$controladorUser = new UserLogin();
if ($controladorUser->verificaSenhaCorreta($u)) {
    session_start();
    $_SESSION['logado'] = true;
    $_SESSION['username'] = $u->getUsername();
    $_SESSION['tipo'] = $u->getTipoUsuario();
    http_response_code(200);
    header("Location: ../../index.html");
} else {
    http_response_code(404);
    header("Location: not-found.html");
}




//kaicon K@!c0n21
//admin admin
//rosinei ifmg123

