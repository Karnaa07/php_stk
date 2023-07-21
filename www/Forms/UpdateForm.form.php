<?php

namespace App\Forms;

use App\Core\Validator;

class UpdateForm extends Validator
{
    public $method = "POST";
    protected array $config = [];

    public function getConfig(): array
    {
        $this->config = [
            "config" => [
                "method" => $this->method,
                "action" => "",
                "id" => "udape-form",
                "class" => "form",
                "enctype" => "",
                "submit" => "Modifier",
                "reset" => "Annuler",
            ],
            "inputs" => [
                "firstname" => [
                    "id" => "udape-form-firstname",
                    "label" => "Prénom",
                    "class" => "form-input",
                    "placeholder" => "Votre prénom",
                    "type" => "text",
                    "error" => "Votre prénom doit faire entre 2 et 60 caractères",
                    "min" => 2,
                    "max" => 60,
                    "required" => true
                ],
                "lastname" => [
                    "id" => "udape-form-lastname",
                    "label" => "Nom",
                    "class" => "form-input",
                    "placeholder" => "Votre nom",
                    "type" => "text",
                    "error" => "Votre nom doit faire entre 2 et 120 caractères",
                    "min" => 2,
                    "max" => 120,
                    "required" => true
                ],
                "email" => [
                    "id" => "udape-form-email",
                    "label" => "Email",
                    "class" => "form-input",
                    "placeholder" => "Votre email",
                    "type" => "email",
                    "error" => "Votre email est incorrect",
                    "required" => true
                ],
                "role" => [
                    "id" => "udape-form-role",
                    "label" => "Role",
                    "class" => "form-input",
                    "placeholder" => "Votre role",
                    "type" => "select",
                    "error" => "Votre role est incorrect",
                    "required" => true,
                    "options" => [ // Ajout des options pour la liste déroulante
                        "1" => "1",
                        "2" => "2"
                    ]
                ],
            ]
        ];

        return $this->config;
    }

    public function getValue($name)
    {
        // Vérifier si la valeur existe dans les données soumises
        if (isset($_POST[$name])) {
            return $_POST[$name];
        }

        return '';
    }
}
