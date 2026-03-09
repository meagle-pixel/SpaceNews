<?php
require_once 'includes/db.php';

$id = $_GET['id'] ?? null;  // POURQUOI ?

if (!$id) {
    header('Location: articles.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM articles a JOIN users u ON a.article_user_id = u.user_id WHERE a.article_id = :id");
$stmt->execute([':id' => $id]);
$article = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$article) {
    header('Location: articles.php');
    exit;
}


?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails page</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <main class="main-page">
        <img src="<?= htmlspecialchars($article['article_image_path']) ?>" alt="<?= htmlspecialchars($article['article_title']) ?>" id="terre">

        <h1 class="h1"><?= htmlspecialchars($article['article_title']) ?></h1>

        <p class="cat">
            <strong>Auteur</strong> : <?= htmlspecialchars($article['user_first_name'] . ' ' . $article['user_last_name']) ?>
        </p>

        <?= nl2br(htmlspecialchars($article['article_content'])) ?>

    </main>



    <?php include 'includes/footer.php'; ?>

</body>

</html>