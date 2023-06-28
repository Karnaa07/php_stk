<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\User;

class UserCrud
{
    public function index(): void
    {
        $userModel = new User();
        $limit = 20; // Nombre d'utilisateurs à afficher par page
        $page = $_GET['page'] ?? 1; // Récupérer le numéro de page à partir de la requête, par exemple, à l'aide de la superglobale $_GET
        $offset = ($page - 1) * $limit; // Calculer le décalage en fonction du numéro de page
    
        $users = $userModel->all($limit, $offset);
    
        $action = "index";

        $pseudo = $_SESSION["firstname"];
        $view = new View("user", "back");
        $view->assign("pseudo", $pseudo);
        $view->assign("users", $users);
        $view->assign("action", $action);
        //$view->render();
    }
    


    public function create()
    {
        // Afficher le formulaire de création d'utilisateur
        $view = new View("Auth/register", "front");
        $view->render();
    }

    public function store()
    {
        // Récupérer les données du formulaire
        $data = $_POST;

        // Créer une instance du modèle User
        $user = new User();

        // Renseigner les propriétés de l'utilisateur à partir des données reçues
        $user->setFirstname($data['firstname']);
        $user->setLastname($data['lastname']);
        $user->setEmail($data['email']);
        $user->setPwd($data['password']);
        $user->setCountry($data['country']);
        $user->setStatus(0);

        // Enregistrer l'utilisateur dans la base de données
        $user->save();

        // Rediriger vers la liste des utilisateurs ou afficher un message de succès
        header('Location: /users');
        exit();
    }

    public function edit($id)
    {
        // Récupérer l'utilisateur à modifier depuis la base de données
        $user = User::find($id);

        // Vérifier si l'utilisateur existe
        if (!$user) {
            // Gérer l'erreur, utilisateur non trouvé
        }

        // Afficher le formulaire de modification d'utilisateur avec les données de l'utilisateur
        $view = new View("users-edit", "back");
        $view->assign("user", $user);
        $view->render();
    }

    public function update($id)
    {
        // Récupérer l'utilisateur à mettre à jour depuis la base de données
        $user = User::find($id);

        // Vérifier si l'utilisateur existe
        if (!$user) {
            // Gérer l'erreur, utilisateur non trouvé
        }

        // Récupérer les données du formulaire
        $data = $_POST;

        // Mettre à jour les propriétés de l'utilisateur à partir des données reçues
        $user->setFirstname($data['firstname']);
        $user->setLastname($data['lastname']);
        $user->setEmail($data['email']);
        $user->setPwd($data['password']);
        $user->setCountry($data['country']);

        // Enregistrer les modifications de l'utilisateur dans la base de données
        $user->save();

        // Rediriger vers la liste des utilisateurs ou afficher un message de succès
        header('Location: /users');
        exit();
    }

    public function delete($id)
    {
        // Récupérer l'utilisateur à supprimer depuis la base de données
        $user = User::find($id);

        // Vérifier si l'utilisateur existe
        if (!$user) {
            // Gérer l'erreur, utilisateur non trouvé
        }

        // Supprimer l'utilisateur de la base de données
        $user->delete();

        // Rediriger vers la liste des utilisateurs ou afficher un message de succès
        header('Location: /users');
        exit();
    }
}
