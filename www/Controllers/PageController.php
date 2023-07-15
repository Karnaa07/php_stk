<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Page;
use App\Forms\CreatePage;

class PageController
{
    public function index(): void
    {
        $pageModel = new Page();
        $limit = 20; // Nombre de pages à afficher par page
        $page = $_GET['page'] ?? 1; // Récupérer le numéro de page à partir de la requête, par exemple, à l'aide de la superglobale $_GET
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
           
        $form= new CreatePage();
        $view = new View("pages", "auth");
        $view->assign("form", $form->getConfig());
        $view->assign("action", "create");
       
        if ($form->isSubmited() && $form->isValid()) {
        
            $page = new Page();
            $page->setAuthor($_POST['author']);
            $page->setDate($_POST['date']);
            $page->setTitle($_POST['title']);
            $page->setTheme($_POST['theme']);
            $page->setColor($_POST['color']);
            $page->setContent($_POST['content']);

            

            // Enregistrer la page dans la base de données
            $page->save();

            // Rediriger vers la liste des pages ou afficher un message de succès
            header('Location: /pages');
            exit();
        }

        $view->assign("formErrors", $form->errors);
        //$view->render();
    }


    public function store()
    {
        $createPageForm = new CreatePageForm();
        // Récupérer les données du formulaire
        $data = $_POST;

        // Créer une instance du modèle Page
        $page = new Page();

        // Renseigner les propriétés de la page à partir des données reçues
        $page->setAuthor($data['author']);
        $page->setDate($data['date']);
        $page->setTitle($data['title']);
        $page->setTheme($data['theme']);
        $page->setColor($data['color']);
        $page->setContent($data['content']);

        // Enregistrer la page dans la base de données
        $page->save();

        // Rediriger vers la liste des pages ou afficher un message de succès
        header('Location: /pages');
        exit();
    }

    public function edit()
    {
        $id = $_GET['id'];

        // Récupérer la page à modifier depuis la base de données
        $page = Page::find($id);

        // Vérifier si la page existe
        if (!$page) {
            // Gérer l'erreur, page non trouvée
        }

        // Instanciation de la classe CreatePageForm
        $editForm = new CreatePageForm();

        // Obtention de la configuration du formulaire
        $editFormConfig = $editForm->getConfig();

        // Charger la vue avec le formulaire de création de page et les données de la page
        $view = new View("pages/edit", "back");
        $view->assign("page", $page);
        $view->assign("form", $editFormConfig);

        // Formulaire soumis et valide ?
        if ($editForm->isSubmited() && $editForm->isValid()) {
            // Mettre à jour les propriétés de la page à partir des données reçues
            $page->setAuthor($_POST["author"]);
            $page->setDate($_POST["date"]);
            $page->setTitle($_POST["title"]);
            $page->setTheme($_POST["theme"]);
            $page->setColor($_POST["color"]);
            $page->setContent($_POST["content"]);

            // Enregistrer les modifications de la page dans la base de données
            $page->save();

            // Rediriger vers la liste des pages ou afficher un message de succès
            header('Location: /pages');
            exit();
        }

        $view->assign("formErrors", $createPageForm->errors);
        //$view->render();
    }

    public function update()
    {
        // Code pour mettre à jour la page dans la base de données
    }

    public function delete()
    {
        $id = $_GET['id'];

        // Récupérer la page à supprimer depuis la base de données
        $page = Page::find($id);

        if (!$page) {
            echo "Page non trouvée.";
            exit();
        }

        // Supprimer la page de la base de données en utilisant la fonction delete()
        $page->delete();

        // Rediriger vers la liste des pages ou afficher un message de succès
        header('Location: /pages');
        exit();
    }
}
