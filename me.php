<?php

use Controller\Usuario;

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
        if (isset($_POST['set-password'])) {
            if ($_POST['senha'] != $_POST['confirm_senha']) {
                dump('Senhas não conferem!');
            } else {
                $usuarios = new \Controller\Usuario();
                $usuarios->token = $_SESSION['usuario']->token;
                $usuarios->id = $_SESSION['usuario']->id;

                $usuarios->changePassword($usuarios->id, $_POST['senha']);
            }
        }
        //dump($vars);

        $template = $twig->load('me.twig');

        echo $template->render($vars);
    }
}
