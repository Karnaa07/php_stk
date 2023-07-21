<table class="crud-table comment-card">
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
                    <a href="/dashboard/commentaires-approve?id=<?= $comment['id']; ?>">
                        <span class="btn material-icons-sharp">
                            check_circle
                        </span>
                    </a>
                    <a  href="/dashboard/commentaires-delete?id=<?= $comment['id']; ?>">
                        <span class="btn btn-danger material-icons-sharp">
                            delete
                        </span>
                    </a>
                    
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>