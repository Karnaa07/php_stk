    <style>
        body {
            
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .comment-list {
            list-style-type: none;
            padding: 0;
        }

        .comment {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 10px;
        }

        .comment .author {
            font-weight: bold;
            color: #007bff;
        }

        .comment .date {
            font-size: 0.8em;
            color: #666;
        }

        .comment .content {
            margin-top: 5px;
        }

    </style>
    <h1>Commentaires</h1>

    <?php $this->partial("form", $form, $formErrors) ?>

    <ul class="comment-list">
    <?php if (isset($comments) && count($comments) > 0): ?>
        <?php foreach ($comments as $comment): ?>
            <li class="comment">
                <!-- Afficher les informations du commentaire ici -->
                <p class="author"><?php echo htmlspecialchars($comment['nom']); ?></p>
                <p class="date"><?php echo date_format(new DateTime($comment['date_creation']), 'd/m/Y H:i:s'); ?></p>
                <p class="content"><?php echo nl2br(htmlspecialchars($comment['commentaire'])); ?></p>

                <?php if (!$comment['is_reported']): ?>
                    <!-- Formulaire de signalement -->
                    <form action="" method="post">
                        <input type="hidden" name="commentId" value="<?php echo $comment['id']; ?>">
                        <label for="reason">Raison du signalement :</label>
                        <select id="reason" name="reason">
                            <option value="insultes">Insultes</option>
                            <option value="messages_incorrects">Messages incorrects</option>
                            <option value="autre">Autre</option>
                        </select>
                        <button type="submit">Signaler</button>
                    </form>
                <?php else: ?>
                    <!-- Message indiquant que le commentaire a déjà été signalé -->
                    <p class="reported-message">Ce commentaire a été signalé.</p>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li class="comment">
            Aucun commentaire trouvé.
        </li>
    <?php endif; ?>
</ul>