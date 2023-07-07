<?php
namespace App\Forms;
use App\Core\Validator;

class CreatePageForm extends Validator
{
    public $method = "POST";
    protected array $config = [];

    public function getConfig(): array
    {
        $this->config = [
            "config" => [
                "method" => $this->method,
                "action" => "/pages/store", // Ajoutez l'action appropriée
                "id" => "create-page-form",
                "class" => "form",
                "enctype" => "",
                "submit" => "Enregistrer",
                "reset" => "Annuler"
            ],
            "inputs" => [
                "author" => [
                    "id" => "create-page-form-author",
                    "class" => "form-input",
                    "placeholder" => "Auteur",
                    "type" => "text",
                    "error" => "Le champ 'Auteur' est requis",
                    "required" => true
                ],
                "date" => [
                    "id" => "create-page-form-date",
                    "class" => "form-input",
                    "placeholder" => "Date",
                    "type" => "date",
                    "error" => "Le champ 'Date' est requis",
                    "required" => true
                ],
                "title" => [
                    "id" => "create-page-form-title",
                    "class" => "form-input",
                    "placeholder" => "Titre",
                    "type" => "text",
                    "error" => "Le champ 'Titre' est requis",
                    "required" => true
                ],
                "theme" => [
                    "id" => "create-page-form-theme",
                    "class" => "form-input",
                    "placeholder" => "Thème de l'article",
                    "type" => "text",
                    "error" => "Le champ 'Thème de l'article' est requis",
                    "required" => true
                ],
                "color" => [
                    "id" => "create-page-form-color",
                    "class" => "form-input",
                    "placeholder" => "Couleur",
                    "type" => "color",
                    "error" => "Le champ 'Couleur' est requis",
                    "required" => true
                ],
                "content" => [
                    "id" => "create-page-form-content",
                    "class" => "form-input",
                    "placeholder" => "Contenu",
                    "type" => "textarea",
                    "error" => "Le champ 'Contenu' est requis",
                    "required" => true
                ]
            ]
        ];

        return $this->config;
    }
    public function renderForm()
    {
        $config = $this->getConfig();
    
        $html = '<form method="' . $config['config']['method'] . '" action="' . $config['config']['action'] . '" id="' . $config['config']['id'] . '" class="' . $config['config']['class'] . '">';
    
        foreach ($config['inputs'] as $name => $input) {
            $html .= '<div class="form-group">';
            $html .= '<label for="' . $input['id'] . '">' . ucfirst($name) . '</label>';
    
            if (isset($input['type'])) {
                $html .= '<input type="' . $input['type'] . '" id="' . $input['id'] . '" class="' . $input['class'] . '" placeholder="' . $input['placeholder'] . '" name="' . $name . '" value="' . $this->getValue($name) . '" ' . ($input['required'] ? 'required' : '') . '>';
            } else {
                // Gérer le cas où la clé 'type' n'est pas définie
            }
    
            $html .= '</div>';
        }
    
        $html .= '<button type="submit">' . $config['config']['submit'] . '</button>';
        $html .= '<button type="reset">' . $config['config']['reset'] . '</button>';
        $html .= '</form>';
    
        return $html;
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
