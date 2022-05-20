<?php

require 'config.php';

$vars = ['page_name' => 'Index'];

// SESSION E TOKEN MANAGEMENT
session_start();
if (!isset($_SESSION['logado']) or $_SESSION['logado'] != true) {
    header('location: login.php');
} else {
    if (!$_SESSION['usuario']->refresh_token()) {
        header('location: logout.php');
    } else {
        // PENDENCIAS
        $pendencias = new \Controller\Pendencia($_SESSION['usuario']->token);
        $p = $pendencias->get_all();

        foreach ($p as $pendencia) {
            if ($pendencia->inicio != null) {
                $pendencia->inicio = Controller\Date::convertFromJsToHuman($pendencia->inicio);
            }
            if ($pendencia->previsao != null) {
                $isAtrasado = Controller\Date::checkIfIsAtrasado($pendencia->previsao);
                if ($isAtrasado) {
                    $pendencia->{'atrasado'} = true;
                }
                $pendencia->previsao = Controller\Date::convertFromJsToHuman($pendencia->previsao);
                $andamento = new Controller\Andamento($_SESSION['usuario']->token);
                $pendencia->{'andamentos'} = $andamento->get_all($pendencia->id);
            }
        }

        $vars['pendencias'] = $p;

        dump($vars);

        $template = $twig->load('index.twig');

        echo $template->render($vars);
    }
}
