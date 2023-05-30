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

        //Form validé ? et correct ?
        if($form->isSubmited() && $form->isValid()){
            $user = new User();
            $user->setFirstname();
            $user->setLastname();
            $user->setEmail();
            $user->setPwd();
            $user->save();
        }
        $view->assign("formErrors", $form->errors);


    }

    public function logout(): void
    {
        echo "Page de déconnexion";
    }

}