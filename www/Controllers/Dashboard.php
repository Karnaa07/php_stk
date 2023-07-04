<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\AuthMiddleware;
use App\Controller\Auth;

class dashboard
{
    public function board(): void
    {
        AuthMiddleware::checkAuthenticated();

        $view = new View("Dashboard/board", "back");

        AuthMiddleware::assignPseudoToView($view);

        $view->assign("titleseo", "supernouvellepage");

        // Assigner des données à afficher dans la vue
        $view->setPageTitle('Tableau de bord');
        $view->setH1Title('Bienvenue sur le tableau de bord');

        // Ajoutez d'autres données spécifiques au tableau de bord ici
    }
}
