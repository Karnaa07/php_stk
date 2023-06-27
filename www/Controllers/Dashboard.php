<?php

namespace App\Controllers;

use App\Core\View;

class dashboard
{
    public function board(): void
    {

        $view = new View("Dashboard/board", "front");

        // Assigner des données à afficher dans la vue

        $view->setPageTitle('Tableau de bord');
        $view->setH1Title('Bienvenue sur le tableau de bord');

        // Ajoutez d'autres données spécifiques au tableau de bord ici


    }
}
