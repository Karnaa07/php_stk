<?php

// CommentController.php

// CommentController.php

namespace App\Controllers;

use App\Core\View;
use App\Models\Comment;
use App\Forms\CommentForm;

class CommentController
{

    
    public function commentController(): void
    {
        // Afficher tous les commentaires depuis le modèle
        $commentModel = new Comment();
        $comments = $commentModel->getAllComments();

        // Créer une instance du formulaire de commentaires
        $form = new CommentForm();

        // Assigner le formulaire à la vue
        $view = new View("Comment/comments", "front");
        $view->assign("form", $form->getConfig());
        $view->assign("comments", $comments);

        // Formulaire soumis et valide ?
        if ($form->isSubmited() && $form->isValid()) {
            // Récupérer les données du formulaire
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $commentaire = $_POST['commentaire'];

            // Créer une instance du modèle Comment
            $newComment = new Comment();
            $newComment->setNom($nom);
            $newComment->setEmail($email);
            $newComment->setCommentaire($commentaire);

            // Créer le commentaire dans la base de données
            $newCommentId = $newComment->createComment();

            if ($newCommentId) {
                echo "Le commentaire a été créé";
            } else {
                echo "Une erreur s'est produite lors de la création du commentaire.";
            }
        }
        //Affiche des erreurs
        $view->assign("formErrors", $form->errors);

        // Vérifier si le formulaire de signalement est soumis
    if (isset($_POST['commentId']) && isset($_POST['reason'])) {
        $commentId = $_POST['commentId'];
        $reason = $_POST['reason'];

        // Appeler la méthode pour signaler le commentaire
        $isReported = $commentModel->reportComment($commentId, $reason);

        if ($isReported) {
            echo "Le commentaire a été signalé avec succès.";
        } else {
            echo "Une erreur s'est produite lors du signalement du commentaire.";
        }
    }

    // Définir la propriété $isReported pour chaque commentaire
    foreach ($comments as $comment) {
        $comment->setIsReported($comment['is_reported']);
    }

    // Assigner les commentaires à la vue
    $view->assign("comments", $comments);

    }

    public function reportComment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire de signalement
            $commentId = $_POST['commentId'];
            $reason = $_POST['reason'];

            // Créer une instance du modèle Comment
            $commentModel = new Comment();

            // Signaler le commentaire avec la raison spécifiée
            $success = $commentModel->reportComment($commentId, $reason);

            if ($success) {
                echo "Le commentaire a été signalé avec succès.";
            } else {
                echo "Une erreur s'est produite lors du signalement du commentaire.";
            }
        }

        // Rediriger vers la page des commentaires après le signalement
        header('Location: comments.php');
        exit();
    }

    public function delete($commentId)
    {
        // Supprimer le commentaire via le modèle
        $commentModel = new Comment();
        $commentModel->deleteComment($commentId);

        // Rediriger vers la page des commentaires après la suppression
        header('Location: comments.php');
        exit();
    }
}

