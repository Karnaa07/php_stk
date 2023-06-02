<?php

namespace App\Controllers;

use App\Core\View;
use App\Forms\Register;
use App\Forms\Login;
use App\Models\User;

class Auth
{
    public function login(): void
{
    $form = new Login();
    $view = new View("Auth/login", "front");
    $view->assign("form", $form->getConfig());

    // Formulaire soumis et valide
    if ($form->isSubmited() && $form->isValid()) {
        $user = new User();
        
        // Vérification des informations d'identification
        $email = $_POST["email"];
        $password = $_POST["pwd"];
        $authenticated = $user->authenticate($email, $password);
        
        if ($authenticated) {
            // L'utilisateur est authentifié avec succès
            // Créez une session pour l'utilisateur et redirigez-le vers la page d'accueil
            $_SESSION["user"] = $user;
            header('Location: /dashboard');
            exit;
        } else {
            // Les informations d'identification sont incorrectes
            echo("Mot de passe ou email incorrect");
        }
    }
    $view->assign("formErrors", $form->errors);
}


    public function register(): void
    {
        $form = new Register();
        $view = new View("Auth/register", "front");
        $view->assign("form", $form->getConfig());

        //Form validé ? et correct ?
        if($form->isSubmited() && $form->isValid()){
            $user = new User();
            $user->setFirstname($_POST["firstname"]);
            $user->setLastname($_POST["lastname"]);
            $user->setEmail($_POST["email"]);
            $user->setPwd($_POST["pwd"]);
            $user->setCountry("FR");
            $user->save();
        }
        $view->assign("formErrors", $form->errors);


    }

    public function logout(): void
    {
        echo "Page de déconnexion";
    }

}