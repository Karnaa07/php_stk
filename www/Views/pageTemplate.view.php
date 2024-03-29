<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #f2f2f2;
            background-color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            font-size: 2.5em;
            color: #fff;
            text-align: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid #fff;
            border-radius: 10px;
        }

        p {
            font-size: 1.1em;
            margin-bottom: 10px;
            color: #f2f2f2;
        }

        /* Custom Header Style */
        header {
            background: <?= $color ?>;
            padding: 20px;
            color: white;
            text-align: center;
            position: relative;
            background-size: cover;
        }

        header::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 50px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23" + <?= str_replace("#", "", $color) ?> + "' fill-opacity='1' d='M0,64L48,96C96,128,192,192,288,202.7C384,213,480,171,576,144C672,117,768,107,864,106.7C960,107,1056,117,1152,138.7C1248,160,1344,192,1392,208L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E") no-repeat bottom;
        }
    </style>
</head>
<body>
    <header>
        <h1><?= $title ?></h1>
    </header>
    <div class="container">
        <p>Auteur : <?= $author ?></p>
        <p>Date : <?= $date ?></p>
        <p>Theme de l'article : <?= $theme ?></p>
        <p>Contenu : <?= $content_page ?></p>
    </div>
</body>
</html>
