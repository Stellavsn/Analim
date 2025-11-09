
      <?php include __DIR__ . '/../layout.php'; ?>
    <main class="card">
        <h1>Créer un compte</h1>

        <?php if(!empty($error)): ?>
            <p style="color:red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <?php if(!empty($success)): ?>
            <p style="color:green;"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>

        <form method="post" action="index.php?c=auth&a=register">
            <div class="field">
                <label for="nom">Nom *</label>
                <input type="text" id="nom" name="nom" required>
            </div>

            <div class="field">
                <label for="prenom">Prénom *</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>

            <div class="field">
                <label for="email">E-mail *</label>
                <input type="mail" id="email" name="email" required>
            </div>

            <div class="field">
                <label for="password">Mot de passe *</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">S'inscrire</button>
        </form>

        <p>
            Déjà un compte ? <a href="index.php?c=auth&a=login">Se connecter</a>
        </p>
    </main>
</body>
</html>
