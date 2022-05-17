<?php

namespace Controller;

class Usuario
{
    private $api;
    private $token;

    public function __construct(){
        $this->api = new Api();
    }

    public function logar($login,$senha){
        $login = $login;
        $senha = $senha;

        $data = array(
            "email" => $login,
            "senha" => $senha
        );

        $token = $this->api->CallAPI_Unauthorized("POST","/users/login",$data);
        if(\property_exists($token, "data")){
            if(\property_exists($token->data, "acess_token")){
                $this->token = $token->data->acess_token;
                return true;
            }
        }
        return false;
    }

    public function refresh_token(){
        $data = array(
            "oldToken"=>$this->token
        );
        $token = $this->api->CallAPI_Unauthorized("PUT","/token/refresh",$data);
        
        if(\property_exists($token, "data")){
            if(\property_exists($token->data, "acess_token")){
                $this->token = $token->data->acess_token;
                return true;
            }
        }
        return false;
    }

    public function getMe(){
        
    }

    public function checkEmailIsUsed($email){

    }

    public function cadastrarUsuario($nome,$email,$senha){

    }
}