<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\AuthMiddleware;
use App\Forms\Article as FormArticle;
use App\Models\Article as ModelArticle;


class Article
{

  public function index(): void
  {
    $articleModel = new ModelArticle();
    $articles = $articleModel->getAll();

    // Charger la vue "back/index" avec la liste des articles
    $view = new View("Article/index", "back"); // Assurez-vous d'avoir une vue appropriée pour l'affichage des articles dans le dossier "back"
    AuthMiddleware::assignPseudoToView($view);
    $view->assign("title", "Liste des articles");
    $view->assign("articles", $articles);
    $view->render();
  }


  public function show(): void
  {
    $view = new View("Article/show", "front");
    AuthMiddleware::assignPseudoToView($view);
    $view->assign("title", "Liste des articles");

    $articleModel = new ModelArticle();
    $articles = $articleModel->getAll();

    foreach ($articles as $article) {
      $article->setCreatedAt(date("Y-m-d")); // Définir la date de création au format Y-m-d (exemple: 2023-07-07)
    }
    $view->assign("articles", $articles);
  }
  // ... Autres méthodes ...

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
      // $article->setImageUrl($_POST["imageUrl"]);
      $article->setCreatedAt(date("Y-m-d")); // Vous pouvez également obtenir la date actuelle à partir de la base de données.

      // Sauvegarder l'article dans la base de données
      $article->save();

      // Rediriger vers la liste des articles ou une autre page si nécessaire
      echo ("L'article a été créé avec succès");
      header('Refresh: 2; URL= /dashboard/articles');
    }

    // Afficher le formulaire avec les erreurs de validation s'il y en a
    $view->assign("formErrors", $form->errors);
  }

  public function delete(): void
  {
    // Vérifier si un ID d'article est passé en paramètre GET
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
      $articleModel = new ModelArticle();
      $article = $articleModel->getOneWhere(['id' => $_GET['id']]);

      // Vérifier si l'article existe avant de le supprimer
      if ($article) {
        $articleModel->deleteWhere(['id' => $_GET['id']]);
        // Rediriger vers la page d'index ou une autre page après la suppression
        header('Location: /dashboard/articles'); // Remplacez "/index" par l'URL souhaitée
        exit;
      }
    }

    // Si l'ID d'article n'est pas valide ou l'article n'existe pas, rediriger vers une page d'erreur ou une autre page appropriée
    header('Location: /error-page'); // Remplacez "/error-page" par l'URL de la page d'erreur souhaitée
    exit;
  }
}
