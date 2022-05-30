<?php

namespace Controller;

class Usuario
{
    private $api;
    public $token;
    public $id;

    public function __construct()
    {
        $this->api = new Api();
    }

    public function logar($login, $senha)
    {
        $login = $login;
        $senha = $senha;

        $data = array(
            "email" => $login,
            "senha" => $senha
        );

        $token = $this->api->CallAPI_Unauthorized("POST", "/users/login", $data);
        if (is_object($token) && \property_exists($token, "data")) {
            if (\property_exists($token->data, "acess_token")) {
                $this->token = $token->data->acess_token;
                $this->id = $token->data->user;
                return true;
            }
        }
        return false;
    }

    public function refresh_token()
    {
        $data = array(
            "oldToken" => $this->token
        );
        $token = $this->api->CallAPI_Unauthorized("POST", "/token/refresh", $data);

        if (is_object($token) && \property_exists($token, "data")) {
            if (\property_exists($token->data, "acess_token")) {
                $this->token = $token->data->acess_token;
                return true;
            }
        }
        return false;
    }

    public function getMe()
    {
        //$usuario = $this->api->CallAPI("GET", "/users/$id", $this->token);
        //return $usuario->data;
    }

    public function checkEmailIsUsed($email)
    {
    }

    public function cadastrarUsuario($nome, $sobrenome, $email, $senha)
    {
        $data = [
            "nome" => $nome,
            "sobrenome" => $sobrenome,
            "email" => $email,
            "senha" => $senha
        ];
        $usuario = $this->api->CallAPI("POST", "/users", $this->token, $data);
        return $usuario;
    }

    public function editarUsuario($id, $POST)
    {
        $data = [
            "nome" => $POST['nome'],
            "sobrenome" => $POST['sobrenome'],
            "email" => $POST['email'],
            "btv_usuario" => $POST['btv_usuario'],
            "btv_senha" => $POST['btv_senha'],
            "id_bitrix" => (int) $POST['id_bitrix']
        ];
        $usuario = $this->api->CallAPI("PATCH", "/users/$id", $this->token, $data);
        return $usuario;
    }

    public function desativarUsuario($id)
    {
        $data = [
            "ativo" => false
        ];
        $usuario = $this->api->CallAPI("DELETE", "/users/$id", $this->token, $data);
        return $usuario;
    }

    public function ativarUsuario($id)
    {
        $data = [
            "ativo" => true
        ];
        $usuario = $this->api->CallAPI("PATCH", "/users/$id", $this->token, $data);
        return $usuario;
    }

    public function changePassword($id, $senha)
    {
        $data = [
            "senha" => $senha
        ];
        $usuario = $this->api->CallAPI("PATCH", "/users/$id", $this->token, $data);
        return $usuario;
    }

    public function get_all()
    {
        $usuarios = $this->api->CallAPI("GET", "/users/", $this->token);
        return $usuarios->data;
    }

    public function get_one($id)
    {
        $usuarios = $this->api->CallAPI("GET", "/users/$id", $this->token);
        return $usuarios->data;
    }
}
