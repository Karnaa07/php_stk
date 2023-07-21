<link rel="stylesheet" href="/../css/commentForm.css">
    <h1>Commentaires</h1>
<div class="comment-form-comments">
    <?php $this->partial("form", $form, $formErrors) ?>
    </div>

    <!-- MODIFF ICI -->
<ul class="comment-list">
    <?php if (isset($comments) && count($comments) > 0): ?>
        <?php foreach ($comments as $comment): ?>
            <li class="comment">
                <!-- Afficher les informations du commentaire ici -->
                <p class="author"><?php echo htmlspecialchars($comment['nom']); ?></p>
                <p class="date"><?php echo date_format(new DateTime($comment['date_creation']), 'd/m/Y H:i:s'); ?></p>
                <p class="content"><?php echo nl2br(htmlspecialchars($comment['commentaire'])); ?></p>

                <?php if (!$comment['is_approved']): ?>
                    <?php if (!$comment['is_reported']): ?>
                        <!-- Formulaire de signalement -->
                        <form id="form-signalement" action="" method="post">
                            <input type="hidden" name="commentId" value="<?php echo $comment['id']; ?>">
                            <label for="reason">Raison du signalement :</label>
                            <select id="reason" name="reason">
                                <option value="insultes">Insultes</option>
                                <option value="messages_incorrects">Messages incorrects</option>
                                <option value="autre">Incitation à la haine</option>
                            </select>
                            <button type="submit" >Signaler</button>
                        </form>
                    <?php endif; ?>
                <?php else: ?>
                    <!-- Afficher un message indiquant que le commentaire a été approuvé -->
                    
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li class="comment">
            Aucun commentaire trouvé.
        </li>
    <?php endif; ?>
</ul>
