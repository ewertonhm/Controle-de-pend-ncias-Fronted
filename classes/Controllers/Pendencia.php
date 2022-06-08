<?php

namespace Controller;

class Pendencia
{
    private $api;
    private $token;

    public function __construct($token)
    {
        $this->api = new Api();
        $this->token = $token;
    }

    public function get_all()
    {
        $pendencias = $this->api->CallAPI("GET", "/pendencias/extend", $this->token);
        return $pendencias->data;
    }

    public function findOne($id)
    {
        $pendencias = $this->api->CallAPI("GET", "/pendencias/$id", $this->token);
        return $pendencias->data;
    }

    public function addAndamento($id, $andamento)
    {
        $data = [
            "andamento" => $andamento,
            "dataAndamento" => Date::jsNow()
        ];
        $pendencias = $this->api->CallAPI("POST", "/pendencias/$id/andamento", $this->token, $data);
        return $pendencias;
    }
    public function addPendencia(
        $POST
    ) {
        $data = [
            "tipoPendenciaId" => $POST['tipo'],
            "titulo" => $POST['titulo'],
            "descricao" => $POST['descricao'],
            "inicio" => $POST['inicio'],
            "responsavel" => $POST['responsavel'],
            "previsao" => $POST['previsao'],
            "task" => $POST['task'],
            "incidente" => $POST['incidente']
        ];
        $pendencias = $this->api->CallAPI("POST", "/pendencias", $this->token, $data);
        return $pendencias;
    }
    public function editPendencia($POST)
    {
        $data = [
            "tipoPendenciaId" => $POST['tipo'],
            "titulo" => str_replace('&gt;', '>', str_replace('&lt;', '<', $POST['titulo'])),
            "descricao" => str_replace('&gt;', '>', str_replace('&lt;', '<', $POST['descricao'])),
            "inicio" => $POST['inicio'],
            "responsavel" => str_replace('&gt;', '>', str_replace('&lt;', '<', $POST['responsavel'])),
            "previsao" => $POST['previsao'],
            "task" => $POST['task'],
            "incidente" => $POST['incidente'],
        ];
        $id = $POST['idPendencia'];
        $pendencias = $this->api->CallAPI("PATCH", "/pendencias/$id", $this->token, $data);
        return $pendencias;
    }
    public function add_comment_task($id, $pendencia)
    {
        $table_open = "[TABLE]";
        $table_close = "[/TABLE]";
        $tr_open = "[TR]";
        $tr_close = "[/TR]";
        $td_open = "[TD]";
        $td_close = "[/TD]";

        $msg_title = $table_open . $tr_open . $td_open . "Task finalizada via sistema de pendências" . $td_close . $td_open . $td_close . $tr_close;
        $msg_titulo = $tr_open . $td_open . "Titulo:" . $td_close . $td_open . $pendencia->titulo . $td_close . $tr_close;
        $msg_desc = $tr_open . $td_open . "Descrição:" . $td_close . $td_open . $pendencia->descricao . $td_close . $tr_close;
        $res_tec = $tr_open . $td_open . "Responsável técnico:" . $td_close . $td_open . $pendencia->responsavel . $td_close . $tr_close;
        $msg_abert = $tr_open . $td_open . "Data abertura:" . $td_close . $td_open . Date::convertFromJsToHumanPluOne($pendencia->created_at) . $td_close . $tr_close;
        $usr_abert = $tr_open . $td_open . "Responsável abertura:" . $td_close . $td_open . $pendencia->userAbertura->nome . ' ' . $pendencia->userAbertura->sobrenome . $td_close . $tr_close;
        $usr_fechamento = $tr_open . $td_open . "Responsável fechamento:" . $td_close . $td_open . $pendencia->userFechamento->nome . ' ' . $pendencia->userFechamento->sobrenome . $td_close . $tr_close;
        $incidente = $tr_open . $td_open . "Incidente:" . $td_close . $td_open . $pendencia->incidente . $td_close . $tr_close;


        $msg_full = $msg_title . $msg_titulo . $msg_desc . $res_tec . $msg_abert . $usr_abert . $usr_fechamento . $incidente . $table_close;

        Bitrix::add_comment($pendencia->task, $msg_full);
    }
    public function close_task($id)
    {
        Bitrix::close_taks($id);
    }

    public function fecharPendencia($id, $hora)
    {
        $data = ["fim" => Date::convertFromHtmlToJS($hora)];
        $pendencias = $this->api->CallAPI("PATCH", "/pendencias/$id/close", $this->token, $data);
        $pendencia = $this->findOne($id);
        if ($pendencia->task != null and $pendencia->task != '') {
            $this->add_comment_task($id, $pendencia);
            $this->close_task($pendencia->task);
        }

        return $pendencias;
    }
}
