<div class="page-transition">
    <section id="about" class="section-full gray-bg">
        <?php
        if (isset($pseudo)) {
            echo "<p>Bienvenue, $pseudo !</p>";
        } else {
            echo "<p>Connectez-vous pour voir votre pseudo.</p>";
        }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <h2>À propos de nous</h2>
                        <p>Découvrez qui nous sommes et ce que nous faisons.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-text">
                        <p>Nous sommes un groupe de trois étudiants passionnés d'informatique, composé de Joël, Clément et Quentin. Actuellement en Bachelor en Ingénierie du Web, nous avons créé ce CMS (Système de Gestion de Contenu) dans le cadre de notre projet de fin d'année.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <h2>Notre parcours</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-text">
                        <p>Joël, Clément et Quentin partagent une passion commune pour la technologie et le développement web. Nous avons décidé de poursuivre nos études en Ingénierie du Web pour approfondir nos connaissances et acquérir de nouvelles compétences dans le domaine.
                            Pendant notre parcours académique, nous avons étudié divers sujets liés au développement web, tels que la conception d'interfaces utilisateur, le développement frontend et backend, la sécurité des applications web,
                            ainsi que la gestion de projets. Nous avons également eu l'opportunité d'explorer des langages de programmation populaires tels que HTML, CSS, JavaScript, PHP.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <h2>Notre projet CMS</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-text">
                        <p>Notre projet de cette année était de créer un CMS personnalisé, un outil puissant et polyvalent pour la gestion de contenu en ligne. Nous avons consacré de nombreuses heures à concevoir et développer cette solution afin de répondre aux besoins spécifiques du web moderne.
                            Ce CMS que nous avons développé offre une interface conviviale et intuitive pour permettre aux utilisateurs de gérer facilement leur contenu en ligne. Il dispose de fonctionnalités telles que la création, la modification et la suppression d'articles,
                            la gestion des utilisateurs et des autorisations, ainsi qu'un système de thèmes personnalisables.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <h2>Notre objectif</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-text">
                        <p>Notre objectif principal était de valider notre année universitaire en réalisant un projet concret et significatif. Cependant, au-delà de cet objectif, nous avons souhaité créer une solution qui puisse être utile pour d'autres personnes et organisations cherchant un CMS flexible et adapté à leurs besoins.
                            En partageant notre CMS avec vous, nous espérons vous offrir une expérience de gestion de contenu agréable et efficace. Vos commentaires et suggestions sont les bienvenus, car nous souhaitons continuer à améliorer cette plateforme pour répondre aux besoins changeants du web.
                            Merci de visiter notre page "À propos de nous" et de prendre le temps de découvrir notre CMS. Si vous avez des questions ou des remarques, n'hésitez pas à nous contacter. Nous sommes impatients de vous aider et de partager notre passion pour l'ingénierie web avec vous.
                            <br>
                            <br>
                            Cordialement,
                            <br>
                            <br>
                            Joël, Clément et Quentin
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .page-transition {
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0s linear 0.3s;
    }

    .page-transition.active {
        opacity: 1;
        visibility: visible;
        transition-delay: 0s;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            document.querySelector('.page-transition').classList.add('active');
        }, 100);
    });
</script>