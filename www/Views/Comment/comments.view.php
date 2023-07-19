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

    <?php if (isset($comments) && count($comments) > 0): ?>
    <?php foreach ($comments as $comment): ?>
        <div class="comment">
            <p class="author"><?php echo htmlspecialchars($comment['nom']); ?></p>
            <p class="date"><?php echo date_format(new DateTime($comment['date_creation']), 'd/m/Y H:i:s'); ?></p>
            <p class="content"><?php echo nl2br(htmlspecialchars($comment['commentaire'])); ?></p>
            <?php if (!$comment['is_reported']): ?>
                <!-- Bouton pour signaler le commentaire -->
                <form action=""<?php echo $comment['id']; ?>" method="POST">
                    <button type="submit">Signaler</button>
                </form>
            <?php else: ?>
                <!-- Message indiquant que le commentaire a déjà été signalé -->
                <p class="reported-message">Ce commentaire a été signalé.</p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucun commentaire trouvé.</p>
<?php endif; ?>