<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\AuthMiddleware;
use App\Models\Article as ModelArticle;
use App\Forms\Article as FormArticle;


class Article{

  public function index(): void
  {
      $view = new View("Article/index", "front");
      AuthMiddleware::assignPseudoToView($view);
      $view->assign("titleseo", "supernouvellepage");
      $view->assign("title", "Liste des articles");

      $articleModel = new ModelArticle();
      $articles = $articleModel->getAll();
      $view->assign("articles", $articles);
  }


  public function create(): void
  {
      // Instancier le formulaire de création de page
      $form = new FormArticle();

      // Afficher le formulaire de création de page
      $view = new View("Page/create", "back");
      AuthMiddleware::assignPseudoToView($view);
      $view->assign("form", $form->getConfig());
  }

}
