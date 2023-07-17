<?php

namespace App\Models;

use App\Core\SQL;

class Article extends SQL
{
    private Int $id = 0;
    protected String $title;
    protected String $content;
    protected String $slug;
    protected String $created_at; // Nouvelle propriété pour la date de création
    protected ?String $imageUrl; // Nouvelle propriété pour l'URL de l'image
    


    //Connexion with singleton
    public function __construct()
    {
        $this->pdo = SQL::getInstance()->getConnection();
        $classExploded = explode("\\", get_called_class());
        $this->table = $GLOBALS["config"]["dbprefix"]. "_" . end($classExploded);
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
     * @return string|null
     */
    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    /**
     * @param string|null $imageUrl The image URL or null
     */
    public function setImageUrl(?string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
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

}
