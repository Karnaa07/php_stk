<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Super site</title>
    <meta name="description" content="ceci est un super site">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="../src/style.css">
    <script src="../src/script.js"></script>
    <script src="../js/auth.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="dashboard-container">
        <div class="main-sidebar">
            <div class="sidebar">
                <ul class="list-items">
                    <li class="item">
                        <a href="/dashboard">
                            <span class="material-icons-sharp">
                                dashboard
                            </span>
                            <span>Tableau de Bord</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="/">
                            <span class="material-icons-sharp">
                                home
                            </span>
                            <span>Mon site</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="/dashboard/pages">
                            <span class="material-icons-sharp">
                                pages
                            </span>
                            <span>Pages</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href=" /dashboard/articles">
                            <span class="material-icons-sharp">
                                border_color
                            </span>
                            <span>Articles</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="/dashboard/users">
                            <span class="material-icons-sharp">
                                person
                            </span>
                            <span>Utilisateurs</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="/dashboard/commentaires">
                            <span class="material-icons-sharp">
                                support_agent
                            </span>
                            <span>Commentaires</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="/dashboard/settings">
                            <span class="material-icons-sharp">
                                support
                            </span>
                            <span>Réglages</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="#" onclick="confirmLogout()">
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
            <?php include $this->view; ?>
        </div>
        <div class="extrabar">
            <div class="header-menu">
                <div class="profile">
                    <div class="profile-image">
                        <img src="../assets/img/mirio.jpg" alt="" width="100%">
                    </div>
                    <div class="profile-info">
                        <strong> <?= $pseudo ?> </strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>