<?php

namespace App\Controllers;

use App\Core\View;
use App\Controller\Auth;

class dashboard
{
    public function board(): void
    {
        $pseudo = $_SESSION["firstname"];
        $view = new View("Dashboard/board", "back");
        $view->assign("pseudo", $pseudo);
        $view->assign("titleseo", "supernouvellepage");

        // Assigner des données à afficher dans la vue

        $view->setPageTitle('Tableau de bord');
        $view->setH1Title('Bienvenue sur le tableau de bord');

        // Ajoutez d'autres données spécifiques au tableau de bord ici


    }

    public function users(): void
    {
        $pseudo = $_SESSION["firstname"];
        $view = new View("Dashboard/user", "front");
        $view->assign("pseudo", $pseudo);
        $view->assign("titleseo", "supernouvellepage");

    }
}
