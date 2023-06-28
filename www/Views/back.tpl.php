<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Super site</title>
        <meta name="description" content="ceci est un super site">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp">
        <link rel="stylesheet" type="text/css" href="../src/style.css">
        <script src= "../src/script.js"></script>
    </head>
    <body>
        <h1>Template Back</h1>
        <div class="dashboard-container">
            <div class="main-sidebar">
                <div class="aside-header">
                    <div class="brand">
                        <img src="../Assets/img/KC.png" alt="">
                    </div>
                </div>


                <div class="sidebar">
                    <ul class="list-items">
                        <li class="item">
                            <a href="#">
                                <span class="material-icons-sharp">
                                    dashboard
                                </span>
                                <span>Tableau de Bord</span>
                            </a>
                        </li>
                        <li class="item">
                            <a href="#">
                                <span class="material-icons-sharp">
                                    perm_media
                                </span>
                                <span>Média</span>
                            </a>
                        </li>
                        <li class="item">
                            <a href="#">
                                <span class="material-icons-sharp">
                                    extension
                                </span>
                                <span>Plugin</span>
                            </a>
                        </li>
                        <li class="item">
                            <a href="#">
                                <span class="material-icons-sharp">
                                    pages
                                </span>
                                <span>Pages</span>
                            </a>
                        </li>
                        <li class="item">
                            <a href="#">
                                <span class="material-icons-sharp">
                                    border_color
                                </span>
                                <span>Articles</span>
                            </a>
                        </li>
                        <li class="item">
                            <a href="#">
                                <span class="material-icons-sharp">
                                    category
                                </span>
                                <span>Catégories</span>
                            </a>
                        </li>
                        <li class="item">
                            <a href="#">
                                <span class="material-icons-sharp">
                                    person
                                </span>
                                <span>Utilisateurs</span>
                            </a>
                        </li>
                        <li class="item">
                            <a href="#">
                                <span class="material-icons-sharp">
                                    support_agent
                                </span>
                                <span>Assistances</span>
                            </a>
                        </li>
                        <li class="item">
                            <a href="#">
                                <span class="material-icons-sharp">
                                    support
                                </span>
                                <span>Réglages</span>
                            </a>
                        </li>
                        <li class="item">
                            <a href="/logout">
                                <span class="material-icons-sharp">
                                    logout
                                </span>
                                <span>Quitter</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-container">
                <?php include $this->view;?>
            </div>
            <div class="extrabar">
                <div class="header-menu">
                    <button class="toggle-menu-btn" id="open-menu">
                    <span class="material-icons-sharp">
                            menu
                    </span>
                    </button>
                    <div class="profile">
                        <div class="profile-info">
                            <p>Salut, <strong> <?= $pseudo?> </strong></p>
                            <small>Admin</small>
                        </div>
                        <div class="profile-image">
                            <img src="../Assets/img/mirio.jpg" alt="" width="100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <!-- inclure la vue -->
    <?php include $this->view;?>

    <script src= "../src/script.js"></script>

    <!-- Utilisation de la variable $action -->
    <p>Action: <?= $action; ?></p>

</body>

</html>