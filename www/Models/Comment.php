<?php

namespace App\Models;

use App\Core\SQL;

class Comment
{
    protected $id;
    protected $nom;
    protected $email;
    protected $commentaire;
    protected $dateCreation;

    public function getId()
    {
        return $this->id;
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

    public function getAllComments()
    {
        $db = SQL::getInstance()->getConnection();
        $query = "SELECT * FROM esgi_commentaires";
        $result = $db->query($query);
        return $result->fetchAll();
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
        $query = "INSERT INTO esgi_commentaires (nom, email, commentaire) VALUES (:nom, :email, :commentaire)";
        $result = $db->prepare($query);
        $result->execute([
            'nom' => $this->nom,
            'email' => $this->email,
            'commentaire' => $this->commentaire
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
            'commentaire' => $this->commentaire
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

    public function reportComment($id)
    {
        $db = SQL::getInstance()->getConnection();
        $query = "UPDATE esgi_commentaires SET is_reported = 1 WHERE id = :id";
        $result = $db->prepare($query);
        $result->execute(['id' => $id]);
        return $result->rowCount();
    }

}
