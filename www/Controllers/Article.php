<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Article as ModelArticle;

class Article{

  public function index(): void
  {
    $pseudo = $_SESSION["firstname"];
    
    $articleModel = new ModelArticle();
    $articles = $articleModel->getAll();

    $view = new View("Article/index", "back");
    $view->assign("pseudo", $pseudo);
    $view->assign("titleseo", "supernouvellepage");
    $view->assign("title", "Liste des articles");
    $view->assign("articles", $articles);
  }

}