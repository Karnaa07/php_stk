<link rel="stylesheet" href="/../css/article/index.css">
<div class="container">
  <h1 class="title"><?= $title ?></h1>

  <!-- Bouton pour créer un nouvel article -->
  <a href="/dashboard/create-article" class="btn btn-primary">Créer un article</a>

  <!-- Tableau pour afficher la liste des articles -->
  <table class="article-list">
    <thead>
      <tr>
        <th>Titre</th>
        <th>Date de création</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($articles as $article) : ?>
        <tr>
          <td><?= $article->getTitle() ?></td>
          <td><?= $article->getCreatedAt() ?></td>
          <td>
            <a href="/dashboard/update-article?id=<?= $article->getId() ?>">
              <span class="btn material-icons-sharp">
                create
              </span>
            </a>
            <a href="/dashboard/restore-article?id=<?= $article->getId() ?>">
              <span class="btn material-icons-sharp">
                history
              </span>
            </a>
            <a href="/dashboard/delete-article?id=<?= $article->getId() ?>">
              <span class="btn btn-danger material-icons-sharp">
                delete
              </span>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>