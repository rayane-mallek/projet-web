<section id="admin-create-user">
    <h1>Créer un nouvel utilisateur</h1>

    <div id="create-user-form">
        <h2>Formulaire de création</h2>
        <form action="?controller=user&action=adminCreateUserProcess" method="POST">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Créer l'utilisateur</button>
        </form>

        <!-- Messages de succès ou d'erreur -->
        <?php if (isset($success_message)): ?>
            <p class="success-message"><?php echo $success_message; ?></p>
        <?php elseif (isset($error_message)): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>

    <!-- Section pour afficher la liste des utilisateurs -->
    <div id="user-list">
        <h2>Liste des utilisateurs</h2>
        <ul>
            <?php if (! empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <li>
                        <strong>Nom d'utilisateur :</strong> <?php echo htmlspecialchars($user['username']); ?><br>
                        <strong>Email :</strong> <?php echo htmlspecialchars($user['email']); ?>

                        <!-- Bouton Supprimer -->
                        <form action="?controller=user&action=adminDeleteUserProcess" method="POST" style="display:inline;">
                            <input type="hidden" name="username" value="<?php echo htmlspecialchars($user['username']); ?>">
                            <button type="submit">Supprimer</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>Aucun utilisateur trouvé.</li>
            <?php endif; ?>
        </ul>
    </div>
</section>
