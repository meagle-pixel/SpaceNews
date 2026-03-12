<?php
require_once 'includes/db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: articles.php');
    exit;
}

$sql = 'SELECT * FROM articles a JOIN users u ON a.article_user_id = u.user_id WHERE a.article_id = :id';
$stmt = $pdo->prepare($sql);
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
    <title><?= htmlspecialchars($article['article_title']) ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="accueil">
    <?php include 'includes/header.php'; ?>

    <main class="main-page">
        <section class="article">
            <img src="<?= htmlspecialchars($article['article_image_path']) ?>"
                alt="<?= htmlspecialchars($article['article_title']) ?>" id="<?= $article['article_id'] ?>">
            <article class="article-details">
                <div class="tittle_cat">
                    <h1 class="int"><?= htmlspecialchars($article['article_title']) ?></h1>
                </div>

                <p class="cat"><strong>Date : </strong><?= date('d/m/Y', strtotime($article['article_published_date'])) ?>
                    <strong>Auteur : </strong><?= htmlspecialchars($article['user_first_name'] . ' ' . $article['user_last_name']) ?>
                </p>
                <div class="article_content">
                    <p><?= nl2br(htmlspecialchars($article['article_content'])) ?></p>
                </div>

                <a href="articles.php" class="btn">Retour aux articles</a>
            </article>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

</body>

</html>