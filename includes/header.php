<header class="all">

  <nav>
    <?php if (isset($_SESSION['user_id'])): ?>

      <span style="color: white;">Bonjour <?= htmlspecialchars($_SESSION['user_first_name']) ?> |

        <?php if ($_SESSION['user_role'] === 'admin'): ?>
          <a href="<?= BASE_URL ?>/admin/articlesAdmin.php" class="btn-nav btn-admin">Admin</a>
          <a href="<?= BASE_URL ?>/admin/usersAdmin.php" class="btn-nav btn-roles">Rôles</a>
        <?php elseif ($_SESSION['user_role'] === 'autor'): ?>
          <a href="<?= BASE_URL ?>/admin/articlesAdmin.php" class="btn-nav btn-autor">Mes articles</a>
        <?php endif; ?>

        <a href="<?= BASE_URL ?>/deconnexion.php" class="btn-nav btn-deconnexion">Déconnexion</a>
      </span>
    <?php else: ?>
      <a href="<?= BASE_URL ?>/connexion.php" class="btn-nav btn-connexion">Se connecter</a>
    <?php endif; ?>

    <div class="logo">
      <a href="index.php">
        <img src="<?= BASE_URL ?>/images/logo_space.png" alt="logo du site" id="logo" />
      </a>
    </div>
    <div class="list">
      <ul>
        <li><a href="<?= BASE_URL ?>/index.php">Accueil</a></li>
        <li><a href="<?= BASE_URL ?>/articles.php">Nos articles</a></li>
        <li><a href="<?= BASE_URL ?>/ssolaire.php">Planétarium</a></li>
        <li><a href="<?= BASE_URL ?>/inscription.php">Rejoignez-nous !</a></li>
      </ul>
    </div>
  </nav>
</header>