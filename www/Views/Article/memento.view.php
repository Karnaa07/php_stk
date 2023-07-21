<link rel="stylesheet" href="../css/article/memento_article.css">

<h1>Mementos de l'article</h1>
<div class="memento-container">
    <?php while ($row = $article_memento->fetch()): ?>
        <div class="memento-card">
            <table>
                <tr>
                    <th>Date du memento :</th>
                    <td><?php echo date('M j, Y', strtotime($row->getDateMemento())); ?></td>
                </tr>
                <tr>
                    <th>Titre :</th>
                    <td><?php echo $row->getTitle(); ?></td>
                </tr>
                <tr>
                    <th>Contenu :</th>
                    <td><?php echo substr($row->getContent(), 0, 150); ?></td>
                </tr>
                <tr>
                    <th>Slug :</th>
                    <td><?php echo $row->getSlug(); ?></td>
                </tr>
            </table>
            <a class="btn" href="/dashboard/restore-article?id_article=<?php echo $row->getId(); ?>">Restaurer</a>
        </div>
    <?php endwhile; ?>
</div>
