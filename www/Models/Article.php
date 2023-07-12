<?php

namespace App\Models;

use App\Core\SQL;

class Article extends SQL
{
    private Int $id = 0;
    protected String $title;
    protected String $content;
    protected String $slug;
    protected String $createdAt; // Nouvelle propriété pour la date de création


    //Connexion with singleton
    public function __construct()
    {
        $this->pdo = SQL::getInstance()->getConnection();
        $classExploded = explode("\\", get_called_class());
        $this->table = "esgi_" . end($classExploded);
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
        $this->title = ucwords(strtolower(trim($title)));
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
        $this->content = strtoupper(trim($content));
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
        $this->slug = strtolower(trim($slug));
    }

    /**
     * @return String
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param String $createdAt
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @param string|null $imageUrl The image URL or null
     */
    public function setImageUrl(?string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return string|null
     */
    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }
}
