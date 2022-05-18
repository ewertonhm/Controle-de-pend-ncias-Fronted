<?php
require 'config.php';

$vars = ['page_name'=>'Index'];

// SESSION E TOKEN MANAGEMENT
session_start();
if(!isset($_SESSION['logado']) OR $_SESSION['logado'] != true){
    header('location: login.php');
}else{
    if(!$_SESSION['usuario']->refresh_token()){
        header('location: logout.php');
    } else {
        // PENDENCIAS
        $pendencias = new \Controller\Pendencia($_SESSION['usuario']->token);
        $p = $pendencias->get_all();
        
        $vars['pendencias']=$p;
        dump($vars);


        $template = $twig->load('index.twig');

        echo $template->render($vars);
    }
}