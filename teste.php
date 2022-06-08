<?php

use Controller\Bitrix;

require 'config.php';

$titulo = "CSL_ANE <> CSL_FAS";
$descr = "Task adiada Será Realizado dia 01 ou 02 de Junho";
$abertura = "2022-06-02 03:11:56";
$inicio = "2022-04-13 15:47:00";
$conclusao = "2022-06-02 18:00:00";
$responsavel_tec = "Andre Milanez";

$usera = "Diego Rodrigo Habeck";
$userf = "Diego Rodrigo Habeck";

$incidente = "http://tio.redeunifique.com.br/documentos/hd_unifique/hd_incidentes.php?iCodIncidente=2022060212948562";


$table_open = "[TABLE]";
$table_close = "[/TABLE]";
$tr_open = "[TR]";
$tr_close = "[/TR]";
$td_open = "[TD]";
$td_close = "[/TD]";

$msg_title = $table_open . $tr_open . $td_open . "Task finalizada via sistema de pendências" . $td_close . $td_open . $td_close . $tr_close;
$msg_titulo = $tr_open . $td_open . "Titulo:" . $td_close . $td_open . $titulo . $td_close . $tr_close;
$msg_desc = $tr_open . $td_open . "Descrição:" . $td_close . $td_open . $descr . $td_close . $tr_close;
$res_tec = $tr_open . $td_open . "Responsável técnico:" . $td_close . $td_open . $responsavel_tec . $td_close . $tr_close;
$msg_abert = $tr_open . $td_open . "Data abertura:" . $td_close . $td_open . $abertura . $td_close . $tr_close;
$usr_abert = $tr_open . $td_open . "Responsável abertura:" . $td_close . $td_open . $usera . $td_close . $tr_close;
$usr_fechamento = $tr_open . $td_open . "Responsável fechamento:" . $td_close . $td_open . $userf . $td_close . $tr_close;
$incidente = $tr_open . $td_open . "Incidente:" . $td_close . $td_open . $incidente . $td_close . $tr_close;


$msg_full = $msg_title . $msg_titulo . $msg_desc . $res_tec . $msg_abert . $usr_abert . $usr_fechamento . $table_close;

Bitrix::add_comment($_GET['id'], $msg_full);
Controller\Bitrix::close_taks($_GET['id']);
