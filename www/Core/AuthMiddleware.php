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

    public static function assignPseudoToView(View $view)
    {
        if (isset($_SESSION["firstname"])) {
            $pseudo = $_SESSION["firstname"];
            $view->assign("pseudo", $pseudo);
        }
    }

    public static function checkAdminRole()
    {
        $roleId = $_SESSION["role_id"]; // Récupérez directement le rôle ID de $_SESSION["user"]

        if ($roleId !== 1) { // Vérifiez si le rôle de l'utilisateur n'est pas égal à l'ID de l'administrateur

            // Redirigez l'utilisateur vers une page d'erreur ou effectuez une autre action appropriée
            header('Location: /'); // Exemple de redirection vers une page d'erreur
            exit;
        }
    }

}
