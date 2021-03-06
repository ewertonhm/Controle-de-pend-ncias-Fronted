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
        $vars['me'] = $_SESSION['me'];

        // instanciate classes
        $pendencias = new \Controller\Pendencia($_SESSION['usuario']->token);
        $andamentos = new Controller\Andamento($_SESSION['usuario']->token);
        $sorting = new Controller\Sort();


        if (isset($_POST['andamento']) and $_POST['andamento'] != '') {
            // adicionar andamento a pendĂȘncia
            $pendencias->addAndamento($_POST['idPendencia'], $_POST['andamento']);
            unset($_POST);
            header("Location: " . $_SERVER['REQUEST_URI']);
        } elseif (isset($_POST['fim']) and $_POST['fim'] != '') {
            $result = $pendencias->fecharPendencia($_POST['idPendencia'], $_POST['fim']);
            unset($_POST);
            if (isset($result['bitrix'])) {
                $_SESSION['last_bitrix_task_status'] = $result['bitrix'];
                $_SESSION['last_bitrix_task_status']['task'] = $result['pendencia']->task;
            }
            header("Location: " . $_SERVER['REQUEST_URI']);
        } elseif (isset($_POST['edit'])) {
            $pendencias->editPendencia($_POST);
            unset($_POST);
            header("Location: " . $_SERVER['REQUEST_URI']);
        } elseif (isset($_POST['new'])) {
            $pendencias->addPendencia($_POST);
            unset($_POST);
            header("Location: " . $_SERVER['REQUEST_URI']);
        }


        // if no post:
        // PENDENCIAS
        $raw_pendencias = $pendencias->get_all();

        if (count($raw_pendencias) > 0) {
            // sort

            if (isset($_GET['concluidos'])) {
                $raw_pendencias = $sorting->sort_by_fim($raw_pendencias);
            } else {
                $raw_pendencias = $sorting->sort_by_inicio($raw_pendencias);
            }


            $p = [];
            // TODO: filtrar direto no backend futuramente
            // Quando tiver muitas entradas no banco essa etapa pode comeĂ§ar a ficar muito lenta.
            if (isset($_GET['concluidos'])) {
                $vars['concluidos'] = 'active';
                foreach ($raw_pendencias as $pendencia) {
                    if ($pendencia->fim != null) {
                        $p[] = $pendencia;
                    }
                }
            } elseif (isset($_GET['all'])) {
                $vars['all'] = 'active';
                $p = $raw_pendencias;
            } else {
                $vars['index'] = 'active';
                foreach ($raw_pendencias as $pendencia) {
                    if ($pendencia->fim == null) {
                        $p[] = $pendencia;
                    }
                }
            }

            // Add pagination / create array_chunks
            $pp = array_chunk($p, 20, false);

            $vars['pages'] = count($pp);
            if (isset($_GET['page'])) {
                $p = $pp[(int)$_GET['page']];
                $vars['page'] = (int) $_GET['page'];
            } else {
                $p = $pp[0];
                $vars['page'] = 0;
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

            $vars['pendencias'] = $p;
        }


        $tipos = new \Controller\TipoPendencia($_SESSION['usuario']->token);

        $vars['tipos'] = $tipos->get_all();

        if (isset($_SESSION['last_bitrix_task_status'])) {
            if ($_SESSION['last_bitrix_task_status']['comment'] != 200 || $_SESSION['last_bitrix_task_status']['close'] != 200) {
                $vars['toast']['message'] = $_SESSION['last_bitrix_task_status']['task'];
                unset($_SESSION['last_bitrix_task_status']);
            }
        }

        $template = $twig->load('index.twig');

        echo $template->render($vars);
    }
}
