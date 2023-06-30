<?php

namespace App\Core;

class AuthMiddleware
{
    public static function checkAuthenticated()
    {
        if (!isset($_SESSION["user"])) {
            // Redirigez l'utilisateur vers la page de connexion
            header('Location: /login');
            exit;
        }
    }
}