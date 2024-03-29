<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\AuthMiddleware;
use App\Controller\Auth;
use App\Models\Article as ModelArticle;
use App\Models\User;
use App\Models\Pages;

class dashboard
{
    public function board(): void
    {
        $view = new View("Dashboard/board", "back");

        AuthMiddleware::assignPseudoToView($view);

        $pageModel = new Pages();
        $pageCount = $pageModel->countAll();
        $view->assign("pageCount", $pageCount);

        $articleModel = new ModelArticle();
        $articleCount = $articleModel->countAll();
        $view->assign("articleCount", $articleCount);

        $userModel = new User();
        $userCount = $userModel->countAll();
        $view->assign("userCount", $userCount);



        // Ajoutez d'autres données spécifiques au tableau de bord ici
    }
}
