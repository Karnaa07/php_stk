<?php
namespace App\Forms;
use App\Core\Validator;

class Change extends Validator
{
    public $method = "POST";
    protected array $config = [];
    public function getConfig(): array
    {
        $this->config = [
          "config"=>[
            "method"=>"POST",
            "action"=>"",
            "id"=>"change-form",
            "class"=>"form",
            "enctype" => "",
            "submit"=>"Changer de mot de passe",
            "reset" => "Annuler"
        ],
        'inputs'=>[
            "passwordOld"=>[
                "id"=>"pwdConfirmForm",
                "class"=>"inputForm",
                "placeholder"=>"Votre ancien mot de passe ...",
                "type"=>"password",
                "error"=>"Mauvais mot de passe",
                "required"=>true,
            ],
            "password"=>[
                "id"=>"pwdForm",
                "class"=>"inputForm",
                "placeholder"=>"Votre mot de passe ...",
                "type"=>"password",
                "error"=>"Votre mot de passe doit faire au min 8 caractères avec majuscule, minuscules et des chiffres",
                "required"=>true,
                ],
          ]
        ];
        return $this->config;        
    }
}