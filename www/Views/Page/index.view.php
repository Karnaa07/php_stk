
  <h1>Liste des pages</h1>
  <ul>
    <?php foreach ($pages as $page) : ?>
      <li>
        <h2><?php echo $page->getTitle(); ?></h2>
        <p><?php echo $page->getContent(); ?></p>
      </li>
    <?php endforeach; ?>
  </ul>