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
            // Vérifie si une page avec le même titre existe déjà
            // $existingPage = Page::where('title', $_POST['title'])->first();
            // if ($existingPage) {
            //     // Si oui, afficher un message d'erreur et arrêter l'exécution
            //     $view->assign("formErrors", array("Une page avec ce titre existe déjà."));
            //     return;
            // }
            $page = new Page();
            $page->setAuthor($_POST['author']);
            $page->setDate($_POST['date']);
            $page->setTitle($_POST['title']);
            $page->setTheme($_POST['theme']);
            $page->setColor($_POST['color']);
            $page->setContent($_POST['content']);

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
          $routes[str_replace(' ', '_', strtolower($page->getTitle()))] = $newRoute;
  
          // écrire le fichier route.yml
          yaml_emit_file('routes.yml', $routes);

          
          header('Location: /pages');
          exit();
        }

        $view->assign("formErrors", $form->errors);
    }

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
    public function show(){
      // get uri by removing the slash
    
      $uri = substr($_SERVER['REQUEST_URI'], 1);
      $pageModel = new Page();
      $page = $pageModel->getOneWhere(['title' => str_replace('-', ' ', $uri)]);

      // assign the page to the view
      $view = new View("pageTemplate", "Auth");
      $view->assign("title", $page->getTitle());
      $view->assign("content", $page->getContent());
      $view->assign("theme", $page->getTheme());
      $view->assign("color", $page->getColor());
      $view->assign("author", $page->getAuthor());
      $view->assign("date", $page->getDate());
      
      
    }
    

}