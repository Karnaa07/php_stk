<h1>Liste des articles</h1>
  <ul>
    <?php foreach ($articles as $article) : ?>
      <li>
        <h2><?php echo $article->getTitle(); ?></h2>
        <p><?php echo $article->getContent(); ?></p>
      </li>
    <?php endforeach; ?>
  </ul>