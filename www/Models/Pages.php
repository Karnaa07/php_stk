<?php

namespace App\Models;

use App\Core\SQL;

class Pages extends SQL
{
    private int $id = 0;
    protected string $author;
    protected string $date;
    protected string $title;
    protected string $theme;
    protected string $color;
    protected string $content_page;

    protected $table = "esgi_pages";
    
    public function __construct()
    {
        $this->pdo = SQL::getInstance()->getConnection();
    }

    public function find($id)
    {
        // Utilisez la méthode find de la classe parent pour obtenir les données
        $data = parent::find($id);

        // Si aucun enregistrement n'a été trouvé, retournez null
        if (!$data) {
            return null;
        }

        // Instanciez un nouvel objet Page et remplissez-le avec les données
        $page = new self();
        $page->setId($data['id']);
        $page->setAuthor($data['author']);
        $page->setDate($data['date']);
        $page->setTitle($data['title']);
        $page->setTheme($data['theme']);
        $page->setColor($data['color']);
        $page->setContentPage($data['content_page']);

        // Retournez l'objet Page
        return $page;
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

    public function getContentPage(): string
    {
        return $this->content_page;
    }

    public function setContentPage(string $content_page): void
    {
        $this->content_page = $content_page;
    }

    public function delete()
    {
        $this->deleteWhere(['id' => $this->id]);
    }

    public function recupInfo(): array {
        return [
            'id' => $this->getId(),
            'author' => $this->getAuthor(),
            'date' => $this->getDate(),
            //'title' => $this->getTitle(), // pas utile pour l'update 
            'theme' => $this->getTheme(),
            'color' => $this->getColor(),
            'content_page' => $this->getContentPage()
        ];
    }
}
