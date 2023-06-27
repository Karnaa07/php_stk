<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="../css/register.css">
      <title>Register</title>
    </head>
    <body>
      <h2>S'inscrire</h2>
      <div class="container">
        <?php $this->partial("form", $form, $formErrors) ?>
      </div>
    </body>
  </html>

