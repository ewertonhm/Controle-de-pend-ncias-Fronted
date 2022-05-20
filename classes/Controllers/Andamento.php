<?php

namespace Controller;

class Andamento
{
    private $api;
    private $token;

    public function __construct($token)
    {
        $this->api = new Api();
        $this->token = $token;
    }

    public function get_all($pendendia_id)
    {
        $andamentos = $this->api->CallAPI("GET", "/pendencias/" . $pendendia_id . "/andamentos", $this->token);
        $andamentos_full = [];


        if (isset($andamentos->data) and count($andamentos->data)) {
            foreach ($andamentos->data as $andamento) {
                $andamento_full = $this->api->CallAPI("GET", "/andamentos/" . $andamento->id, $this->token);
                array_push($andamentos_full, $andamento_full->data);
            }
        }
        return $andamentos_full;
    }
}
