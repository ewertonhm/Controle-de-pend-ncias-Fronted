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
    public function editPendencia(
        $id,
        $tipoPendenciaId,
        $titulo,
        $descricao,
        $inicio,
        $responsavel,
        $previsao,
        $task,
        $incidente
    ) {
        $data = [
            "tipoPendenciaId" => $tipoPendenciaId,
            "titulo" => $titulo,
            "descricao" => $descricao,
            "inicio" => $inicio,
            "responsavel" => $responsavel,
            "previsao" => $previsao,
            "task" => $task,
            "incidente" => $incidente
        ];
        $pendencias = $this->api->CallAPI("PATCH", "/pendencias", $this->token, $data);
        // talvez não funcione, falta testar o patch
        return $pendencias;
    }
    public function fecharPendencia($id, $hora)
    {
        $data = ["fim" => Date::convertFromHtmlToJS($hora)];
        $pendencias = $this->api->CallAPI("PATCH", "/pendencias/$id/close", $this->token, $data);

        return $pendencias;
    }
}
