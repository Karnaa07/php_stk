<?php

namespace App\Controllers;

use App\Core\View;
use App\Forms\Register;
use App\Models\User;

class Auth
{
    public function login(): void
    {
        echo "Page de connexion";
    }

    public function register(): void
    {
        $form = new Register();
        $view = new View("Auth/register", "front");
        $view->assign("form", $form->getConfig());

        //Form validé ? et correctx ?
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