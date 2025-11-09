<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Connexion</title>
  <?php require_once __DIR__ . '/../layout.php'; ?>
  <style>
    main#login-page {
      max-width: 400px;
      margin: 50px auto;
      padding: 20px;
    }
    .field {
      margin-bottom: 15px;
    }
    .field label {
      display: block;
      margin-bottom: 5px;
    }
    .field input {
      width: 100%;
      padding: 8px;
      box-sizing: border-box;
    }
    .error {
      color: red;
      margin-bottom: 10px;
    }
    button {
      padding: 10px 15px;
      background-color: #007bff;
      color: white;
      border: none;
      cursor: pointer;
    }
    button:hover {
      background-color: #0056b3;
    }
    .link {
      margin-top: 15px;
    }
  </style>
</head>
<body>
  <main id="login-page" class="card">
    <h1>Connexion</h1>

    <?php if(!empty($error)): ?>
      <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post" action="index.php?c=auth&a=login">
      <div class="field">
        <label for="email">E-mail *</label>
        <input type="mail" id="email" name="email" required>
      </div>

      <div class="field">
        <label for="password">Mot de passe *</label>
        <input type="password" id="password" name="password" required>
      </div>

      <button type="submit">Se connecter</button>
    </form>

    <p class="link">
      Pas encore inscrit ? <a href="index.php?c=auth&a=registerForm">Créer un compte</a>
    </p>
  </main>
</body>
</html>
