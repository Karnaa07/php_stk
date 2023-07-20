<?php

namespace App\Models;

use App\Core\SQL;

class Comment extends SQL
{
    protected $id;
    protected $nom;
    protected $email;
    protected $commentaire;
    protected $dateCreation;
    protected $articleId;

    public function __construct()
    {
        $this->pdo = SQL::getInstance()->getConnection();
    }
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getArticleId()
    {
        return $this->articleId;
    }

    public function setArticleId($articleId)
    {
        $this->articleId = $articleId;
    }
    
    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getCommentaire()
    {
        return $this->commentaire;
    }

    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    }

    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

    // Méthodes pour les opérations CRUD sur les commentaires

     // méthode getAllComments() pour renvoyer un tableau associatif
    public function getAllComments()
    {
        $db = SQL::getInstance()->getConnection();
        $query = "SELECT * FROM esgi_commentaires";
        $result = $db->query($query);
        $comments = [];

        while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
            $comments[] = $row;
        }

        return $comments;
    }



    public function getCommentsByPostId($postId)
    {
        $db = SQL::getInstance()->getConnection();
        $query = "SELECT * FROM esgi_commentaires WHERE id_article = :postId";
        $result = $db->prepare($query);
        $result->execute(['postId' => $postId]);
        return $result->fetchAll();
    }

    public function createComment()
    {
        $db = SQL::getInstance()->getConnection();
        $query = "INSERT INTO esgi_commentaires (nom, email, commentaire, article_id) VALUES (:nom, :email, :commentaire, :article_id)";
        $result = $db->prepare($query);
        $result->execute([
            'nom' => $this->nom,
            'email' => $this->email,
            'commentaire' => $this->commentaire,
            'article_id' => $this->articleId, // Ajout de l'article_id
        ]);
        return $db->lastInsertId();
    }
    

    public function updateComment($id)
    {
        $db = SQL::getInstance()->getConnection();
        $query = "UPDATE esgi_commentaires SET nom = :nom, email = :email, commentaire = :commentaire WHERE id = :id";
        $result = $db->prepare($query);
        $result->execute([
            'id' => $id,
            'nom' => $this->nom,
            'email' => $this->email,
            'commentaire' => $this->commentaire,
        ]);
        return $result->rowCount();
    }

    public function deleteComment($id)
    {
        $db = SQL::getInstance()->getConnection();
        $query = "DELETE FROM esgi_commentaires WHERE id = :id";
        $result = $db->prepare($query);
        $result->execute(['id' => $id]);
        return $result->rowCount();
    }

    public function reportComment($id, $reason)
    {
        $db = SQL::getInstance()->getConnection();
        $query = "UPDATE esgi_commentaires SET is_reported = true, reason = :reason WHERE id = :id";
        $result = $db->prepare($query);
        $result->execute([
            'id' => $id,
            'reason' => $reason
        ]);
        return $result->rowCount() > 0;
    }
    public function approveComment($id)
    {
        $db = SQL::getInstance()->getConnection();
        $query = "UPDATE esgi_commentaires SET is_approved = true WHERE id = :id";
        $result = $db->prepare($query);
        $result->execute(['id' => $id]);
        return $result->rowCount() > 0;
    }

    public function getCommentsByArticleId($articleId)
    {
        // Obtenez la connexion à la base de données
        $db = SQL::getInstance()->getConnection();

        $query = "SELECT * FROM esgi_commentaires WHERE article_id = :articleId";

        // Préparez et exécutez la requête SQL en utilisant la connexion à la base de données
        $stmt = $db->prepare($query);
        $stmt->bindParam(':articleId', $articleId, \PDO::PARAM_INT);
        $stmt->execute();

        // Récupére les résultats des commentaires sous forme de tableau d'objets Comment
        $comments = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $comment = new Comment();
            //  setters pour chaque propriété du commentaire
            $comment->setId($row['id']);
            $comment->setNom($row['nom']);
            $comment->setEmail($row['email']);
            $comment->setCommentaire($row['commentaire']);
            

            // Ajouter le commentaire au tableau
            $comments[] = $comment;
        }

        // Retourner le tableau des commentaires associés à l'article
        return $comments;
    }
}
