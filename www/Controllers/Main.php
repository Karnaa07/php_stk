<?php

namespace App\Controllers;

use App\Core\View;
use App\Controller\Auth;

class Main
{
    public function home(): void
    {
        $pseudo = $_SESSION["firstname"];
        // $estConnecte = isset($_SESSION["user"]);
        $view = new View("Main/home", "front");
        $view->assign("pseudo", $pseudo);
        // $view->assign("estConnecte", $estConnecte);
        $view->assign("age", 30);
        $view->assign("titleseo", "supernouvellepage");
    }

    public function contact(): void
    {
        echo "Page de contact";
    }

    public function aboutUs(): void
    {
        echo "Page à propos";
    }

}