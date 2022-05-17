<?php
require 'config.php';

$vars = ['page_name'=>'Index'];

session_start();
if(!isset($_SESSION['logado']) OR $_SESSION['logado'] != true){
    header('location: login.php');
}else{
    if(!$_SESSION['usuario']->refresh_token()){
        header('location: logout.php');
    }
}

dump($_SESSION);

$template = $twig->load('index.twig');

echo $template->render($vars);