<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\AuthMiddleware;
use App\Forms\Article as FormArticle;
use App\Forms\CommentForm;
use App\Models\Article as ModelArticle;
use App\Models\ArticleMemento as ModelArticleMemento;
use App\Models\Comment as ModelComment;
use App\Models\Comment;


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

  public function showOneArticle(): void
{
    // Check if an article ID is passed in the GET parameters
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $articleModel = new ModelArticle();
        $article = $articleModel->getOneWhere(['id' => $_GET['id']]);
        $articleId = $_GET['id'];
        echo "ID de l'article : " . $articleId;
        // Si l'article existe
        if ($article) {

            // Créer une instance du formulaire de commentaires
            $form = new CommentForm($articleId);

            // Vérifier si le formulaire est soumis et valide
            if ($form->isSubmited() && $form->isValid()) {
                // Récupérer les données du formulaire
                $nom = $_POST['nom'];
                $email = $_POST['email'];
                $commentaire = $_POST['commentaire'];
                $articleId = $_POST['articleId'];

                // Créer une instance du modèle Comment
                $commentModel = new ModelComment();
                $newComment = new Comment();
                $newComment->setNom($nom);
                $newComment->setEmail($email);
                $newComment->setCommentaire($commentaire);
                $newComment->setArticleId($articleId);
                
                // Associer le commentaire à l'article en définissant l'ID de l'article
                $newComment->setArticleId($_GET['id']);

                // Créer le commentaire dans la base de données
                $newCommentId = $newComment->createComment();


                if ($newCommentId) {
                    echo "Le commentaire a été créé";
                } else {
                    echo "Une erreur s'est produite lors de la création du commentaire.";
                }
            }

            // Récupérer les commentaires associés à l'article
            $commentModel = new ModelComment();
            $comments = $commentModel->getCommentsByArticleId($_GET['id']);

            // Créer une instance de la vue
            $view = new View("Article/showOneArticle", "front");
            $view->assign("title", $article->getTitle()); // Utilisez le titre de l'article comme titre de la page
            $view->assign("article", $article); // Assignez l'article à la vue pour l'affichage des détails
            $view->assign("form", $form->getConfig());
            $view->assign("comments", $comments); // Assignez les commentaires à la vue
        } else {
            
            header('Location: /error-page'); 
            exit;
        }
    } else {
       
        header('Location: /error-page'); 
        exit;
    }
     // Afficher le formulaire avec les erreurs de validation s'il y en a
    $view->assign("formErrors", $form->errors);
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
      $article->setImageUrl($_POST["image_url"]);
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

  public function update(): void
  {
    // Check if an article ID is passed in the GET parameters
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
      $articleModel = new ModelArticle();
      $article = $articleModel->getOneWhere(['id' => $_GET['id']]);
      

      // Check if the article exists before updating
      if ($article) {
        $form = new FormArticle();
        $view = new View("Article/edit", "back");
        AuthMiddleware::assignPseudoToView($view);
        $view->assign("form", $form->getConfig());
        $view->assign("formValues", $article->recupInfo());
        // $view->assign("formValues", "kdksjds");


        if ($form->isSubmited() && $form->isValid()) {
          $articleMemento = new ModelArticleMemento();
          $articleMemento->createMemento($article);
          // Update the article with the submitted form data
          $article->setTitle($_POST["title"]);
          $article->setSlug($_POST["slug"]);
          $article->setContent($_POST["content"]);
          $article->setUpdatedAt(date("Y-m-d")); // You can also get the current date from the database.
          $article->setImageUrl($_POST["image_url"]);
          // You can also update the "updatedAt" field with the current date from the database.

          // Save the updated article to the database
          $article->save();
          // Redirect to the list of articles or another page if needed
          echo ("L'article a été mis à jour avec succès");
          header('Refresh: 2; URL= /dashboard/articles');
        }

        // Show the form with validation errors if any
        $view->assign("formErrors", $form->errors);
        return;
      }
    }
  }

  public function restoreArticle()
  {
    $view = new View("Article/memento", "back");
    AuthMiddleware::assignPseudoToView($view);

    if (isset($_GET['id_article']) && is_numeric($_GET['id_article'])) {
      $article_memento = new ModelArticleMemento();
      $article = new ModelArticle();
      $article_memento = $article_memento->populate($_GET['id_article']);
      $id_article = $article_memento->getIdArticle();
      $article_memento_backup_article = new ModelArticleMemento();
      $article_memento_backup_article->createMemento($article->populate($id_article));
      $article = $article_memento->restoreFromMemento($_GET['id_article']);
      $article->save();
      header('Location: /dashboard/articles');
    }

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
      $ModelArticleMemento = new ModelArticleMemento();
      $article_memento = $ModelArticleMemento->getAllWhere(["id_article = '".$_GET['id']."'"]);
    }


    $view->assign("article_memento", $article_memento);
  }
}
