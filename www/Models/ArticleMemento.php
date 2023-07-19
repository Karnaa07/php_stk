<?php

namespace App\Models;

use App\Core\SQL;
use App\Models\Article;

class ArticleMemento extends SQL
{
    private Int $id = 0;
    protected Int $id_article;
    protected String $date_memento;
    protected String $title;
    protected String $content;
    protected String $slug;
    protected String $created_at; // Nouvelle propriété pour la date de création
    protected ?String $updated_at; // Nouvelle propriété pour la date de mise à jour
    protected ?String $image_url; // Nouvelle propriété pour l'URL de l'image


    //Connexion with singleton
    public function __construct()
    {
        $this->pdo = SQL::getInstance()->getConnection();
        $classExploded = explode("\\", get_called_class());
        $this->table = $GLOBALS["config"]["dbprefix"] . "_" . end($classExploded);
    }

    /**
     * @return Int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param Int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return String
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param String $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return String
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param String $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return String
     */
    public function getSlug(): string

    {
        return $this->slug;
    }

    /**
     * @param String $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return String
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @param String $createdAt
     */
    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return String|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    /**
     * @param String|null $updatedAt
     */

    public function setUpdatedAt(?string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return string|null
     */
    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    /**
     * @param string|null $imageUrl The image URL or null
     */
    public function setImageUrl(?string $image_url): void
    {
        $this->image_url = $image_url;
    }

    public function getIdArticle(): int
    {
        return $this->id_article;
    }

    public function setIdArticle(int $id_article): void
    {
        $this->id_article = $id_article;
    }

    public function getDateMemento(): string
    {
        return $this->date_memento;
    }

    public function setDateMemento(string $date_memento): void
    {
        $this->date_memento = $date_memento;
    }


    /**
     * Supprime un article de la base de données en fonction de son ID.
     *
     * @param int $id L'ID de l'article à supprimer.
     * @return bool True si la suppression a réussi, False sinon.
     */
    public function delete(int $id): bool
    {
        $queryPrepared = $this->pdo->prepare("DELETE FROM " . $this->table . " WHERE id = :id");
        $queryPrepared->execute(['id' => $id]);

        // Vérifier si la suppression a réussi
        return $queryPrepared->rowCount() > 0;
    }

    /**
     * Crée un memento de l'état actuel de l'article.
     *
     * @return array Le memento sous forme d'array.
     */
    public function createMemento(Article $article): void
    {
        $this->setIdArticle($article->getId());
        $this->setDateMemento(date('Y-m-d H:i:s'));
        $this->setTitle($article->getTitle());
        $this->setContent($article->getContent());
        $this->setSlug($article->getSlug());
        $this->setCreatedAt($article->getCreatedAt());
        $this->setUpdatedAt($article->getUpdatedAt());
        $this->setImageUrl($article->getImageUrl());
        $this->save();
    }

    /**
     * Restaure l'état de l'article à partir d'un memento.
     *
     * @param array $memento Le memento sous forme d'array.
     */
    public function restoreFromMemento(string $id_memento): object
    {
        $memento = $this->getOneWhere(['id' => $id_memento]);
        $article = new Article();

        $article->setId($this->getIdArticle());
        $article->setTitle($this->getTitle());
        $article->setContent($this->getContent());
        $article->setSlug($this->getSlug());
        $article->setCreatedAt($this->getCreatedAt());
        $article->setUpdatedAt($this->getUpdatedAt());
        $article->setImageUrl($this->getImageUrl());
        return $article;
    }
}
