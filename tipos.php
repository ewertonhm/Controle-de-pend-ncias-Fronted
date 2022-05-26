<?php

require 'config.php';

$vars = [
    'page_name' => 'Tipos de Incidente',
    'tipos_page' => 'active'
];


// SESSION E TOKEN MANAGEMENT
session_start();
if (!isset($_SESSION['logado']) or $_SESSION['logado'] != true) {
    header('location: login.php');
} else {
    if (!$_SESSION['usuario']->refresh_token()) {
        header('location: logout.php');
    } else {

        $tipos = new \Controller\TipoPendencia($_SESSION['usuario']->token);

        $vars['tipos'] = $tipos->get_all();

        //dump($vars);

        $template = $twig->load('tipos.twig');

        echo $template->render($vars);
    }
}
