<?php
require_once 'includes/db.php';


$erreurs = [];
$succes = false;
$nom = '';
$prenom = '';
$email = '';
$mobile = '';
$password = '';
$password2 = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nom = trim($_POST['lastName'] ?? '');
  $prenom = trim($_POST['firstName'] ?? '');
  $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
  $mobile = trim($_POST['mobile'] ?? '');
  $password = $_POST['password'] ?? '';
  $password2 = $_POST['password2'] ?? '';


  if (empty($nom) || (strlen($nom) < 2) || (strlen($nom) > 50)) {
    $erreurs[] = "Votre nom doit contenir entre 2 et 50 caractères";
  }

  if (empty($prenom) || (strlen($prenom) < 2) || (strlen($prenom) > 50)) {
    $erreurs[] = "Votre prénom doit contenir entre 2 et 50 caractères";
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erreurs[] = "Email invalide";
  }

  if (empty($password) || strlen($password) < 8) {
    $erreurs[] = "Le mot de passe doit contenir au moins 8 caractères";
  } elseif ($password !== $password2) {
    $erreurs[] = "Les mots de passe doivent correspondre";
  }


  if (empty($erreurs)) {
    try {
      $hash = password_hash($password, PASSWORD_DEFAULT);

      $stmt = $pdo->prepare("INSERT INTO users (user_last_name, user_first_name, user_email, user_mobile, user_password) 
                       VALUES (:nom, :prenom, :email, :mobile, :password)");
      $stmt->execute([
        ':nom'      => $nom,
        ':prenom'   => $prenom,
        ':email'    => $email,
        ':mobile'   => $mobile,
        ':password' => $hash
      ]);

      $succes = true;
      $nom = $prenom = $email = '';
    } catch (PDOException $e) {
      if ($e->getCode() == 23000) {
        $erreurs[] = "Cet email est déjà utilisé";
      } else {
        $erreurs[] = "Erreur : " . $e->getMessage();
      }
    }
  }
}


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
      <form action="" method="POST">
        <h1 class="h1-contact">Inscrivez-vous maintenant !</h1>
        <input type="text" name="lastName" id="lastName" value="<?= htmlspecialchars($nom) ?>" placeholder="Entrez votre nom" />
        <input type="text" name="firstName" id="firstName" value="<?= htmlspecialchars($prenom) ?>" placeholder="Entrez votre prénom" />
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($email) ?>" placeholder="email" />
        <input type="text" name="mobile" id="mobile" value="<?= htmlspecialchars($mobile) ?>" placeholder="Téléphone" />
        <input type="password" name="password" id="password" placeholder="Choisissez votre mot de passe" />
        <input type="password" name="password2" id="password2" placeholder="Validez votre mot de passe">
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

  <?php if (!empty($erreurs)): ?>
    <script>
      showErrorOrSuccess("<?= htmlspecialchars($erreurs[0]) ?>");
    </script>
  <?php endif; ?>

  <?php if ($succes): ?>
    <script>
      showErrorOrSuccess("Inscription réussie !", "success");
    </script>
  <?php endif; ?>

  <?php include 'includes/footer.php'; ?>


</body>

</html>