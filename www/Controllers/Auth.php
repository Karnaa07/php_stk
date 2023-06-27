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
            $user = $user->getOneWhere(["email" => $email]);
            
            if ($user && password_verify($password, $user->getPwd())) {
                // L'utilisateur est authentifié avec succès
                // Créez un token et enregistrez-le dans la session
                $user->generateToken();
                $_SESSION["user"] = $user->getId();
                $_SESSION["firstname"] = $user->getFirstname();
                $_SESSION["token"] = $user->getToken();
                $user->save();
                
                // Redirigez l'utilisateur vers la page d'accueil ou une autre page appropriée
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
        var_dump($_SESSION);
    
        // Supprimez le token de l'utilisateur de la session
        if (isset($_SESSION["user"])) {
            $user = new User();
            $user = $user->getOneWhere(["id" => $_SESSION["user"]]);
            $user->setToken(null); // Définir la valeur du token sur null ou une valeur vide selon votre structure de base de données
            $user->save(); // Enregistrer les modifications dans la base de données
            unset($_SESSION["user"]);
            unset($_SESSION["token"]);
            unset($_SESSION["firstname"]);
        }

        // Redirigez l'utilisateur vers la page de connexion ou une autre page appropriée
        header('Location: /login');
        exit;
    }
}