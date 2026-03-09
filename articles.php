<?php
require_once 'includes/db.php';

$filtre = $_GET['categorie'] ?? 'all';


if ($filtre === 'all') {
  $stmt = $pdo->query("
        SELECT a.*, c.category_name 
        FROM articles a
        LEFT JOIN article_categories ac ON a.article_id = ac.article_id
        LEFT JOIN categories c ON ac.category_id = c.category_id
        WHERE a.article_status = 'published'
        ORDER BY a.article_published_date DESC
    ");
} else {
  $stmt = $pdo->prepare("
        SELECT a.*, c.category_name 
        FROM articles a
        LEFT JOIN article_categories ac ON a.article_id = ac.article_id
        LEFT JOIN categories c ON ac.category_id = c.category_id
        WHERE a.article_status = 'published' AND c.category_name = :categorie
        ORDER BY a.article_published_date DESC
    ");
  $stmt->execute([':categorie' => $filtre]);
}
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $pdo->query("SELECT * FROM categories ORDER BY category_name");
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
      <form action="" method="GET">
        <select id="filtre-articles">
          <option value="all">Toutes</option>
          <option value="Trous noirs">Trous noirs</option>
          <option value="Nébuleuses">Nébuleuses</option>
          <option value="Satellites">Satellites</option>
          <option value="Premières missions spatiales">Missions spatiales</option>
          <option value="Planètes">Planètes</option>
          <option value="Exoplanètes">Exoplanètes</option>
          <option value="Étoiles">Étoiles</option>
          <option value="Galaxies">Galaxies</option>
          <option value="Télescopes">Télescopes</option>
          <option value="Exploration spatiale">Exploration spatiale</option>
          <option value="Technologies spatiales">Technologies spatiales</option>
          <option value="Cosmologie">Cosmologie</option>
          <option value="Vie extraterrestre">Vie extraterrestre</option>
        </select>
      </form>

    </div>

    <div id="grille-articles" class="articles-grid"></div>

  </main>

  <script src="./js/index.js"></script>

  <?php include 'includes/footer.php'; ?>

</body>

</html>