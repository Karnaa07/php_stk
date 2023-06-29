<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Page as ModelPage;

class Page{

  public function index(): void
  {
    $pageModel = new ModelPage();
    $pages = $pageModel->getAll();

    $view = new View("Page/index", "front");
    $view->assign("titleseo", "supernouvellepage");
    $view->assign("title", "Liste des pages");
    $view->assign("pages", $pages);
  }

}