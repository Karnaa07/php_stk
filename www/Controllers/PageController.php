<?php

namespace App\Controllers;

use App\Model\Page;

class PageController
{
    public function index()
    {
        $pageModel = new Page();
        $pages = $pageModel->getAllPages();
        include_once 'path/to/view/pages/index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pageModel = new Page();
            $pageModel->setTitle($_POST['title']);
            $pageModel->setContent($_POST['content']);
            $pageModel->createPage();
            // Redirection ou message de succès
        } else {
            include_once 'path/to/view/pages/create.php';
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pageModel = new Page();
            $pageModel->setTitle($_POST['title']);
            $pageModel->setContent($_POST['content']);
            $pageModel->updatePage($id);
            // Redirection ou message de succès
        } else {
            $pageModel = new Page();
            $page = $pageModel->getPageById($id);
            if (!$page) {
                // Gérer l'erreur
            }
            include_once 'path/to/view/pages/edit.php';
        }
    }

    public function delete($id)
    {
        $pageModel = new Page();
        $pageModel->deletePage($id);
        // Redirection ou message de succès
    }
}
