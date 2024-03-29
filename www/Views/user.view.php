<?php if ($action === 'index') : ?>
    <link rel="stylesheet" type="text/css" href="/css/users/user.css">
    <div class="crud-container">
        <h1 class="crud-header">Liste des utilisateurs</h1>
        <table class="crud-table">
            <thead>
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Pays</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $user['firstname']; ?></td>
                        <td><?= $user['lastname']; ?></td>
                        <td><?= $user['email']; ?></td>
                        <td><?= $user['country']; ?></td>
                        <td><?= $user['role_name']; ?></td>
                        <td class="crud-actions">
                            <a href="/dashboard/users-update/?id=<?= $user['id']; ?>">
                                <span class="material-icons-sharp">
                                    create
                                </span>
                            </a>
                            <a href="/dashboard/users-delete?id=<?= $user['id']; ?>">
                                <span class="material-icons-sharp">
                                    delete
                                </span>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="crud-create">
            <a href="/dashboard/users-create">Créer un utilisateur</a>
        </div>
    </div>

<?php elseif ($action === 'create') : ?>
    <link rel="stylesheet" type="text/css" href="../css/auth/register.css">
    <div class="crud-container">
        <h1 class="crud-header">Créer un utilisateur</h1>

        <div class="crud-form">
            <?php echo $form->render(); ?>
        </div>
    </div>

<?php elseif ($action === 'edit') : ?>
    <link rel="stylesheet" type="text/css" href="/css/users/edit.css">
    <div class="crud-container">
        <div class="crud-form">
            <h1 class="form-title">Modifier un utilisateur</h1> <!-- Titre centré en haut du formulaire -->

            <?php //$updateForm->renderForm(); 
            ?>
            <?php $this->partial('form', $updateForm, $formValues); ?>

            <div class="crud-back">
                <a href="/dashboard/users" class="btn btn-primary">
                    <span class="material-icons-sharp">
                        arrow_back
                    </span>
                </a>
            </div>
        </div>
    </div>

<?php elseif ($action === 'delete') : ?>
    <div class="crud-container">
        <h1 class="crud-header">Supprimer un utilisateur</h1>
    </div>
<?php endif; ?>