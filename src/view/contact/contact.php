<section id="contact-page">
    <h1>Nous contacter</h1>

    <div id="contact-info">
        <h2>Notre adresse</h2>
        <p id="address">
            <?php echo htmlspecialchars($contactInfo['address']) ?>
        </p>
        <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true): ?>
            <button class="edit-button" onclick="editText('address')">✏️ Modifier</button>
        <?php endif; ?>

        <h2>Téléphone</h2>
        <p id="phone">
            <?php echo htmlspecialchars($contactInfo['phone']); ?>
        </p>
        <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true): ?>
            <button class="edit-button" onclick="editText('phone')">✏️ Modifier</button>
        <?php endif; ?>

        <h2>Email</h2>
        <p id="email">
            <a href="mailto:<?php echo htmlspecialchars($contactInfo['email']); ?>">
                <?php echo htmlspecialchars($contactInfo['email']); ?>
            </a>
        </p>
        <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true): ?>
            <button class="edit-button" onclick="editText('email')">✏️ Modifier</button>
        <?php endif; ?>
    </div>

    <div id="contact-form">
        <h2>Laissez-nous un message</h2>
        <form action="" method="POST">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Votre message :</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <button type="submit">Envoyer</button>
        </form>
    </div>
</section>

<script src="assets/js/ajax_edition.js"></script>
