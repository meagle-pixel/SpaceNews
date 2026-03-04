<?php 
require_once 'includes/db.php';




?>
<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Nos articles</title>
  <link rel="stylesheet" href="./css/style.css" />
</head>


<?php include 'includes/header.php'; ?>



<body class="accueil">
  <main>
    <div id="titre_filtre">
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
    </div>

    <div id="grille-articles" class="articles-grid"></div>

    <script src="./js/index.js"></script>

  </main>
  
  <?php include 'includes/footer.php'; ?>

</body>

</html>