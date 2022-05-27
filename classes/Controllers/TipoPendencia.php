<?php

namespace Controller;

class TipoPendencia
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
        $pendencias = $this->api->CallAPI("GET", "/tipo-pendencias", $this->token);
        return $pendencias->data;
    }

    public function findOne($id)
    {
        $pendencias = $this->api->CallAPI("GET", "/tipo-pendencias/$id", $this->token);
        return $pendencias->data;
    }

    public function addTipoPendencia($tipo, $severidade)
    {
        $data = [
            "tipo" => $tipo,
            "severidade" => $severidade
        ];
        $tipo = $this->api->CallAPI("POST", "/tipo-pendencias", $this->token, $data);
        return $tipo;
    }
    public function editeTipoPendencia($id, $tipo, $severidade)
    {
        $data = [
            "tipo" => $tipo,
            "severidade" => $severidade
        ];
        $tipo = $this->api->CallAPI("PATCH", "/tipo-pendencias/$id", $this->token, $data);
        return $tipo;
    }
    public function deleteTipoPendencia($id)
    {
        $pendencias = $this->api->CallAPI("DELETE", "/tipo-pendencias/$id", $this->token);
        return $pendencias;
    }
}
