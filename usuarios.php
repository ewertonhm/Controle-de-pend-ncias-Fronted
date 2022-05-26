<?php

require 'config.php';

$vars = [
    'page_name' => 'Gerência de Usuários',
    'usuarios_page' => 'active'
];


// SESSION E TOKEN MANAGEMENT
session_start();
if (!isset($_SESSION['logado']) or $_SESSION['logado'] != true) {
    header('location: login.php');
} else {
    if (!$_SESSION['usuario']->refresh_token()) {
        header('location: logout.php');
    } else {

        $usuarios = new \Controller\Usuario($_SESSION['usuario']->token);

        //$vars['usuarios'] = $usuarios->get_all();

        //dump($vars);

        $template = $twig->load('usuarios.twig');

        echo $template->render($vars);
    }
}
