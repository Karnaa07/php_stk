<?php
namespace App\Forms;
use App\Core\Validator;

class CreatePages extends Validator
{
    public $method = "POST";
    protected array $config = [];

    public function getConfig(): array
    {
        $this->config = [
            "config" => [
                "method" => $this->method,
                "action" => "",
                "id" => "create-page",
                "class" => "form",
                "enctype" => "",
                "submit" => "Enregistrer",
                "reset" => "Annuler"
            ],
            "inputs" => [
                "author" => [
                    "id" => "create-page-form-author",
                    "label" => "Auteur",
                    "class" => "form-input",
                    "placeholder" => "Auteur",
                    "type" => "text",
                    "error" => "Le champ 'Auteur' est requis",
                    "required" => true
                ],
                "date" => [
                    "id" => "create-page-form-date",
                    "label" => "Date",
                    "class" => "form-input",
                    "placeholder" => "Date",
                    "type" => "date",
                    "error" => "Le champ 'Date' est requis",
                    "required" => true
                ],
                "title" => [
                    "id" => "create-page-form-title",
                    "label" => "Titre",
                    "class" => "form-input",
                    "placeholder" => "Titre",
                    "type" => "text",
                    "error" => "Le champ 'Titre' est requis",
                    "required" => true
                ],
                "theme" => [
                    "id" => "create-page-form-theme",
                    "label" => "Thème de l'article",
                    "class" => "form-input",
                    "placeholder" => "Thème de l'article",
                    "type" => "text",
                    "error" => "Le champ 'Thème de l'article' est requis",
                    "required" => true
                ],
                "color" => [
                    "id" => "create-page-form-color",
                    "label" => "Couleur",
                    "class" => "form-input",
                    "placeholder" => "Couleur",
                   // "value" => "#000000",
                    "type" => "color",
                    "error" => "Le champ 'Couleur' est requis",
                    "required" => true
                ],
                "content_page" => [
                    "id" => "create-page-form-content",
                    "label" => "Contenu",
                    "class" => "wysiwyg", // Ajout de la classe wysiwyg
                    "placeholder" => "Contenu",
                    "type" => "textarea",
                   // "value" => "",
                    "error" => "Le champ 'Contenu' est requis",
                    "required" => true
                    
                ]
            ]
        ];

        return $this->config;
    }
    
    // public function getValue($name)
    // {
    //     // Vérifier si la valeur existe dans les données soumises
    //     if (isset($_POST[$name])) {
    //         return $_POST[$name];
    //     }
    
    //     return '';
    // }
}
