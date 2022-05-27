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
        $usuarios = new \Controller\Usuario();
        $usuarios->token = $_SESSION['usuario']->token;

        if (isset($_POST['novo'])) {
            dump($usuarios->cadastrarUsuario($_POST['nome'], $_POST['sobrenome'], $_POST['email'], $_POST['senha']));
        } elseif (isset($_GET['editar'])) {
            $usuario = $usuarios->get_one($_GET['editar']);
            $vars['editar'] = $usuario;
        } elseif (isset($_POST['editar'])) {
            dump($usuarios->editarUsuario($_POST['id'], $_POST));
        } elseif (isset($_GET['ativar'])) {
            dump($usuarios->ativarUsuario($_GET['ativar']));
        } elseif (isset($_GET['desativar'])) {
            dump($usuarios->desativarUsuario($_GET['desativar']));
        }

        $vars['usuarios'] = $usuarios->get_all();

        //dump($vars);

        $template = $twig->load('usuarios.twig');

        echo $template->render($vars);
    }
}
