<?php 





?>














<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact</title>
  <link rel="stylesheet" href="./css/style.css" />
</head>

<body class="body-contact">

  <?php include 'includes/header.php'; ?>

  <main class="main-contact">
    <div class="container_contact">
      <form>
        <h1 class="h1-contact">Contactez-nous !</h1>
        <input type="text" name="lastName" id="lastName" placeholder="Entrez votre nom" />
        <input type="text" name="firstName" id="firstName" placeholder="Entrez votre prénom" />
        <input type="email" name="email" id="email" placeholder="email" />
        <input type="text" name="mobile" id="mobile" placeholder="Téléphone" />
        <input type="password" name="password" id="password" placeholder="Choisissez votre mot de passe" />
        <h2>Ajoutez des informations (optionnel)</h2>
        <textarea id="textarea"></textarea>
        <input type="submit" value="Inscription" id="button" />
      </form>
    </div>

    <div id="form-message">
      <img id="form-icon" src="images/traverser.png" alt="logo erreur">
      <span id="formText"></span>
    </div>

  </main>

  <script src="js/index.js"></script>

  <?php include 'includes/footer.php'; ?>
 

</body>

</html>