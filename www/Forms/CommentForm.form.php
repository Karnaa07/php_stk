<?php
namespace App\Forms;

use App\Core\Validator;

class CommentForm extends Validator
{
    public $method = "POST";
    protected array $config = [];

    protected ?int $articleId; // Ajoutez une propriété pour stocker l'ID de l'article

    // Ajoutez un constructeur pour recevoir l'ID de l'article en paramètre
    public function __construct(?int $articleId = null)
    {
        $this->articleId = $articleId;
    }
    // La méthode getConfig() retourne le tableau de configuration du formulaire
    public function getConfig(): array
    {
        $this->config = [
            "config" => [
                "method" => $this->method,
                "action" => "",
                "id" => "comment-form",
                "class" => "form",
                "enctype" => "",
                "submit" => "Soumettre",
                "reset" => "Annuler",
                "not-register" => ""
            ],
            "inputs" => [ 
                "nom" => [
                    "label" => "Nom",
                    "id" => "comment-form-nom",
                    "class" => "form-input",
                    "placeholder" => "Votre nom",
                    "type" => "text",
                    "error" => "",
                    "required" => true
                ],
                "email" => [
                    "label" => "Email",
                    "id" => "comment-form-email",
                    "class" => "form-input",
                    "placeholder" => "Votre email",
                    "type" => "email",
                    "error" => "Veuillez entrer une adresse email valide",
                    "required" => true
                ],
                "commentaire" => [
                    "label" => "Commentaire",
                    "id" => "comment-form-commentaire",
                    "class" => "form-input-textarea",
                    "placeholder" => "Votre commentaire",
                    "type" => "textarea",
                    "error" => "",
                    "required" => true
                ],
            ],
            "back" => [
                "class" => "form-submit",
                "value" => "Retour"
            ]
        ];
        return $this->config;
    }
}
