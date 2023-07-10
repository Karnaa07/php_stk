<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\AuthMiddleware;
use App\Controller\Auth;
use App\Models\Article as ModelArticle;

class dashboard
{
    public function board(): void
    {
        AuthMiddleware::checkAuthenticated();

        $view = new View("Dashboard/board", "back");

        AuthMiddleware::assignPseudoToView($view);

        $view->assign("titleseo", "supernouvellepage");

        $articleModel = new ModelArticle();
        $articleCount = $articleModel->countAll();

        $view->assign("articleCount", $articleCount);

        // Ajoutez d'autres données spécifiques au tableau de bord ici
    }
}
