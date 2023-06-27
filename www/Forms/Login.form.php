<?php
namespace App\Forms;
use App\Core\Validator;

class Login extends Validator
{
    public $method = "POST";
    protected array $config = [];
    public function getConfig(): array
    {
        $this->config = [
                "config"=>[
                    "method"=>$this->method,
                    "action"=>"",
                    "id"=>"login-form",
                    "class"=>"form",
                    "enctype"=>"",
                    "submit"=>"Se connecter",
                    "reset"=>"Annuler"
                ],
                "inputs"=>[
                    "email"=>[
                        "id"=>"register-form-email",
                        "class"=>"form-input",
                        "placeholder"=>"Votre email",
                        "type"=>"email",
                        "error"=>"Votre email est incorrect",
                        "required"=>true
                    ],
                    "pwd"=>[
                        "id"=>"register-form-pwd",
                        "class"=>"form-input",
                        "placeholder"=>"Votre mot de passe",
                        "type"=>"password",
                        "error"=>"Votre mot de passe doit faire au minimum 8 caractères avec minuscules, majuscules et chiffres",
                        "required"=>true
                    ],
                ]
        ];
        return $this->config;
    }
}