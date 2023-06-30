<?php

namespace App\Controllers;

use App\Core\View;
use App\Controller\Auth;

class Main
{
    public function home(): void
    {
        $view = new View("Main/home", "front");
        
        if (isset($_SESSION["user"])) {
            $pseudo = $_SESSION["firstname"];
            $view->assign("pseudo", $pseudo);
        }

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