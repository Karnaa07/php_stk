<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Page as ModelPage;

class Page{

  public function index(): void
  {
    $pageModel = new ModelPage();
    $pages = $pageModel->getAll();
    $pseudo = $_SESSION["firstname"];
    

    $view = new View("Page/index", "back");
    $view->assign("pseudo", $pseudo);
    $view->assign("titleseo", "supernouvellepage");
    $view->assign("title", "Liste des pages");
    $view->assign("pages", $pages);
  }

}