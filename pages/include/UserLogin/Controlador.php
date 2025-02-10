<?php
require_once 'UserLogin.class.php';

// Function to start the session if it hasn't been started already
function start_session_if_not_started()
{
    if (session_status() == PHP_SESSION_NONE) {
        ini_set('session.gc_maxlifetime', 3600);
        ini_set('session.cookie_lifetime', 3600);
        session_start();
    }
}


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
        start_session_if_not_started(); // Start the session here

        $_SESSION['logado'] = true;
        $_SESSION['username'] = $u->getUsername();
        $_SESSION['tipo'] = $u->getTipoUsuario();
        http_response_code(200);
        header("Location: ../../index.html");
        exit(); // Important: Stop execution after redirect
    } else {
        http_response_code(404);
    }
}

if ($_REQUEST['acao'] === "logout") {
    start_session_if_not_started(); // Start the session if it exists

    $_SESSION['logado'] = false; // Although not strictly necessary, good practice
    unset($_SESSION['username']); // Use unset to remove specific session variables
    unset($_SESSION['tipo']);     // Use unset to remove specific session variables
    session_destroy();
    http_response_code(200);
    header("Location: ../../index.html");
    exit(); // Important: Stop execution after redirect
}

if ($_REQUEST["acao"] === "check") {
    start_session_if_not_started(); // Crucial: Start session before checking

    // More robust check: use isset()
    $response = (isset($_SESSION['logado']) && $_SESSION['logado'] === true ? true : false);
    echo json_encode($response);
}


//kaicon K@!c0n21
//admin admin
//rosinei ifmg123