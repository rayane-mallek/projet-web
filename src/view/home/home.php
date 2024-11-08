<section id="home-viewer">
    <h1>Bienvenue sur Terre des Anges</h1>
    <div id="image-viewer">
        <!-- IMG section for the carousel -->
        <button id="prev" class="carousel-button">◀</button>
        <button id="next" class="carousel-button">▶</button>
    </div>
</section>

<section id="about">
    <h2>À propos de notre association</h2>
    <p id="about-text">
        <?php echo htmlspecialchars($aboutText ?? '', ENT_QUOTES, 'UTF-8'); ?>
    </p>
    <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true): ?>
        <button class="edit-button" onclick="editText('about-text')">✏️ Modifier</button>
    <?php endif; ?>

    <button onclick="window.location.href='?controller=description&action=index'" class="navigate-button">
        Découvrir nos produits
    </button>
</section>

<section id="latest-news">
    <h2>Actualités</h2>
    <p id="news-text">
        <?php echo htmlspecialchars($newsText ?? '', ENT_QUOTES, 'UTF-8'); ?>
    </p>
    <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true): ?>
        <button class="edit-button" onclick="editText('news-text')">✏️ Modifier</button>
    <?php endif; ?>
</section>

<section id="contact-info">
    <h2>Nous contacter</h2>
    <p id="contact-text">
        <?php echo htmlspecialchars($contactText ?? '', ENT_QUOTES, 'UTF-8'); ?>
    </p>
    <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true): ?>
        <button class="edit-button" onclick="editText('contact-text')">✏️ Modifier</button>
    <?php endif; ?>
</section>

<script src="assets/js/ajax_edition.js"></script>
<script src="assets/js/imgviewer.js"></script>
