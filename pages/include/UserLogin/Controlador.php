<?php
require_once 'UserLogin.class.php';

if ($_REQUEST['acao'] === "login") {
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
        ini_set('session.gc_maxlifetime', 3600);
        ini_set('session.cookie_lifetime', 3600);
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
}


if ($_REQUEST['acao'] === "logout") {
    $controladorUser = new UserLogin();
    session_start();
    $_SESSION['logado'] = false;
    $_SESSION['username'] = "";
    $_SESSION['tipo'] = "";
    session_destroy();
    http_response_code(200);
    header("Location: ../../index.html");
}

//kaicon K@!c0n21
//admin admin
//rosinei ifmg123