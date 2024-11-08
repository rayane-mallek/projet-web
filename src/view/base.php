<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php if ($controller == 'contact'): ?>
            <link rel="stylesheet" href="assets/css/contact.css">
        <?php elseif ($controller == 'description'): ?>
            <link rel="stylesheet" href="assets/css/description.css">
        <?php elseif ($controller == 'login'): ?>
            <link rel="stylesheet" href="assets/css/login.css">
        <?php else: ?>
            <link rel="stylesheet" href="assets/css/carousel.css">
            <link rel="stylesheet" href="assets/css/home.css">
        <?php endif; ?>

        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/print.css" media="print">
    </head>
    <body>
        <div class="wrapper">
            <header>
                <nav>
                    <img src="assets/img/terre_des_anges_logo2.png" alt="Logo Terre des Anges" class="logo">

                    <div class="burger" id="burger">
                        <!-- Span elements will have a border to draw a burger menu -->
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                    <div class="nav-links" id="navLinks">
                        <a href="?controller=home&action=index">Accueil</a>
                        <a href="?controller=description&action=index">Description</a>
                        <a href="?controller=contact&action=index">Contact</a>
                        <?php if (! $_SESSION['login']): ?>
                            <a href="?controller=user&action=login">Se connecter</a>
                        <?php else: ?>
                            <a href="?controller=product&action=index">Gérer les produits</a>
                            <a href="?controller=user&action=adminCreateUser">Créer un utilisateur</a>
                            <a href="?controller=user&action=logout">Se déconnecter</a>
                        <?php endif; ?>
                    </div>
                </nav>
            </header>

            <main>
                <?php
                    $filepath = File::build_path(array("view", $controller, "$view.php"));
                    require_once $filepath;
                ?>
            </main>

            <footer>© - Tous droits réservés (2024)</footer>
        </div>

        <script src="assets/js/burger.js" defer></script>
    </body>
</html>
