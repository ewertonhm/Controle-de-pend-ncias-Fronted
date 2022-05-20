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
}
