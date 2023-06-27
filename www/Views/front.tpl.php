<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $pageTitle ?></title>
    <meta name="description" content="ceci est un super site">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp">



    <link rel="stylesheet" type="text/css" href="../src/style.css">
</head>
<body>
   <!-- <h1><?= $h1Title ?></h1> -->

    <!-- inclure la vue -->
    <?php include $this->view;?>


    <script src= "../src/script.js"></script>
</body>
</html>