<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Validator;
use App\Core\AuthMiddleware;
use App\Forms\Register;
use App\Forms\UpdateForm;
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
    $form = new Register();
    $view = new View("Auth/register", "auth");
    $view->assign("form", $form->getConfig());

    // Formulaire soumis et valide ?
    if ($form->isSubmited() && $form->isValid()) {
        $user = new User();
        $user->setFirstname($_POST["firstname"]);
        $user->setLastname($_POST["lastname"]);
        $user->setEmail($_POST["email"]);
        $user->setPwd($_POST["pwd"]);
        $user->setRoleId(2);
        $user->setCountry("FR");

        // Vérifier si l'email existe déjà dans la base de données
        $email = $_POST["email"];
        $existingUser = $user->getOneWhere(["email" => $email]);

        if (!Validator::checkEmail($_POST["email"])) {
            echo "L'adresse email n'est pas valide.";
            return;
        }
        
        if ($existingUser) {
            echo "Cet email est déjà utilisé !";
            return;
        }
        
        if (!Validator::checkPassword($_POST["pwd"])) {
            echo "Votre mot de passe doit faire au minimum 8 caractères avec des minuscules, des majuscules et des chiffres.";
            return;
        }
        
        if ($_POST["pwd"] !== $_POST["pwdConfirm"]) {
            echo "Les mots de passe ne correspondent pas.";
            return;
        }
        
        // Si toutes les conditions sont vérifiées, enregistrez l'utilisateur et affichez un message de succès
        $user->save();
        echo "Votre compte a bien été créé. Vous allez être redirigé vers la page de connexion.";
        header('Refresh: 2; URL=/login');
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
      $userModel = new User();
      $user = $userModel->find($id);
      //var_dump($user);

      // Vérifier si l'utilisateur existe
      if (!$user) {
          // Gérer l'erreur, utilisateur non trouvé
      }

      // Instanciation de la classe UpdateForm
      $updateForm = new UpdateForm();
      

      // Obtention de la configuration du formulaire
      
      
      // Charger la vue avec le formulaire d'UDAPE et les données de l'utilisateur
      $view = new View("user", "auth");
      $view->assign("user", $user);
      $view->assign("updateForm", $updateForm->getConfig());
      $view->assign("action", "edit"); // Ajouter cette ligne pour définir la valeur de $action
      // $view->render();
      if ($updateForm->isSubmited() && $updateForm->isValid()) {
          $user = new User();
          $user= $user->populate($id);
          $user->setFirstname($_POST["firstname"]);
          $user->setLastname($_POST["lastname"]);
          $user->setEmail($_POST["email"]);
          $user->setPwd($_POST["pwd"]);
          $user->setCountry("FR");
          $user->save();
  
      }
  }


  public function delete()
    {
        $id = $_GET['id'];

        // Récupérer l'utilisateur à supprimer depuis la base de données
        $user = \App\Models\User::populate($id);

        if (!$user) {
            echo "Utilisateur non trouvé.";
            exit();
        }

        // Supprimer l'utilisateur de la base de données en utilisant la méthode delete de l'objet User
        $user->delete();

        // Rediriger vers la liste des utilisateurs ou afficher un message de succès
        header('Location: /users');
        exit();
    }
}
