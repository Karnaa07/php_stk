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
                "content" => [
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
    
    // public function renderForm()
    // {
    //     $config = $this->getConfig();
    
    //     $html = '<form method="' . $config['config']['method'] . '" action="' . $config['config']['action'] . '" id="' . $config['config']['id'] . '" class="' . $config['config']['class'] . '">';
    
    //     foreach ($config['inputs'] as $name => $input) {
    //         $html .= '<div class="form-group">';
    //         $html .= '<label for="' . $input['id'] . '">' . ucfirst($name) . '</label>';
    
    //         if ($name === 'content') {
    //             $html .= '<textarea id="' . $input['id'] . '" class="' . $input['class'] . '" placeholder="' . $input['placeholder'] . '" name="' . $name . '" ' . ($input['required'] ? 'required' : '') . '"value="' . $this->getValue($name) . '" ' . '></textarea>';
    //         } else {
    //             $html .= '<input type="' . $input['type'] . '" id="' . $input['id'] . '" class="' . $input['class'] . '" placeholder="' . $input['placeholder'] . '" name="' . $name . '" value="' . $this->getValue($name) . '" ' . ($input['required'] ? 'required' : '') . '>';
    //         }
    
    //         $html .= '</div>';
    //     }
    
    //     $html .= '<button type="submit">' . $config['config']['submit'] . '</button>';
    //     $html .= '<button type="reset">' . $config['config']['reset'] . '</button>';
    //     $html .= '</form>';
    //     $html .= '<script src="https://cdn.tiny.cloud/1/9i4ty3dj7s5dyw4g2xbzg2u7udwf4mliqo7r71asossk42gb/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>';
    //     $html .= '<link rel="stylesheet" href="https://cdn.tiny.cloud/1/9i4ty3dj7s5dyw4g2xbzg2u7udwf4mliqo7r71asossk42gb/tinymce/5/skins/ui/oxide/content.min.css">';
    //     $html .= '<link rel="stylesheet" href="https://cdn.tiny.cloud/1/9i4ty3dj7s5dyw4g2xbzg2u7udwf4mliqo7r71asossk42gb/tinymce/5/skins/ui/oxide/skin.min.css">';
    //     $html .= '<script>
    //         window.addEventListener("DOMContentLoaded", function() {
    //             tinymce.init({
    //                 selector: "textarea",
    //                 plugins: "link image lists",
    //                 toolbar: "undo redo | formatselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | image link | removeformat",
    //             });
    //         });
    //     </script>';
        
    
    //     return $html;
    // }
    
    public function getValue($name)
    {
        // Vérifier si la valeur existe dans les données soumises
        if (isset($_POST[$name])) {
            return $_POST[$name];
        }
    
        return '';
    }
}
