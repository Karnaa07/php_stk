<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\AuthMiddleware;
use App\Controller\Auth;


class Main
{
    public function home(): void
    {
        $view = new View("Main/home", "front");
        AuthMiddleware::assignPseudoToView($view);
        $view->assign("titleseo", "supernouvellepage");
    }

    public function contact(): void
    {
        echo "Page de contact";
    }

    public function aboutUs(): void
    {
        $view = new View("Main/aboutUs", "front");
        AuthMiddleware::assignPseudoToView($view);
    }

}
