<?php 
require_once 'includes/db.php';






?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Notre système solaire</title>
  <meta name="description" content="lorem" />
  <link rel="stylesheet" href="./css/style.css" />
</head>

<body class="body-solaire">
  <?php include 'includes/header.php'; ?>


  <main id="main-solaire">
    <div id="titre_filtre">
      <select id="filtre-planetes">
        <option value="all">Toutes</option>
        <option value="tellurique">Telluriques</option>
        <option value="gazeuse">Gazeuses</option>
        <option value="glace">Géantes de glace</option>
        <option value="lunes">Avec lunes</option>
      </select>

      <h1 id="h1_solaire">Planètes du système solaire</h1>
    </div>

    <div id="planetes-system"></div>
    <div id="info-planete"></div>
  </main>

  <script src="./js/index.js"></script>
  <?php include 'includes/footer.php'; ?>

</body>

</html>