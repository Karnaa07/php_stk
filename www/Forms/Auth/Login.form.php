<?php

namespace App\Forms\Auth;

use App\Core\Validator;

class Login extends Validator
{
    public $method = "POST";
    protected array $config = [];
    public function getConfig(): array
    {

        $this->config = [
            "config" => [
                "method" => $this->method,
                "action" => "",
                "id" => "login-form",
                "class" => "form",
                "enctype" => "",
                "submit" => "Se connecter",
                "not-register" => "Inscription",
                "reset" => "Annuler"
            ],
            "inputs" => [
                "email" => [
                    "id" => "register-form-email",
                    "label" => "Email",
                    "class" => "form-input",
                    "placeholder" => "Votre email",
                    "type" => "email",
                    "error" => "Votre email est incorrect",
                    "required" => true
                ],
                "pwd" => [
                    "id" => "register-form-pwd",
                    "label" => "Mot de passe",
                    "class" => "form-input",
                    "placeholder" => "Votre mot de passe",
                    "type" => "password",
                    "error" => "Votre mot de passe doit faire au minimum 8 caractères avec minuscules, majuscules et chiffres",
                    "required" => true
                ]
            ]
        ];
        return $this->config;
    }
}
