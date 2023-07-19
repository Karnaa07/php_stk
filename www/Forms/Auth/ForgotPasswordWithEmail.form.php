<?php

namespace App\Forms\Auth;

use App\Core\Validator;

class ForgotPasswordWithEmail extends Validator
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
        "submit" => "Envoyez le mail de réinitialisation",
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
      ]
    ];

    return $this->config;
  }
}
