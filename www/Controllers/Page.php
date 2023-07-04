<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\AuthMiddleware;
use App\Models\Page as ModelPage;
use App\Forms\Page as FormPage;


class Page{

  public function index(): void
  {
      $pageModel = new ModelPage();
      $pages = $pageModel->getAll();

      $view = new View("Page/index", "front");
      AuthMiddleware::assignPseudoToView($view);
      $view->assign("titleseo", "supernouvellepage");
      $view->assign("title", "Liste des pages");
      $view->assign("pages", $pages);
  }


  public function create(): void
    {
        // Instancier le formulaire de création de page
        $form = new FormPage();

        // Afficher le formulaire de création de page
        $view = new View("Page/create", "back");
        AuthMiddleware::assignPseudoToView($view);
        $view->assign("form", $form->getConfig());
        $view->render();
    }
}

