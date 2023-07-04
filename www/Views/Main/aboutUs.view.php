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
                        <p>Contenu de la page À propos de nous...</p>
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

