<link rel="stylesheet" type="text/css" href="../css/comment_gestion.css">
<?php if ($action === 'index'): ?>
    <div class="crud-container">
        <h1 class="crud-header">Liste des commentaires</h1>
        <?php include_once 'commentairesList.tpl.php'; ?>

        <div class="crud-comment-reported">
            <a href="/dashboard/commentaires-reported">Voir les commentaires signalés</a>
        </div>
    </div>
<?php elseif ($action === 'showReportedComments') : ?>
    <div class="crud-container">
        <h1 class="crud-header">Commentaires signalés</h1>
        <?php include_once 'commentairesList.tpl.php'; ?>

        <div class="crud-back">
            <a href="/dashboard/commentaires" class="btn btn-primary">Retour à la liste des commentaires</a>
        </div>
    </div>
<?php elseif ($action === 'delete'): ?>
    <div class="crud-container">
        <h1 class="crud-header">Supprimer un commentaire</h1>
        <!-- Afficher le contenu du commentaire à supprimer ici -->
    </div>
<?php endif; ?>