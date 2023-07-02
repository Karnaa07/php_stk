<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Page;

class PageController
{
    public function index(): void
    {
        $pageModel = new Page();
        $limit = 20; // Nombre de pages à afficher par page
        $page = $_GET['page'] ?? 1; // Récupérer le numéro de page à partir de la requête
        $offset = ($page - 1) * $limit; // Calculer le décalage en fonction du numéro de page

        $pages = $pageModel->all($limit, $offset);

        $action = "index";

        $view = new View("pages", "back");
        $view->assign("pages", $pages);
        $view->assign("action", $action);
        //$view->render();
    }

    public function create()
    {
        $view = new View("pages.view", "front");

        // Afficher le formulaire de création de page
        $view->render();
    }

    public function store()
    {
        // Récupérer les données soumises par le formulaire
        $author = $_POST['author'];
        $date = $_POST['date'];
        $title = $_POST['title'];
        $theme = $_POST['theme'];
        $color = $_POST['color'];
        $content = $_POST['content'];

        // Créer une instance du modèle Page
        $page = new Page();

        // Renseigner les propriétés de la page à partir des données reçues
        $page->setAuthor($author);
        $page->setDate($date);
        $page->setTitle($title);
        $page->setTheme($theme);
        $page->setColor($color);
        $page->setContent($content);

        // Enregistrer la page dans le système de stockage
        $page->save();

        // Rediriger vers la liste des pages ou afficher un message de succès
        header('Location: /pages');
        exit();
    }

    public function edit()
    {
        $id = $_GET['id'];

        // Récupérer la page à modifier depuis le modèle Page
        $page = Page::find($id);

        // Vérifier si la page existe
        if (!$page) {
            // Gérer l'erreur, page non trouvée
        }

        // Charger la vue avec le formulaire de modification de page et les données de la page
        $view = new View("pages.view", "front");
        $view->assign("page", $page);
        $view->assign("action", "edit"); // Ajouter cette ligne pour définir la valeur de $action
        //$view->render();
    }

    public function update()
    {
        // Récupérer les données soumises par le formulaire de modification de page
        $id = $_POST['id'];
        $author = $_POST['author'];
        $date = $_POST['date'];
        $title = $_POST['title'];
        $theme = $_POST['theme'];
        $color = $_POST['color'];
        $content = $_POST['content'];

        // Récupérer la page à modifier depuis le modèle Page
        $page = Page::find($id);

        // Vérifier si la page existe
        if (!$page) {
            // Gérer l'erreur, page non trouvée
        }

        // Mettre à jour les propriétés de la page avec les nouvelles données
        $page->setAuthor($author);
        $page->setDate($date);
        $page->setTitle($title);
        $page->setTheme($theme);
        $page->setColor($color);
        $page->setContent($content);

        // Enregistrer les modifications dans le système de stockage
        $page->save();

        // Rediriger vers la liste des pages ou afficher un message de succès
        header('Location: /pages');
        exit();
    }

    public function delete()
    {
        $id = $_GET['id'];

        // Récupérer la page à supprimer depuis le modèle Page
        $page = Page::find($id);

        // Vérifier si la page existe
        if (!$page) {
            // Gérer l'erreur, page non trouvée
        }

        // Supprimer la page du système de stockage en utilisant la fonction delete()
        $page->delete();

        // Rediriger vers la liste des pages ou afficher un message de succès
        header('Location: /pages');
        exit();
    }
}
