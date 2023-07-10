<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Page;
use App\Forms\CreatePageForm;

class PageController
{
    public function index()
    {
        // Créer une instance du modèle Page
        $page = new Page();

        // Récupérer toutes les pages
        $pages = $page->all();

        $action = "index";
        // Afficher la liste des pages
        $view = new View("pages", "back");
        $view->assign("action", $action);
        $view->assign("pages", $pages);
        
        $view->render(); 
    }


    public function create()
    {
        $createPageForm = new CreatePageForm();
        $view = new View("pages", "front");
        $view->assign("createPageForm", $createPageForm);
        $view->assign("action", "create");
    
        // Formulaire soumis et valide ?
        if ($createPageForm->isSubmited() && $createPageForm->isValid()) {
            // Créer une instance du modèle Page
            $page = new Page();
    
            // Renseigner les propriétés de la page à partir des données du formulaire
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
    
        $view->assign("formErrors", $createPageForm->errors);
       // $view->render();
    }
    


    public function store()
    {
        // Code pour enregistrer la nouvelle page dans la base de données
        $form = new CreatePageForm();
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
        $view = new View("edit-page", "front");
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

        $view->assign("formErrors", $editForm->errors);
        $view->render();
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
