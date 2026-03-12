<header class="all">

  <div class="connexion">
  </div>
  <nav>
    <?php if (isset($_SESSION['user_id'])): ?>
      <span style="color: white;">Bonjour <?= htmlspecialchars($_SESSION['user_first_name']) ?> |
        <?php if ($_SESSION['user_role'] === 'admin'): ?>
          <a href="/SpaceNews/admin/articlesAdmin.php" style="color: red;">Admin</a>
        <?php endif; ?>

        <a href="deconnexion.php" style="color: lightblue;">| Déconnexion</a>
      </span>
    <?php else: ?>
      <a href="connexion.php" style="color: white;">Connexion</a>
    <?php endif; ?>

    <div class="logo">
      <a href="index.php">
        <img src="/SpaceNews/images/logo_space.png" alt="logo du site" id="logo" />
      </a>
    </div>
    <div class="list">
      <ul>
        <li><a href="/index.php">Accueil</a></li>
        <li><a href="/articles.php">Nos articles</a></li>
        <li><a href="/ssolaire.php">Planétarium</a></li>
        <li><a href="/inscription.php">Rejoignez-nous !</a></li>
      </ul>
    </div>
  </nav>
</header>