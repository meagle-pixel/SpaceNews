<?php
require_once 'includes/db.php';

$erreurs = [];
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';


    if (empty($email) || empty($password)) {
        $erreurs[] = "Veuillez remplir tous les champs";
    }

    if (empty($erreurs)) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE user_email = :email");
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['user_password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_email'] = $user['user_email'];
                $_SESSION['user_first_name'] = $user['user_first_name'];
                $_SESSION['user_role'] = $user['user_role'];

                header('Location: index.php');
                exit;
            } else {
                $erreurs[] = "Email ou mot de passe incorrect";
            }
        } catch (PDOException $e) {
            $erreurs[] = "Erreur : " . $e->getMessage();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body class="body-contact">

    <?php include 'includes/header.php'; ?>

    <main class="body-contact">
        <div class="container_contact">
            <form action="" method="POST" class="form-connexion">
                <h1>Connexion</h1>
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($email) ?>" placeholder="Votre email">
                <input type="password" name="password" id="password" placeholder="Votre mot de passe">
                <div class="btn_p">
                    <input type="submit" value="Se connecter" id="button">
                    <p style="color: white; text-align: center;">
                        Pas encore inscrit ? <a href="inscription.php" style="color: lightblue;">Créer un compte</a>
                    </p>
                </div>

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

    <?php include 'includes/footer.php'; ?>



</body>

</html>