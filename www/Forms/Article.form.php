<?php
namespace App\Forms;
use App\Core\Validator;

class Article extends Validator
{
    public $method = "POST";
    protected array $config = [];
    public function getConfig(): array
    {
        $this->config = [
            "config" => [
                "method" => $this->method,
                "action" => "",
                "id" => "create-article-form",
                "class" => "form",
                "enctype" => "",
                "submit" => "Créer l'article",
                "reset" => "Annuler"
            ],
            "inputs" => [
                "title" => [
                    "id" => "create-article-form-title",
                    "label" => "Titre",
                    "class" => "form-input",
                    "placeholder" => "Entrez le titre de l'article",
                    "type" => "text",
                    "error" => "Le titre est requis",
                    "required" => true
                ],
                "slug" => [
                    "id" => "create-article-form-slug",
                    "label" => "Slug",
                    "class" => "form-input",
                    "placeholder" => "Entrez le slug de l'article",
                    "type" => "text",
                    "error" => "Le slug est requis",
                    "required" => true
                ],
                "content" => [
                    "id" => "create-article-form-content",
                    "label" => "Contenu",
                    "class" => "form-textarea",
                    "placeholder" => "Entrez le contenu de l'article",
                    "type" => "text",
                    "error" => "",
                    "required" => false
                ],
                "imageUrl" => [
                    "id" => "create-article-form-imageUrl",
                    "label" => "URL de l'image",
                    "class" => "form-input",
                    "placeholder" => "Entrez l'URL de l'image de l'article",
                    "type" => "text",
                    "error" => "",
                    "required" => false
                ]
            ]
        ];

        return $this->config;
    }
}
