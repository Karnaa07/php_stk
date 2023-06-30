<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\User;
use App\Forms\Register;
use App\Forms\UpdateForm;



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
        $form = new Register();
        $view = new View("Auth/register", "front");
        $view->assign("form", $form->getConfig());
    
        // Formulaire soumis et valide ?
        if ($form->isSubmited() && $form->isValid()) {
            $user = new User();
            $user->setFirstname($_POST["firstname"]);
            $user->setLastname($_POST["lastname"]);
            $user->setEmail($_POST["email"]);
            $user->setPwd($_POST["pwd"]);
            $user->setCountry("FR");
    
            // Vérifier si l'email existe déjà dans la base de données
            $email = $_POST["email"];
            $existingUser = $user->getOneWhere(["email" => $email]);
    
            if ($existingUser) {
                echo "Cet email est déjà utilisé !";
            } else {
                $user->save();
                echo "Votre compte a bien été créé !";
                header('Location: /users');
                exit();
            }
        }
        
        $view->assign("formErrors", $form->errors);
    }
    


    public function store()
    {
        $form = new Register();
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

    public function edit()
    {
        $id = $_GET['id'];

        // Récupérer l'utilisateur à modifier depuis la base de données
        $user = User::find($id);
        //var_dump($user);

        // Vérifier si l'utilisateur existe
        if (!$user) {
            // Gérer l'erreur, utilisateur non trouvé
        }

        // Instanciation de la classe UpdateForm
        $updateForm = new UpdateForm();
        

        // Obtention de la configuration du formulaire
        
        
        // Charger la vue avec le formulaire d'UDAPE et les données de l'utilisateur
        $view = new View("user", "back");
        $view->assign("user", $user);
        $view->assign("updateForm", $updateForm->getConfig());
        $view->assign("action", "edit"); // Ajouter cette ligne pour définir la valeur de $action
       // $view->render();
        if ($updateForm->isSubmited() && $updateForm->isValid()) {
            echo "Le formulaire est valide.";
            $user = new User();
            $user= $user->populate($id);
            $user->setFirstname($_POST["firstname"]);
            $user->setLastname($_POST["lastname"]);
            $user->setEmail($_POST["email"]);
            $user->setPwd($_POST["pwd"]);
            $user->setCountry("FR");
            $user->save();
    
        }
        else{
            echo "Le formulaire est invalide.";
        }
    }


    public function delete()
    {
        $id = $_GET['id'];
    
        // Récupérer l'utilisateur à supprimer depuis la base de données
        $user = \App\Core\SQL::getInstance()->populate($id);
    
        if (!$user) {
            echo "Utilisateur non trouvé.";
            exit();
        }
    
        // Supprimer l'utilisateur de la base de données en utilisant la fonction deleteWhere()
        \App\Core\SQL::getInstance()->deleteWhere(["id" => $id]);
    
        // Rediriger vers la liste des utilisateurs ou afficher un message de succès
        header('Location: /users');
        exit();
    }
    




}
    // public function update($id)
    // {
    //     // Récupérer l'utilisateur à mettre à jour depuis la base de données
    //     $user = User::find($id);

    //     // Vérifier si l'utilisateur existe
    //     if (!$user) {
    //         // Gérer l'erreur, utilisateur non trouvé
    //         echo "Utilisateur non trouvé.";
    //         exit();
    //     }

    //     // Récupérer les données du formulaire
    //     $data = $_POST;

    //     // Valider les données du formulaire
    //     $updateForm = new UpdateForm();
    //     $validationResult = $updateForm->validate($data);

    //     if (!$validationResult['isValid']) {
    //         // Gérer l'erreur de validation du formulaire
    //         echo "Erreur de validation du formulaire.";
    //         exit();
    //     }

    //     // Mettre à jour les propriétés de l'utilisateur à partir des données reçues
    //     $user->setFirstname($data['firstname']);
    //     $user->setLastname($data['lastname']);
    //     $user->setEmail($data['email']);
    //     $user->setPwd($data['pwd']);
    //     $user->setCountry($data['country']);

    //     // Enregistrer les modifications de l'utilisateur dans la base de données
    //     $user->save();

    //     // Afficher le formulaire de mise à jour dans la vue
    //     $updateForm->renderForm();

    //     // Rediriger vers la liste des utilisateurs ou afficher un message de succès
    //     header('Location: /users');
    //     exit();
        
    // }
    