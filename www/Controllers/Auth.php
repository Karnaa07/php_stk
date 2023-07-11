<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Validator;
use App\Core\AuthMiddleware;
use App\Core\Mail;
use App\Forms\Register;
use App\Forms\Login;
use App\Forms\Change;
use App\Forms\VerifyAccount;
use App\Models\User;


class Auth
{
    public function login(): void
    {
        if (isset($_SESSION["user"])) { //Si je suis déja connecté je suis redirigé vers la page d'accueil
            header('Location: /');
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
                // Vérification du statut de l'utilisateur
                if ($user->getStatus() == 1) {
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
                    // Le statut de l'utilisateur n'est pas activé
                    echo "Votre compte n'est pas activé. Veuillez vérifier votre e-mail pour activer votre compte.";
                }
            } else {
                // Les informations d'identification sont incorrectes
                echo "Mot de passe ou e-mail incorrect";
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
            $verif_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
            $user->setFirstname($_POST["firstname"]);
            $user->setLastname($_POST["lastname"]);
            $user->setEmail($_POST["email"]);
            $user->setPwd($_POST["pwd"]);
            $user->setRoleId(2);
            $user->setCountry("FR");
            $user->setVerifCode($verif_code);
            $user->setDateInserted(date('Y-m-d H:i:s'));

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
            $mail->verif_account($email, $verif_code);
            echo "Votre compte a bien été créé. Veuillez vérifier votre email pour activer votre compte.";
            // header('Refresh: 2; URL=/login');
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
            echo "Votre mot de passe à bien été modifié, vous allez être redirigé vers la page de connexion";
            header('Refresh: 2; URL=/login');
        }

        $view->assign("formErrors", $form->errors);
    }

    public function verifyAccount(): void
    {
        $form = new VerifyAccount();
        $view = new View("Auth/verify_account", "auth");
        $view->assign("form", $form->getConfig());

        // Traitement du formulaire soumis
        if ($form->isSubmited() && $form->isValid()) {
            $verificationCode = $_POST["verification_code"];
            $email = $_POST["email"]; // Récupérez l'e-mail de l'utilisateur à partir de la session ou de toute autre source

            $user = new User();
            $existingUser = $user->getOneWhere(["email" => $email]);

            if ($existingUser && $existingUser->getVerifCode() === $verificationCode) {
                // Mettez à jour le statut du compte
                $existingUser->setStatus(1);
                $existingUser->save();

                echo "Votre compte a été vérifié avec succès. Vous pouvez maintenant vous connecter.";
                // Redirigez l'utilisateur vers la page de connexion ou une autre page appropriée
                header('Refresh: 2; URL=/login');
            } else {
                echo "La vérification du compte a échoué. Veuillez vérifier le code de vérification que vous avez fourni.";
            }
        }

        $view->assign("formErrors", $form->errors);
    }
}
