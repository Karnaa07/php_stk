<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\AuthMiddleware;
use App\Core\Validator;
use App\Forms\Article as FormArticle;
use App\Models\Article as ModelArticle;


class Article
{
  public function index(): void
  {
    $view = new View("Article/index", "front");
    AuthMiddleware::assignPseudoToView($view);
    $view->assign("titleseo", "supernouvellepage");
    $view->assign("title", "Liste des articles");

    $articleModel = new ModelArticle();
    $articles = $articleModel->getAll();

    foreach ($articles as $article) {
      $article->setCreatedAt(date("Y-m-d")); // Définir la date de création au format Y-m-d (exemple: 2023-07-07)
    }
    $view->assign("articles", $articles);
  }

  public function create(): void
  {
    $form = new FormArticle();
    $view = new View("Article/create", "back");
    AuthMiddleware::assignPseudoToView($view);
    $view->assign("form", $form->getConfig());

    if ($form->isSubmited() && $form->isValid()) {
      $article = new ModelArticle();
      $article->setTitle($_POST["title"]);
      $article->setSlug($_POST["slug"]);
      $article->setContent($_POST["content"]);
      $article->setImageUrl($_POST["imageUrl"]);
      $article->save();
      header('Location: /home');
      exit;
    }
    $view->assign("formErrors", $form->errors);
  }
}
