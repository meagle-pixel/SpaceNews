<?php
require_once 'auth-check.php';
require_once '../includes/db.php';

$stmt = $pdo->query("
    SELECT a.*, u.user_first_name, u.user_last_name 
    FROM articles a 
    JOIN users u ON a.article_user_id = u.user_id 
    ORDER BY a.article_created_at DESC
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

<body class="accueil">

    <?php include '../includes/header.php'; ?>

    <main class="main-admin">
        <div class="admin-container">
            <div class="admin-header">
                <h1 style="color: white;">Gestion des articles</h1>
                <a href="article-create.php" class="btn-create">+ Nouvel article</a>
            </div>

            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($articles)): ?>
                        <tr>
                            <td colspan="6">Aucun article.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($articles as $article): ?>
                            <tr>
                                <td><?= $article['article_id'] ?></td>
                                <td><?= htmlspecialchars($article['article_title']) ?></td>
                                <td><?= htmlspecialchars($article['user_first_name'] . ' ' . $article['user_last_name']) ?></td>
                                <td><?= $article['article_status'] === 'published' ? 'Publié' : 'Brouillon' ?></td>
                                <td><?= date('d/m/Y', strtotime($article['article_created_at'])) ?></td>
                                <td>
                                    <a href="article-edit.php?id=<?= $article['article_id'] ?>" class="btn-edit">Modifier</a>
                                    <a href="article-delete.php?id=<?= $article['article_id'] ?>"
                                        class="btn-delete"
                                        onclick="return confirm('Supprimer cet article ?')">
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>

    <script src="../js/index.js"></script>

    <?php if (isset($_SESSION['success'])): ?>
        <script>
            <?php if ($_SESSION['success'] === 'created'): ?>
                showErrorOrSuccess("Article créé avec succès !", "success");
            <?php elseif ($_SESSION['success'] === 'deleted'): ?>
                showErrorOrSuccess("Article supprimé avec succès !", "success");
            <?php elseif ($_SESSION['success'] === 'updated'): ?>
                showErrorOrSuccess("Article modifié avec succès !", "success");
            <?php endif; ?>
        </script>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

</body>

</html>