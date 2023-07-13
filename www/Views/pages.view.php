<!-- pages.view.php -->
<!DOCTYPE html>

<?php if ($action === 'index'): ?>
    <h1>Liste des pages</h1>
    <link rel="stylesheet" type="text/css" href="/css/page.css">
    <div class="container">
        <a href="/create-page" id="create-page-btn" class="button">
          <div class="plate"></div>
          <div class="plate"></div>
          <div class="plate"></div>
          <div class="plate"></div>
          <div class="plate"></div>
          <div class="button__wrapper">
            <span class="button__text" id="create-page-button">Créer une page</span>
          </div>
          <div class="button__box">
            <div class="inner inner__top"></div>
            <div class="inner inner__front"></div>
            <div class="inner inner__bottom"></div>
            <div class="inner inner__back"></div>
            <div class="inner inner__left"></div>
            <div class="inner inner__right"></div>
          </div>
        </a>
      </div><br><br>
    <table>
        <thead>
            <tr>
                <th>Auteur</th>
                <th>Date</th>
                <th>Titre</th>
                <th>Thème</th>
                <th>Couleur</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pages as $page): ?>
            <tr>
                <td><?= $page['author']; ?></td>
                <td><?= $page['date']; ?></td>
                <td><?= $page['title']; ?></td>
                <td><?= $page['theme']; ?></td>
                <td><?= $page['color']; ?></td>
                <td>
                    <a href="/pages-update/?id=<?= $page['id']; ?>">Modifier</a>
                    <a href="/pages-delete?id=<?= $page['id']; ?>">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
      
    <!-- <a href="/pages-create" class="btn btn-primary">Créer une page</a> -->

  <?php elseif ($action === 'create'): ?>
    <link rel="stylesheet" type="text/css" href="/css/createPageform.css">
    <h1>Créer une page</h1>

    <?php echo  $this->partial("form", $form) ?>

    <script src="https://cdn.tiny.cloud/1/9i4ty3dj7s5dyw4g2xbzg2u7udwf4mliqo7r71asossk42gb/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        //check if the form is submitted
        


        tinymce.init({
            selector: '.wysiwyg',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
    

    <a href="/pages" class="btn btn-primary">Retour à la liste des Pages</a>


<?php elseif ($action === 'edit'): ?>
    <link rel="stylesheet" type="text/css" href="../css/register.css">
    <h1>Modifier une page</h1>

    <!-- Afficher le formulaire -->
    <?php echo $updateForm->renderForm(); ?>

    <a href="/pages" class="btn btn-primary">Retour à la liste des pages</a>

<?php elseif ($action === 'delete'): ?>
    <h1>Supprimer une page</h1>

<?php endif; ?>
