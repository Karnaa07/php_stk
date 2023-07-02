<!-- views/user.view.php -->

<?php if ($action === 'index'): ?>
    <h1>Liste des utilisateurs</h1>
    <link rel="stylesheet" type="text/css" href="/css/formCrud.css">
    <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Pays</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['firstname']; ?></td>
                <td><?= $user['lastname']; ?></td>
                <td><?= $user['email']; ?></td>
                <td><?= $user['country']; ?></td>
                <td>
                
                <a href="/users-update/?id=<?= $user['id']; ?>">Modifier</a>

                <a href="/users-delete?id=<?= $user['id']; ?>">Supprimer</a>

                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <a href="/users-create"class="btn btn-primary">Créer un utilisateur</a>

<?php elseif ($action === 'create'): ?>
    <h1>Créer un utilisateur</h1>

    <?php echo $form->render(); ?>


<?php elseif ($action === 'edit'): ?>
    <link rel="stylesheet" type="text/css" href="../css/register.css">
    <h1>Modifier un utilisateur</h1>

    <!-- <a href="/users" class="btn btn-primary">Retour à la liste des utilisateurs</a> -->

    <!-- Afficher le formulaire -->
<?php //$updateForm->renderForm(); ?>
<?php $this->partial('form', $updateForm); ?>
<a href="/users" class="btn btn-primary">Retour à la liste des utilisateurs</a>
<?php elseif ($action === 'delete'): ?>
    <h1>Supprimer un utilisateur</h1>

<?php endif; ?>