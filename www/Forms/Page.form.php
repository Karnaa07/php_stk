<?php

namespace App\Forms;

use App\Core\Validator;

class Page extends Validator
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
                "submit" => "Créer la page",
                "reset" => "Annuler"
            ],
            "inputs" => [
                "title" => [
                    "id" => "create-page-form-title",
                    "label" => "Titre",
                    "class" => "form-input",
                    "placeholder" => "Entrez le titre de la page",
                    "type" => "text",
                    "error" => "Le titre est requis",
                    "required" => true
                ],
                "slug" => [
                    "id" => "create-page-form-slug",
                    "label" => "Slug",
                    "class" => "form-input",
                    "placeholder" => "Entrez le slug de la page",
                    "type" => "text",
                    "error" => "Le slug est requis",
                    "required" => true
                ],
                "content" => [
                    "id" => "create-page-form-content",
                    "label" => "Contenu",
                    "class" => "form-textarea",
                    "placeholder" => "Entrez le contenu de la page",
                    "error" => "",
                    "required" => false
                ]
            ]
        ];

        return $this->config;
    }
}
