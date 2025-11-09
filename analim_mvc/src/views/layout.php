<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Analim MVC</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
        a, button { display: inline-block; margin: 10px; padding: 10px 20px; text-decoration: none; color: white; background-color: #007BFF; border-radius: 5px; }
        button { border: none; cursor: pointer; }
        a:hover, button:hover { background-color: #0056b3; }
        nav {
            background-color: #f4f4f4;
            padding: 10px 20px;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 20px;
        }

        nav a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }

        nav a:hover {
            color: #007bff;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">

        <li class="nav-item">
          <a class="nav-link" href="index.php?c=home&a=index">Accueil</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="index.php?c=session&a=list">Liste des sessions</a>
        </li>

        <?php if(isset($_SESSION['email'])){ ?>
        <li class="nav-item">
          <a class="nav-link" href="index.php?c=congressiste&a=list">Mes sessions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?c=auth&a=logout">Se déconnecter</a>
        </li>
        <?php }else{ ?>
        <li class="nav-item">
          <a class="nav-link" href="index.php?c=auth&a=login">Connexion</a>
        </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>

    <h1>Bienvenue sur Analim MVC</h1>

</body>
</html>
