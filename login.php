<?php
require_once 'config.php';

session_start();

if(isset($_SESSION['logado']) AND $_SESSION['logado'] == true){
    header('location: index.php');
}

// check server status
$api = new \Controller\Api();
if(!$api->check_status()){
    echo "could not connect to backend server";
}

    

$vars = [];

if(isset($_POST['btn-login'])){
    $user = new \Controller\Usuario();
    $_POST['logado'] = $user->logar($_POST['login'],$_POST['senha']);
    if($_POST['logado']){
        $_SESSION['usuario'] = $user;
        $_SESSION['logado'] = true;
        header('location: login.php');
    } else {
        $vars = ['senha'=>'incorreta'];
    }
}

$template = $twig->load('login.twig');
echo $template->render($vars);