<?php
require_once 'includes/db.php';

$filtre = $_GET['categorie'] ?? 'all';


if ($filtre === 'all') {
  $stmt = $pdo->query("
        SELECT a.*,
        GROUP_CONCAT(c.category_name SEPARATOR ', ') AS categories
        FROM articles a
        LEFT JOIN article_categories ac ON a.article_id = ac.article_id
        LEFT JOIN categories c ON ac.category_id = c.category_id
        WHERE a.article_status = 'published'
        GROUP BY a.article_id
        ORDER BY a.article_published_date DESC
    ");
} else {
  $stmt = $pdo->prepare("
        SELECT a.*, c.category_name AS categories
        FROM articles a
        LEFT JOIN article_categories ac ON a.article_id = ac.article_id
        LEFT JOIN categories c ON ac.category_id = c.category_id
        WHERE a.article_status = 'published' AND c.category_name = :categorie
        ORDER BY a.article_published_date DESC
    ");
  $stmt->execute([':categorie' => $filtre]);
}
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmtCat = $pdo->query("SELECT * FROM categories ORDER BY category_name");
$categories = $stmtCat->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Nos articles</title>
  <link rel="stylesheet" href="./css/style.css" />
</head>

<body class="accueil">
  <?php include 'includes/header.php'; ?>

  <main class="main-articles">

    <div id="titre_filtre">
      <form method="GET" action="">
        <select name="categorie" id="filtre-articles" onchange="this.form.submit()">
          <option value="all">Toutes</option>
          <?php foreach ($categories as $cat): ?>
            <option value="<?= htmlspecialchars($cat['category_name']) ?>"
              <?= $filtre === $cat['category_name'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($cat['category_name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </form>
    </div>

    <div id="grille-articles" class="articles-grid">
      <?php if (empty($articles)): ?>
        <p style="color: white;">Aucun article pour le moment.</p>
      <?php else: ?>
        <?php foreach ($articles as $article): ?>
          <div class="card">
            <img src="<?= htmlspecialchars($article['article_image_path']) ?>"
              alt="<?= htmlspecialchars($article['article_title']) ?>">
            <div class="card-infos">
              <small><?= htmlspecialchars($article['categories'] ?? 'Non classé') ?></small>
              <h3><?= htmlspecialchars($article['article_title']) ?></h3>
              <p><?= htmlspecialchars($article['article_resume']) ?></p>
              <a href="details.php?id=<?= $article['article_id'] ?>" class="btn">Lire l'article</a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

  </main>
  

  <?php include 'includes/footer.php'; ?>

</body>

</html>