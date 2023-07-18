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


            // Préparer les variables pour le template
            $title = $page->getTitle();
            $author = $page->getAuthor();
            $date = $page->getDate();
            $theme = $page->getTheme();
            $color = $page->getColor();
            $content = $page->getContent();

            // Démarrer la mise en tampon de sortie
            ob_start();

            // Inclure le fichier de template
            include 'views/pageTemplate.php';

            // Obtenir le contenu du tampon
            $html = ob_get_contents();

            // Arrêter la mise en tampon de sortie et nettoyer le tampon
            ob_end_clean();

            // Créer le nom du fichier à partir du titre de la page
            $fileName = str_replace(' ', '-', strtolower($title)) . '.html';

            // Créer un répertoire pour stocker les pages s'il n'existe pas déjà
            if (!file_exists('PageCreateView')) {
                mkdir('PageCreateView', 0777, true);
            }

            // Écrire le contenu HTML dans le nouveau fichier
            file_put_contents('PageCreateView/' . $fileName, $html);

            // Rediriger vers la liste des pages ou afficher un message de succès
            header('Location: /pages');
            exit();
        }

        $view->assign("formErrors", $form->errors);
    }

    // public function store()
    // {
    //     $createPageForm = new CreatePageForm();
    //     // Récupérer les données du formulaire
    //     $data = $_POST;

    //     // Créer une instance du modèle Page
    //     $page = new Page();

    //     // Renseigner les propriétés de la page à partir des données reçues
    //     $page->setAuthor($data['author']);
    //     $page->setDate($data['date']);
    //     $page->setTitle($data['title']);
    //     $page->setTheme($data['theme']);
    //     $page->setColor($data['color']);
    //     $page->setContent($data['content']);

    //     // Enregistrer la page dans la base de données
    //     $page->save();

    //     // Rediriger vers la liste des pages ou afficher un message de succès
    //     header('Location: /pages');
    //     exit();
    // }

    // public function edit()
    // {
    //     $id = $_GET['id'];

    //     // Récupérer la page à modifier depuis la base de données
    //     $page = Page::find($id);

    //     // Vérifier si la page existe
    //     if (!$page) {
    //         // Gérer l'erreur, page non trouvée
    //     }

    //     // Instanciation de la classe CreatePageForm
    //     $editForm = new CreatePageForm();

    //     // Obtention de la configuration du formulaire
    //     $editFormConfig = $editForm->getConfig();

    //     // Charger la vue avec le formulaire de création de page et les données de la page
    //     $view = new View("pages/edit", "back");
    //     $view->assign("page", $page);
    //     $view->assign("form", $editFormConfig);

    //     // Formulaire soumis et valide ?
    //     if ($editForm->isSubmited() && $editForm->isValid()) {
    //         // Mettre à jour les propriétés de la page à partir des données reçues
    //         $page->setAuthor($_POST["author"]);
    //         $page->setDate($_POST["date"]);
    //         $page->setTitle($_POST["title"]);
    //         $page->setTheme($_POST["theme"]);
    //         $page->setColor($_POST["color"]);
    //         $page->setContent($_POST["content"]);

    //         // Enregistrer les modifications de la page dans la base de données
    //         $page->save();

    //         // Rediriger vers la liste des pages ou afficher un message de succès
    //         header('Location: /pages');
    //         exit();
    //     }

    //     $view->assign("formErrors", $createPageForm->errors);
    //     //$view->render();
    // }

    // public function update()
    // {
    //     // Code pour mettre à jour la page dans la base de données
    // }
    public function deletePage()
    {
      // Vérifier si un ID de page est passé en paramètre GET
      if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $pageModel = new PageModel();
        $page = $pageModel->getOneWhere(['id' => $_GET['id']]);
    
        // Vérifier si la page existe avant de la supprimer
        if ($page) {
          $pageModel->deleteWhere(['id' => $_GET['id']]);
          // Rediriger vers la page d'index ou une autre page après la suppression
          header('Location: /dashboard/pages'); // Remplacez "/index" par l'URL souhaitée
          exit;
        }
      }
    
      // Si l'ID de page n'est pas valide ou la page n'existe pas, rediriger vers une page d'erreur ou une autre page appropriée
      header('Location: /error-page'); // Remplacez "/error-page" par l'URL de la page d'erreur souhaitée
      exit;
    }
    
    // public function delete()
    // {
    //     $id = $_POST['id'];

    //     // Récupérer la page à supprimer depuis la base de données
    //     $page = \App\Models\Page::populate($id);

    //     if (!$page) {
    //         echo "Page non trouvée.";
    //         exit();
    //     }

    //     // Supprimer la page de la base de données en utilisant la méthode delete de l'objet Page
    //     $page->delete();

    //     // Rediriger vers la liste des pages ou afficher un message de succès
    //     header('Location: /pages');
    //     exit();
    // }

}
