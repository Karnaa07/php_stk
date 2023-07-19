<link rel="stylesheet" href="../css/article/show_one_article.css">

<?php if ($article->getImageUrl()) : ?>
    <img class="article-banner" src="<?php echo $article->getImageUrl(); ?>" alt="article-cover" />
  <?php else : ?>
    <img class="article-banner" src="https://www.immobilieredelahalle.fr/wp-content/themes/realestate-7/images/no-image.png" alt="article-cover" />
  <?php endif; ?>
<div class="container">
  
  <h1 class="article-title"><?php echo $article->getTitle(); ?></h1>
  <p class="article-date"><?php echo date('M j, Y', strtotime($article->getCreatedAt())); ?></p>
  <p class="article-content"><?php echo $article->getContent(); ?></p>
</div>