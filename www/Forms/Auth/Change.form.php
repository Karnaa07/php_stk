<?php

namespace App\Forms\Auth;

use App\Core\Validator;

class Change extends Validator
{
    public $method = "POST";
    protected array $config = [];
    public function getConfig(): array
    {
        $this->config = [
            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "change-form",
                "class" => "form",
                "enctype" => "",
                "submit" => "Changer de mot de passe",
                "reset" => "Annuler"
            ],
            'inputs' => [
                "passwordOld" => [
                    "id" => "pwdConfirmForm",
                    "label" => "Votre ancien mot de passe",
                    "class" => "form-input",
                    "placeholder" => "Votre ancien mot de passe ...",
                    "type" => "password",
                    "error" => "Mauvais mot de passe",
                    "required" => true,
                ],
                "password" => [
                    "id" => "pwdForm",
                    "label" => "Votre nouveau mot de passe",
                    "class" => "form-input",
                    "placeholder" => "Votre mot de passe ...",
                    "type" => "password",
                    "error" => "Votre mot de passe doit faire au min 8 caractères avec majuscule, minuscules et des chiffres",
                    "required" => true,
                ],
            ]
        ];
        return $this->config;
    }
}
