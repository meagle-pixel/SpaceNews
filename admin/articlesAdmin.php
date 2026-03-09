<?php
require_once 'auth-check.php';
require_once '../includes/db.php';

$stmt = $pdo->query("SELECT a.*, u.user_first_name, u.user_last_name FROM articles a JOIN users u ON a.article_user_id = u.user_id ORDER BY a.article_created_at DESC
");

$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - articles</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <?php include '../includes/header.php'; ?>

    <main class="main-admin">


        <div class="admin-container">
            <div class="admin-header">
                <h1>Gestion des articles (Admin)</h1>
                <a href="article-create.php" class="btn-create">+ Nouvel article</a> <br>
                <a href="article-delete.php" class="btn-create">- Supprimer un article</a>
            </div>
        </div>



    </main>








</body>

</html>