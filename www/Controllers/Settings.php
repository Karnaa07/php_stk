<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\AuthMiddleware;

Class Settings{
  public function index(){
    $view = new View("Settings/index", "back");
    AuthMiddleware::assignPseudoToView($view);
    $view->assign("action", "index");
  }
}