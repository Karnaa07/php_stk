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

    // MODIF ICI
    public function approve()
    {
        $id = $_GET['id'];
    
        // Créer une instance du modèle Comment
        $commentModel = new Comment();
    
        // Vérifier si le commentaire existe et s'il est signalé
        $comment = $commentModel->getCommentById($id);
        if (!$comment) {
            // Gérer l'erreur, commentaire non trouvé
            echo "Le commentaire n'existe pas.";
            exit();
        }
    
        // Approuver le commentaire dans la base de données
        $commentModel->approveComment($id);
    
         // Si le commentaire n'a pas été signalé, mettez simplement is_approved à true
        if ($comment['is_reported']) {
            $commentModel->updateCommentStatus($id, false);
        } else {
           
            // Si le commentaire a été signalé, mettez is_reported à NULL
            $commentModel->updateCommentStatus($id, true);
        }
    
        // Rediriger vers la liste des commentaires ou afficher un message de succès
        header('Location: /dashboard/commentaires');
        exit();
    }
    
    // MODIF ICI
    public function showReportedComments()
{
    // Créer une instance du modèle Comment
    $commentModel = new Comment();
    $action = "showReportedComments";
    $comments = $commentModel->getReportedComments();

    $view = new View("GestionComment", "back");
    $view->assign("comments", $comments);
    $view->assign("action", $action);
    AuthMiddleware::assignPseudoToView($view);

    
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
    header('Location: /dashboard/commentaires');
    exit();
}

}
