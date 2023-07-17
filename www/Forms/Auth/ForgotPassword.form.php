<?php

namespace App\Forms\Auth;

use App\Core\Validator;

class ForgotPassword extends Validator
{
  public $method = "POST";
  protected array $config = [];

  public function getConfig(): array
  {
    $this->config = [
      "config" => [
        "method" => $this->method,
        "action" => "",
        "id" => "forgot-password-form",
        "class" => "form",
        "enctype" => "",
        "submit" => "Réinitialiser le mot de passe",
        "reset" => "Annuler"
      ],
      "inputs" => [
        "email" => [
          "id" => "forgot-password-form-email",
          "label" => "Email",
          "class" => "form-input",
          "placeholder" => "Votre email",
          "type" => "email",
          "error" => "Veuillez entrer un email valide",
          "required" => true
        ],
        "verification_code" => [ // New field for verification code
          "id" => "forgot-password-form-verification-code",
          "label" => "Code de vérification",
          "class" => "form-input",
          "placeholder" => "Votre code de vérification",
          "type" => "text",
          "error" => "Veuillez entrer le code de vérification",
          "required" => true
        ],
        "new_password" => [
          "id" => "forgot-password-form-new-password",
          "label" => "Nouveau mot de passe",
          "class" => "form-input",
          "placeholder" => "Votre nouveau mot de passe",
          "type" => "password",
          "error" => "Votre mot de passe doit contenir au moins 8 caractères avec des majuscules, des minuscules et des chiffres",
          "required" => true
        ],
        "confirm_password" => [
          "id" => "forgot-password-form-confirm-password",
          "label" => "Confirmer le mot de passe",
          "class" => "form-input",
          "placeholder" => "Confirmez votre nouveau mot de passe",
          "type" => "password",
          "error" => "Les mots de passe ne correspondent pas",
          "required" => true
        ],
      ]
    ];

    return $this->config;
  }
}
