<?php
namespace App\Forms;
use App\Core\Validator;

class Register extends Validator
{
    public $method = "POST";
    protected array $config = [];
    public function getConfig(): array
    {
        $this->config = [
                "config"=>[
                    "method"=>$this->method,
                    "action"=>"",
                    "id"=>"register-form",
                    "class"=>"form",
                    "enctype"=>"",
                    "submit"=>"Nous rejoindre",
                    "reset"=>"Annuler"
                ],
                "inputs"=>[
                    "firstname"=>[
                        "id"=>"register-form-firstname",
                        "label"=>"Prénom",
                        "class"=>"form-input",
                        "placeholder"=>"Votre prénom",
                        "type"=>"text",
                        "error"=>"Votre prénom doit faire entre 2 et 60 caractères",
                        "min"=>2,
                        "max"=>60,
                        "required"=>true
                    ],
                    "lastname"=>[
                        "id"=>"register-form-lastname",
                        "label"=>"Nom",
                        "class"=>"form-input",
                        "placeholder"=>"Votre nom",
                        "type"=>"text",
                        "error"=>"Votre nom doit faire entre 2 et 120 caractères",
                        "min"=>2,
                        "max"=>120,
                        "required"=>true
                    ],
                    "email"=>[
                        "id"=>"register-form-email",
                        "label"=>"Email",
                        "class"=>"form-input",
                        "placeholder"=>"Votre email",
                        "type"=>"email",
                        "error"=>"Votre email est incorrect",
                        "required"=>true
                    ],
                    "pwd"=>[
                        "id"=>"register-form-pwd",
                        "label"=>"Mot de passe",
                        "class"=>"form-input",
                        "placeholder"=>"Votre mot de passe",
                        "type"=>"password",
                        "error"=>"Votre mot de passe doit faire au minimum 8 caractères avec minuscules, majuscules et chiffres",
                        "required"=>true
                    ],
                    "pwdConfirm"=>[
                        "id"=>"register-form-pwd-confirm",
                        "label"=>"Confirmation",
                        "class"=>"form-input",
                        "placeholder"=>"Confirmation",
                        "type"=>"password",
                        "error"=>"Votre mot de passe de confirmation ne correspond pas",
                        "required"=>true,
                        "confirm"=>"pwd"
                    ],
                ]
        ];
        return $this->config;
    }
    
}