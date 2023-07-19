<?php

namespace App\Models;

use App\Core\SQL;

class Page extends SQL
{
    private int $id = 0;
    protected string $author;
    protected string $date;
    protected string $title;
    protected string $theme;
    protected string $color;
    protected string $content;

    protected $table = "esgi_pages";
    
    public function __construct()
    {
        $this->pdo = SQL::getInstance()->getConnection();


    }

    public static function find($id)
    {
        $pdo = SQL::getInstance()->getConnection();

        $statement = $pdo->prepare('SELECT * FROM pages WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();

        $page = $statement->fetch(PDO::FETCH_ASSOC);

        if ($page) {
            return $page;
        }

        return null;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTheme(): string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): void
    {
        $this->theme = $theme;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function all($limit = 100, $offset = 0): array
    {
        $query = "SELECT * FROM " . $this->table . " LIMIT :limit OFFSET :offset";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete()
    {
        $this->deleteWhere(['id' => $this->id]);
    }
}
