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
    protected $isReported;
    protected $isApproved;

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
    public function getisReported()
    {
        return $this->isReported;
    }

    public function setisReported($isReported)
    {
        $this->isReported = $isReported;
    }
    public function getisApproved()
    {
        return $this->isApproved;
    }

    public function setisApproved($isApproved)
    {
        $this->isApproved = $isApproved;
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

// MODIF ICI
    public function getCommentById($id)
    {
        $db = SQL::getInstance()->getConnection();
        $query = "SELECT * FROM esgi_commentaires WHERE id = :id";
        $result = $db->prepare($query);
        $result->execute(['id' => $id]);
        return $result->fetch(\PDO::FETCH_ASSOC);
    }
    

// MODIF ICI
    public function updateCommentStatus($id, $isReported)
    {
        $db = SQL::getInstance()->getConnection();
    
        
        if ($isReported) {
            // Mettre à jour le champ "is_reported" à true et le champ "is_approved" à NULL
            $query = "UPDATE esgi_commentaires SET is_reported = true, is_approved = false WHERE id = :id";
        } else {
            // Mettre à jour le champ "is_reported" à NULL et le champ "is_approved" à true
            $query = "UPDATE esgi_commentaires SET is_reported = false, is_approved = true WHERE id = :id";
        }
    
        $result = $db->prepare($query);
        $result->execute(['id' => $id]);
        return $result->rowCount() > 0;
    }
    
    
// MODIF ICI
    public function getReportedComments()
    {
        $db = SQL::getInstance()->getConnection();
        $query = "SELECT * FROM esgi_commentaires WHERE is_reported = true";
        $result = $db->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
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
    
// MODIF ICI
    public function updateComment($updateData, $conditions)
{
    $db = SQL::getInstance()->getConnection();
    $updateFields = '';
    $params = [];

    // Construction de la clause SET avec les champs à mettre à jour
    foreach ($updateData as $field => $value) {
        if (!empty($updateFields)) {
            $updateFields .= ', ';
        }
        $updateFields .= "$field = :$field";
        $params[":$field"] = $value;
    }

    // Construction de la clause WHERE avec les conditions pour identifier le commentaire
    $whereClause = '';
    foreach ($conditions as $field => $value) {
        if (!empty($whereClause)) {
            $whereClause .= ' AND ';
        }
        $whereClause .= "$field = :$field";
        $params[":$field"] = $value;
    }

    $query = "UPDATE esgi_commentaires SET $updateFields WHERE $whereClause";
    $result = $db->prepare($query);
    $result->execute($params);
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
