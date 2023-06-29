<!-- views/user.view.php -->

<?php if ($action === 'index'): ?>
    <h1>Liste des utilisateurs</h1>

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

                <a href="/users/delete/?id=<?= $user['id']; ?>">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <a href="/users-create">Créer un utilisateur</a>

<?php elseif ($action === 'create'): ?>
    <h1>Créer un utilisateur</h1>

    <?php echo $form->render(); ?>

<?php elseif ($action === 'edit'): ?>
    <!-- <a href="/users-create">Créer un utilisateur</a> -->

    <h1>Modifier un utilisateur</h1>

    <form action="/users-update/<?= $user['id']; ?>" method="POST">
    <div>
        <label for="firstname">Prénom</label>
        <input type="text" name="firstname" id="firstname" value="<?= $user['firstname']; ?>">
    </div>
    <div>
        <label for="lastname">Nom</label>
        <input type="text" name="lastname" id="lastname" value="<?= $user['lastname']; ?>">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= $user['email']; ?>">
    </div>
    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
    </div>
    <div>
        <label for="country">Pays</label>
        <input type="text" name="country" id="country" value="<?= $user['country']; ?>">
    </div>
    <div>
        <button type="submit">Modifier</button>
    </div>
</form>

<a href="/users" class="btn btn-primary">Retour à la liste des utilisateurs</a>

<?php endif; ?>
