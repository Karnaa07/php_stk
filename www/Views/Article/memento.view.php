<h1>Mementos de l'article</h1>
<div class="memento-container">
    <?php while ($row = $article_memento->fetch()): ?>
        <div class="memento-card">
            <p>Date du memento : <?php echo date('M j, Y', strtotime($row->getDateMemento())); ?></p>
            <p>Titre : <?php echo $row->getTitle(); ?></p>
            <p>Contenu : <?php echo $row->getContent(); ?></p>
            <p>Slug : <?php echo $row->getSlug(); ?></p>
            <a href="/dashboard/restore-article?id_article=<?php echo $row->getId(); ?>">Restaurer</a>
        </div>
    <?php endwhile; ?>
</div>
