<?php
namespace App\Forms;

use App\Core\Validator;

class CreatePage extends Validator
{
    public $method = "POST";
    protected array $config = [];

    public function getConfig(): array
    {
        $this->config = [
            "config" => [
                "method" => $this->method,
                "action" => "",
                "id" => "create-page-form",
                "class" => "form",
                "enctype" => "",
                "submit" => "  Créer la page",
                "reset" => "Annuler  "
            ],
            "inputs" => [
                "author" => [
                    "id" => "create-page-form-author",
                    "label" => "Auteur",
                    "class" => "form-input",
                    "placeholder" => "Votre nom",
                    "type" => "text",
                    "error" => "Le nom de l'auteur est requis",
                    "required" => true
                ],
                "title" => [
                    "id" => "create-page-form-title",
                    "label" => "Titre",
                    "class" => "form-input",
                    "placeholder" => "Votre titre",
                    "type" => "text",
                    "error" => "Votre titre doit faire entre 2 et 120 caractères",
                    "min" => 2,
                    "max" => 120,
                    "required" => true
                ],
                "theme" => [
                    "id" => "create-page-form-theme",
                    "label" => "Thème",
                    "class" => "form-input",
                    "placeholder" => "Votre thème",
                    "type" => "text",
                    "error" => "Votre thème est incorrect",
                    "required" => true
                ],
                "date" => [
                    "id" => "create-page-form-date",
                    "label" => "Date",
                    "class" => "form-input",
                    "placeholder" => "YYYY-MM-DD",
                    "type" => "date",
                    "error" => "La date est incorrecte",
                    "required" => true
                ],
                "color" => [
                    "id" => "create-page-form-color",
                    "label" => "Couleur",
                    "class" => "form-input",
                    "placeholder" => "#FFFFFF",
                    "type" => "color",
                    "error" => "La couleur est incorrecte",
                    "required" => true
                ],
                "content" => [
                    "id" => "create-page-form-content",
                    "label" => "Contenu",
                    "class" => "form-input wysiwyg",
                    "placeholder" => "Votre contenu",
                    "type" => "textarea",
                    "error" => "Le contenu ne peut pas être vide",
                    "required" => true
                ],
            ]
        ];
        return $this->config;
    }
}
