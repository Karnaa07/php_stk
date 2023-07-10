<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Validator;
use App\Core\AuthMiddleware;
use App\Core\Mail;
use App\Forms\Register;
use App\Forms\Login;
use App\Forms\Change;
use App\Models\User;


class Auth
{

    public function login(): void
    {
        if (isset($_SESSION["user"])) {
            // Redirigez l'utilisateur vers le tableau de bord
            header('Location: /dashboard');
            exit;
        }

        $form = new Login();
        $view = new View("Auth/login", "auth");
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
                $_SESSION["role_id"] = $user->getRoleId();
                $user->save();

                // Redirigez l'utilisateur vers la page d'accueil ou une autre page appropriée
                header('Location: /');
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
        $view = new View("Auth/register", "auth");
        $view->assign("form", $form->getConfig());

        // Formulaire soumis et valide ?
        if ($form->isSubmited() && $form->isValid()) {
            $user = new User();
            $mail = new Mail();
            $verif_code = substr(number_format(time() * rand(),0,'',''),0,6);
            $mail->send_mail("waveflow278@gmail.com", $verif_code);
            $user->setFirstname($_POST["firstname"]);
            $user->setLastname($_POST["lastname"]);
            $user->setEmail($_POST["email"]);
            $user->setPwd($_POST["pwd"]);
            $user->setRoleId(2);
            $user->setCountry("FR");
            $user->setVerifCode($verif_code);

            // Vérifier si l'email existe déjà dans la base de données
            $email = $_POST["email"];
            $existingUser = $user->getOneWhere(["email" => $email]);

            if (!Validator::checkEmail($_POST["email"])) {
                echo "L'adresse email n'est pas valide.";
                return;
            }
            
            if ($existingUser) {
                echo "Cet email est déjà utilisé !";
                return;
            }
            
            if (!Validator::checkPassword($_POST["pwd"])) {
                echo "Votre mot de passe doit faire au minimum 8 caractères avec des minuscules, des majuscules et des chiffres.";
                return;
            }
            
            if ($_POST["pwd"] !== $_POST["pwdConfirm"]) {
                echo "Les mots de passe ne correspondent pas.";
                return;
            }
            
            // Si toutes les conditions sont vérifiées, enregistrez l'utilisateur et affichez un message de succès

            $user->save();
            echo "Votre compte a bien été créé. Vous allez être redirigé vers la page de connexion.";
            header('Refresh: 2; URL=/login');
            
        }

        $view->assign("formErrors", $form->errors);
    }


    public function logout(): void
    {

        AuthMiddleware::checkAuthenticated();

        // Supprimez le token de l'utilisateur de la session
        if (isset($_SESSION["user"])) {
            $user = new User();
            $user = $user->getOneWhere(["id" => $_SESSION["user"]]);
            $user->setToken(null); // Définir la valeur du token sur null ou une valeur vide selon votre structure de base de données
            $user->save(); // Enregistrer les modifications dans la base de données
            unset($_SESSION["user"]);
            unset($_SESSION["token"]);
            unset($_SESSION["firstname"]);
            unset($_SESSION["role_id"]);
        }

        // Redirigez l'utilisateur vers la page de connexion ou une autre page appropriée
        header('Location: /');
        exit;
    }

    public function change(): void
    {
        // Vérifiez si l'utilisateur est connecté
        if (!isset($_SESSION["user"])) {
            echo "Vous devez être connecté pour changer votre mot de passe.";
            return;
        }

        $form = new Change();
        $view = new View("Auth/change_password", "auth");
        $view->assign("form", $form->getConfig());

        // Formulaire soumis et valide ?
        if ($form->isSubmited() && $form->isValid()) {
            $user = new User();
            $userId = $_SESSION["user"];
            $user = $user->getOneWhere(["id" => $userId]);

            // Vérification de l'ancien mot de passe
            $oldPassword = $_POST["passwordOld"];
            if (!password_verify($oldPassword, $user->getPwd())) {
                echo "L'ancien mot de passe est incorrect.";
                return;
            }

            // Vérification du nouveau mot de passe sécurisé
            $newPassword = $_POST["password"];
            if (!Validator::checkPassword($newPassword)) {
                echo "Le nouveau mot de passe ne respecte pas les critères de sécurité.";
                return;
            }

            // Modification du mot de passe
            $user->setPwd($newPassword);
            $user->save();
            echo"Votre mot de passe à bien été modifié, vous allez être redirigé vers la page de connexion";
            header('Refresh: 2; URL=/login');
        }

        $view->assign("formErrors", $form->errors);
    }



}
