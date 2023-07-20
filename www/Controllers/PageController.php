<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Pages;
use App\Forms\CreatePages;
use App\Core\AuthMiddleware;
use App\Forms\UpdatePage;


class PageController
{
    public function index(): void
    {
        $pageModel = new Pages();
        $limit = 20; // Nombre de pages à afficher par page
        $page = $_GET['page'] ?? 1; // Récupérer le numéro de page à partir de la requête, par exemple, à l'aide de la superglobale $_GET
        $offset = ($page - 1) * $limit; // Calculer le décalage en fonction du numéro de page

        $pages = $pageModel->all1($limit, $offset);

        $action = "index";

        $view = new View("pages", "back");
        AuthMiddleware::assignPseudoToView($view);
        $view->assign("pages", $pages);
        $view->assign("action", $action);
        AuthMiddleware::assignPseudoToView($view);
    }

    public function create()
    {
           
        $form= new CreatePages();
        $view = new View("pages", "back");
        $view->assign("form", $form->getConfig());
        $view->assign("action", "create");

        
        if ($form->isSubmited() && $form->isValid()) {

          
          $pageModel = new Pages();
          $page = $pageModel->getOneWhere(['title' => $_POST['title']]);
          if ($page) {
              $form->errors['title'] = "Une page avec ce titre existe déjà";
          }
  
          if (!empty($form->errors)) {
              $view->assign("formErrors", $form->errors);
              return;
          }
            
            $page = new Pages();
            $page->setAuthor($_POST['author']);
            $page->setDate($_POST['date']);
            $page->setTitle(strtolower($_POST['title'])); 
            $page->setTheme($_POST['theme']);
            $page->setColor($_POST['color']);
            $page->setContentPage($_POST['content_page']);
          

            // Enregistrer la page dans la base de données
            $page->save();

            // Ecrire dans le routes.yml la route de la page avec l'action show 
            $newRoute = [
              'path' => '/' . str_replace(' ', '-', strtolower($page->getTitle())),
              'controller' => 'PageController', // Remplacez par le nom du contrôleur approprié
              'action' => 'show' // Remplacez par la fonction appropriée
            ];
            
            // lire le fichier route.yml
          $routes = yaml_parse_file('routes.yml');
  
          // ajouter la nouvelle route
          $routes[str_replace(' ', '-', strtolower($page->getTitle()))] = $newRoute;
  
          // écrire le fichier route.yml
          yaml_emit_file('routes.yml', $routes);

          
          header('Location: /dashboard/pages');
          exit();
        }

        $view->assign("formErrors", $form->errors);
    }


    public function show()
    {
      // get uri by removing the slash
    
      $uri = substr($_SERVER['REQUEST_URI'], 1);
      $pageModel = new Pages();
      $page = $pageModel->getOneWhere(['title' => str_replace('-', ' ', $uri)]);
      
   

      // assign the page to the view
      $view = new View("pageTemplate", "Auth");
      $view->assign("title", $page->getTitle());
      $view->assign("content_page", $page->getContentPage());
      $view->assign("theme", $page->getTheme());
      $view->assign("color", $page->getColor());
      $view->assign("author", $page->getAuthor());
      $view->assign("date", $page->getDate());
      
      
    }

    public function update()
    {
        $id = $_GET['id'];

        // Récupérer la page à modifier depuis la base de données
        $pageModel = new Pages();
        $page = $pageModel->find($id);

        // Vérifier si la page existe
        if (!$page) {
            echo "La page n'existe pas";
            exit;
        }

        // Instanciation de la classe UpdatePageForm
        $form = new UpdatePage();

        // Charger la vue avec le formulaire d'update et les données de la page
        $view = new View("pages", "Auth");
        $view->assign("page", $page);
        $view->assign("form", $form->getConfig());
        $view->assign("formValues", $page->recupInfo());
        $view->assign("action", "update"); 

        if ($form->isSubmited() && $form->isValid()) {
            $page->setAuthor($_POST["author"]);
            $page->setDate($_POST["date"]);
          //  $page->setTitle($_POST["title"]);
            $page->setTheme($_POST["theme"]);
            $page->setColor($_POST["color"]);
            $page->setContentPage($_POST["content_page"]);
            $page->save();

            // Si toutes les conditions sont vérifiées, enregistrez la page et affichez un message de succès
            echo "La page a bien été modifiée. Vous allez être redirigé vers l'index'.";
           //redirigé vers l'index
            header('Location: /dashboard/pages');
            exit;
        }
    }




    public function deletePage()
    {
        $id = $_GET['id'];

        // Récupérer la page à supprimer depuis la base de données
        $pageModel = new Pages();
        $page = $pageModel->find($id);

        // Vérifier si la page existe
        if (!$page) {
            echo "La page n'existe pas";
            exit;
        }

        // Supprimer la page
        $page->delete();

        // Supprimer la route de la page dans le fichier routes.yml
        $routes = yaml_parse_file('routes.yml');
        unset($routes[str_replace(' ', '-', strtolower($page->getTitle()))]);
        yaml_emit_file('routes.yml', $routes);

        // Rediriger vers la liste des pages
        header('Location: /dashboard/pages');
        exit;
    }
    
    

}