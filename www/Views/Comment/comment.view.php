<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../css/login.css">
      <link rel="stylesheet" type="text/css" href="../css/user.css">
      <title>Comment</title>
    </head>
    <body>
      <h1>Comment</h1>
      <div class="container">
        <?php $this->partial("form", $form, $formErrors) ?>
      </div>
      <div class="crud-back">
            <a href="/article" class="btn btn-primary">Retour à la liste des articles</a>
        </div>
    </body>
  </html>
