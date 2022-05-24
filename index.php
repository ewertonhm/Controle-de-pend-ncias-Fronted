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
        // instanciate classes
        $pendencias = new \Controller\Pendencia($_SESSION['usuario']->token);
        $andamentos = new Controller\Andamento($_SESSION['usuario']->token);

        if (isset($_POST['andamento']) and $_POST['andamento'] != '') {
            // adicionar andamento a pendência
            $pendencias->addAndamento($_POST['idPendencia'], $_POST['andamento']);
        } elseif (isset($_POST['fim']) and $_POST['fim'] != '') {
            $result = $pendencias->fecharPendencia($_POST['idPendencia'], $_POST['fim']);
        } elseif (isset($_POST['edit'])) {
            $pendencias->editPendencia($_POST);
        } elseif (isset($_POST['new'])) {
            $pendencias->addPendencia($_POST);
        }


        // if no post:
        // PENDENCIAS
        $p = $pendencias->get_all();

        if (!isset($_GET['historico'])) {
            $vars['index'] = 'active';
            $counter = 0;
            while ($counter < count($p)) {
                if ($p[$counter]->fim != null) {
                    //dump($p);
                    unset($p[$counter]);
                }


                $counter++;
            }
        } else {
            $vars['historico'] = 'active';
        }

        foreach ($p as $pendencia) {
            $pendencia->{'hora_abertura'} = Controller\Date::convertFromJsToHumanPluOne($pendencia->created_at);

            if ($pendencia->inicio != null) {
                $pendencia->inicio = Controller\Date::convertFromJsToHuman($pendencia->inicio);
            }
            if ($pendencia->fim != null) {
                $pendencia->fim = Controller\Date::convertFromJsToHuman($pendencia->fim);
                $pendencia->{'hora_fechamento'} = Controller\Date::convertFromJsToHumanPluOne($pendencia->updated_at);
            }
            if ($pendencia->previsao != null) {
                $isAtrasado = Controller\Date::checkIfIsAtrasado($pendencia->previsao);
                if ($isAtrasado) {
                    $pendencia->{'atrasado'} = true;
                }
                $pendencia->previsao = Controller\Date::convertFromJsToHuman($pendencia->previsao);
                $andamentos_all = $andamentos->get_all($pendencia->id);

                foreach ($andamentos_all as $andamento) {
                    $andamento->{'hora'} = Controller\Date::convertFromJsToHumanPluOne($andamento->created_at);
                    $pendencia->{'andamentos'}[] = $andamento;
                }
            }
        }
        $tipos = new \Controller\TipoPendencia($_SESSION['usuario']->token);
        $sorting = new Controller\Sort();

        $vars['pendencias'] = $sorting->sort_by_inicio($p);

        $vars['tipos'] = $tipos->get_all();

        //dump($vars);

        $template = $twig->load('index.twig');

        echo $template->render($vars);
    }
}
