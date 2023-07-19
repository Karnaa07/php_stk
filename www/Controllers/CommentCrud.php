<?php

namespace App\Controllers;

use App\Core\View;
use App\Forms\CommentForm;
use App\Models\Comment;
use App\Core\AuthMiddleware;

class CommentCrud
{
    public function index()
    {
        $commentModel = new Comment();
        $comments = $commentModel->getAllComments();
        $action = "index";

        $view = new View("GestionComment", "back");
        $view->assign("comments", $comments);
        $view->assign("action", $action);
        AuthMiddleware::assignPseudoToView($view);
       
        //$view->render();
    }

    public function approve()
    {
        $id = $_GET['id'];
    
        // Créer une instance du modèle Comment
        $commentModel = new Comment();
    
        // Obtenir l'ID du commentaire à approuver
        $commentModel->setId($id);
        $commentId = $commentModel->getId();
    
        // Vérifier si l'ID du commentaire est valide
        if (!$commentId) {
            // Gérer l'erreur, commentaire non trouvé
            echo "Le commentaire n'existe pas.";
            exit();
        }
    
        // Approuver le commentaire dans la base de données 
        $commentModel->approveComment($commentId);
    
        // Rediriger vers la liste des commentaires ou afficher un message de succès
        header('Location: /commentaires');
        exit();
    }
    
    

    public function delete()
{
    // Vérifier si l'ID du commentaire est passé dans l'URL
    if (!isset($_GET['id'])) {
        // Gérer l'erreur, l'ID du commentaire n'est pas fourni dans l'URL
        echo "L'ID du commentaire n'a pas été spécifié.";
        exit();
    }

    // Récupérer l'ID du commentaire depuis l'URL
    $commentId = $_GET['id'];

    // Créer une instance du modèle Comment
    $commentModel = new Comment();

    // Définir l'ID du commentaire dans l'instance du modèle Comment
    $commentModel->setId($commentId);

    // Supprimer le commentaire de la base de données en utilisant la méthode delete du modèle Comment
    $commentModel->deleteComment($commentId);

    // Rediriger vers la liste des commentaires ou afficher un message de succès
    header('Location: /commentaires');
    exit();
}

}
