<section id="login-page">
    <h1>Connexion</h1>

    <div id="login-form">
        <h2>Veuillez vous connecter</h2>
        <form action="?controller=user&action=loginProcess" method="POST">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Se connecter</button>
        </form>

        <div id="signup-link">
            <p>Pas encore de compte ? <a href="?controller=user&action=signup">Inscrivez-vous ici</a></p>
        </div>
    </div>
</section>
