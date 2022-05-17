<?php
require_once 'config.php';
session_start();


if(isset($_SESSION['logado']) AND $_SESSION['logado'] == true){
    header('location: index.php');
}

$vars = [];

if(isset($_POST['btn-login'])){
    $_POST['id'] = \Controller\Usuario::logar($_POST['login'],$_POST['senha']);
    if($_POST['id']  != null){
        $_SESSION['nome'] = \Controller\Usuario::getNameById($_POST['id'] );
        $_SESSION['id'] = $_POST['id'];
        $_SESSION['logado'] = true;
        header('location: login.php');
    } else {
        $vars = ['senha'=>'incorreta'];
    }
}

$template = $twig->load('login.twig');
echo $template->render($vars);