<link rel="stylesheet" type="text/css" href="../css/user.css">
<?php if ($action === 'index'): ?>
    <div class="crud-container">
        <h1 class="crud-header">Liste des commentaires</h1>
        <table class="crud-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Commentaire</th>
                    <th>Date de création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comments as $comment): ?>
                    <tr>
                        <td><?= $comment['nom']; ?></td>
                        <td><?= $comment['email']; ?></td>
                        <td><?= $comment['commentaire']; ?></td>
                        <td><?= $comment['date_creation']; ?></td>
                        <td class="crud-actions">
                            <a href="/commentaires-approve?id=<?= $comment['id']; ?>">
                                <span class="material-icons-sharp">
                                    check_circle
                                </span>
                            </a>
                            <a href="/commentaires-delete?id=<?= $comment['id']; ?>">
                                <span class="material-icons-sharp">
                                    delete
                                </span>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    
        <div class="crud-create"></div>
    </div>

<?php elseif ($action === 'create'): ?>
    <div class="crud-container">
        <h1 class="crud-header">Créer un commentaire</h1>

        <div class="crud-form">
            <?php echo $form->render(); ?>
        </div>
    </div>

<?php elseif ($action === 'edit'): ?>
    <link rel="stylesheet" type="text/css" href="../css/register.css">
    <div class="crud-container">
        <h1 class="crud-header">Modifier un commentaire</h1>

        <div class="crud-form">
            <!-- Afficher le formulaire d'édition du commentaire ici -->
            <!-- Utiliser $comment pour récupérer les données du commentaire à modifier -->
        </div>

        <div class="crud-back">
            <a href="/commentaires" class="btn btn-primary">Retour à la liste des commentaires</a>
        </div>
    </div>

<?php elseif ($action === 'delete'): ?>
    <div class="crud-container">
        <h1 class="crud-header">Supprimer un commentaire</h1>
        <!-- Afficher le contenu du commentaire à supprimer ici -->
    </div>
<?php endif; ?>