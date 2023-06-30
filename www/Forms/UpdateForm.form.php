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
                "reset" => "Annuler"
            ],
            "inputs" => [
                "firstname" => [
                    "id" => "udape-form-firstname",
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
                    "class" => "form-input",
                    "placeholder" => "Votre email",
                    "type" => "email",
                    "error" => "Votre email est incorrect",
                    "required" => true
                ],
                "pwd" => [
                    "id" => "udape-form-pwd",
                    "class" => "form-input",
                    "placeholder" => "Votre mot de passe",
                    "type" => "password",
                    "error" => "Votre mot de passe doit faire au minimum 8 caractères avec minuscules, majuscules et chiffres",
                    "required" => true
                ],
                "pwdConfirm" => [
                    "id" => "udape-form-pwd-confirm",
                    "class" => "form-input",
                    "placeholder" => "Confirmation",
                    "type" => "password",
                    "error" => "Votre mot de passe de confirmation ne correspond pas",
                    "required" => true,
                    "confirm" => "pwd"
                ],
                // "country" => [
                //     "id" => "udape-form-country",
                //     "class" => "form-select",
                //     "placeholder" => "Votre pays",
                //     "options" => [
                //         "FR" => "France",
                //         "US" => "United States",
                //         "CA" => "Canada",
                //         // Ajoutez d'autres options de pays si nécessaire
                //     ],
                //     "error" => "Veuillez sélectionner votre pays",
                //     "required" => true
                // ],
            ]
        ];

        return $this->config;
    }
    public function validate(array $data): array
    {
        $errors = [];

        // Valider les champs du formulaire
        // Par exemple, valider le champ "firstname"
        if (empty($data['firstname'])) {
            $errors['firstname'] = "Le prénom est requis.";
        } elseif (strlen($data['firstname']) < 2 || strlen($data['firstname']) > 60) {
            $errors['firstname'] = "Le prénom doit faire entre 2 et 60 caractères.";
        }

        // Valider les autres champs du formulaire de la même manière

        $isValid = empty($errors);

        return [
            'isValid' => $isValid,
            'errors' => $errors
        ];
    }

    public function renderForm()
    {
        $config = $this->getConfig();

        // Afficher le formulaire avec les champs et les attributs configurés
        echo '<form method="' . $config['config']['method'] . '" action="' . $config['config']['action'] . '" id="' . $config['config']['id'] . '" class="' . $config['config']['class'] . '">';

        // Afficher les champs du formulaire
        foreach ($config['inputs'] as $name => $input) {
            echo '<div class="form-group">';
            echo '<label for="' . $input['id'] . '">' . ucfirst($name) . '</label>';
            if (isset($input['type'])) {
            echo '<input type="' . $input['type'] . '" id="' . $input['id'] . '" class="' . $input['class'] . '" placeholder="' . $input['placeholder'] . '" name="' . $name . '" value="' . $this->getValue($name) . '" ' . ($input['required'] ? 'required' : '') . '>';
            } else {
                // Gérer le cas où la clé 'type' n'est pas définie
            }echo '</div>';
        }

        echo '<button type="submit">' . $config['config']['submit'] . '</button>';
        echo '<button type="reset">' . $config['config']['reset'] . '</button>';

        echo '</form>';
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
