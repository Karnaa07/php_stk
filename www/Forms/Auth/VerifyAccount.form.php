<?php

namespace App\Forms\Auth;

use App\Core\Validator;

class VerifyAccount extends Validator
{
    public $method = "POST";
    protected array $config = [];

    public function getConfig(): array
    {
        $this->config = [
            "config" => [
                "method" => $this->method,
                "action" => "",
                "id" => "verify-account-form",
                "class" => "form",
                "enctype" => "",
                "submit" => "Envoyer",
                "reset" => "Annuler"
            ],
            "inputs" => [
                "email" => [
                    "id" => "verify-account-form-email",
                    "label" => "Email",
                    "class" => "form-input",
                    "placeholder" => "Votre email",
                    "type" => "email",
                    "error" => "Votre email est incorrect",
                    "required" => true
                ],
                "verification_code" => [
                    "id" => "verify-account-form-verification-code",
                    "label" => "Code de vérification",
                    "class" => "form-input",
                    "placeholder" => "Code de vérification",
                    "type" => "text",
                    "error" => "Veuillez entrer le code de vérification",
                    "required" => true
                ],
            ]
        ];

        return $this->config;
    }
}
