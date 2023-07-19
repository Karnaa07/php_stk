<link rel="stylesheet" href="../css/article/show_articles.css">

<h1 class="page-title">Liste des articles</h1>
<div class="article-container">
  <?php foreach ($articles as $article) : ?>
    <div class="article-card">
      <a href="/show_one_article?id=<?php echo $article->getId(); ?>" class="article-link"> <!-- Lien vers la page de l'article avec l'ID en paramètre -->
        <div class="content">
          <p class="date"><?php echo date('M j, Y', strtotime($article->getCreatedAt())); ?></p>
          <p class="title"><?php echo $article->getTitle(); ?></p>
          <p><?php echo $article->getSlug(); ?></p>
        </div>
        <?php if ($article->getImageUrl()) : ?>
          <img src="<?php echo $article->getImageUrl(); ?>" alt="article-cover" />
        <?php else : ?>
          <img src="https://www.immobilieredelahalle.fr/wp-content/themes/realestate-7/images/no-image.png" alt="article-cover" />
        <?php endif; ?>
      </a>
    </div>
  <?php endforeach; ?>
</div>