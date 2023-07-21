<link rel="stylesheet" href="../css/article/show_one_article.css">
<link rel="stylesheet" href="/../css//commentForm.css">

<?php if ($article->getImageUrl()) : ?>
    <img class="article-banner" src="<?php echo $article->getImageUrl(); ?>" alt="article-cover" />
<?php else : ?>
    <img class="article-banner" src="https://www.immobilieredelahalle.fr/wp-content/themes/realestate-7/images/no-image.png" alt="article-cover" />
<?php endif; ?>

<div class="container">
    <h1 class="article-title"><?php echo $article->getTitle(); ?></h1>
    <p class="article-date"><?php echo date('M j, Y', strtotime($article->getCreatedAt())); ?></p>
    <p class="article-content"><?php echo $article->getContent(); ?></p>

    <!-- <h2>Ajouter un commentaires</h2> -->

    <!-- Afficher le formulaire de commentaires -->
    <!-- <?php $this->partial("form", $form, $formErrors) ?> -->

    <!-- Afficher les commentaires existants -->
    
    <!-- // MODIF ICI -->

    <div class="comment-list-container">
    <h3>Commentaires :</h3>
    <ul class="comment-list">
    <?php if (is_array($comments) && null !== $comments && count($comments) > 0): ?>
            <?php foreach ($comments as $comment): ?>
                <li class="comment">
                    <!-- Afficher les informations du commentaire ici -->
                    <p class="author"><?php echo htmlspecialchars($comment->getNom()); ?></p>
                    <p class="date"><?php echo date_format(new DateTime($comment->getDateCreation()), 'd/m/Y H:i:s'); ?></p>
                    <p class="content"><?php echo nl2br(htmlspecialchars($comment->getCommentaire())); ?></p>
                </li>

                
            <?php endforeach; ?>
        <?php else: ?>
            <li class="comment">
                Aucun commentaire trouvé.
            </li>
        <?php endif; ?>
    </ul>
</div>

    <?php if (!empty($formErrors)): ?>
        <?php print_r($formErrors); ?>
    <?php endif; ?>
</div>