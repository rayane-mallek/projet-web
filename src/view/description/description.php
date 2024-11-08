<section id="description-page">
    <h1>À propos de Terre des Anges</h1>

    <!-- Affichage des produits -->
    <div id="product-list">
        <h2>Nos Produits</h2>
        <?php if (isset($products) && count($products) > 0): ?>
            <ul>
                <?php foreach ($products as $product): ?>
                    <li>
                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p><?php echo htmlspecialchars($product['description']); ?></p>
                        <p>Prix : <?php echo htmlspecialchars($product['price']); ?>€</p>
                        <?php
                        $imagePath = "assets/uploads/" . htmlspecialchars($product['name']) . ".png";
                        if (file_exists($imagePath)): ?>
                            <img src="<?php echo $imagePath; ?>" alt="Image de <?php echo htmlspecialchars($product['name']); ?>" width="200" height="200">
                        <?php else: ?>
                            <img src="assets/uploads/default.png" alt="Image par défaut" width="200" height="200">
                        <?php endif; ?>

                        <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true): ?>
                            <a href="?controller=product&action=editProduct&id=<?php echo $product['id']; ?>">Modifier</a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun produit disponible pour le moment.</p>
        <?php endif; ?>
    </div>

    <div id="contact-purchase">
        <p>Pour acheter un de nos produits artisanaux, n'hésitez pas à nous contacter !</p>
        <button onclick="window.location.href='?controller=contact&action=index'" class="contact-button">
            Nous Contacter
        </button>
    </div>

    <div id="description-intro">
        <p><strong>Terre des Anges</strong> est une association dédiée à l'art de la poterie artisanale. Nous croyons en la beauté des objets faits à la main, en l'importance de l'artisanat, et en l'héritage que chaque création apporte avec elle.</p>
    </div>

    <!-- Le reste de la page reste inchangé -->
    <div id="description-values">
        <h2>Nos Valeurs</h2>
        <ul>
            <li><strong>Artisanat</strong> : Chaque pot, vase ou sculpture est fait à la main avec soin et passion.</li>
            <li><strong>Écologie</strong> : Nous utilisons de l'argile locale et des matériaux durables dans la création de nos œuvres.</li>
            <li><strong>Communauté</strong> : Nos ateliers accueillent des personnes de tous horizons pour partager et apprendre.</li>
        </ul>
    </div>
</section>
