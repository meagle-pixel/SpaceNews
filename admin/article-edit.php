<?php
require_once 'auth-check.php';
require_once '../includes/db.php';

$id = $_GET['id'] ?? null;
$erreurs = [];

if (!$id) {
    header('Location: articlesAdmin.php');
    exit;
}

try {
    $stmt = $pdo->prepare('SELECT * FROM articles WHERE article_id = :id');
    $stmt->execute([':id' => $id]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$article) {
        header('Location: articlesAdmin.php');
        exit;
    }

    if($_SESSION['user_role'] !== 'admin' && $article['article_user_id'] !== $_SESSION['user_id']) {
        header ('Location: articlesAdmin.php');
    }

    // Ici je récupére les catégories
    $stmtCat = $pdo->query('SELECT * FROM categories ORDER BY category_name');
    $categories = $stmtCat->fetchAll(PDO::FETCH_ASSOC);

    // Maintenant je récupère la catégorie de l'article souhaité
    $stmtArtCat = $pdo->prepare('SELECT category_id FROM article_categories WHERE article_id = :id');
    $stmtArtCat->execute([':id' => $id]);
    $article_categories = $stmtArtCat->fetchAll(PDO::FETCH_COLUMN); // FETCH_COLUMN donne un tableau simple [1, 3, 5] ce qui permet à in_array() de fonctionner, 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = trim($_POST['title'] ?? '');
        $resume = trim($_POST['resume'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $date = $_POST['date'] ?? date('Y-m-d');
        $statut = $_POST['statut'] ?? 'draft';
        $selected_categories = $_POST['categories'] ?? [];

        if (empty($title)) {
            $erreurs[] = "Veuillez entrer un titre";
        }

        if (empty($resume)) {
            $erreurs[] = "Veuillez entrer un résumé";
        }

        if (empty($content)) {
            $erreurs[] = "Veuillez entrer du contenu";
        }

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
            $file_type = $_FILES['image']['type'];

            if (!in_array($file_type, $allowed_types)) {
                $erreurs[] = "Format d'image non autorisé";
            } else {
                $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $filename = uniqid('article_') . '.' . $extension;
                $upload_path = '../images/articles/' . $filename;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                    $image_path = 'images/articles/' . $filename;
                } else {
                    $erreurs[] = "Erreur lors de l'upload";
                }
            }
        } else {
            $image_path = $article['article_image_path'];
        }

        if (empty($erreurs)) {
            $pdo->beginTransaction();

            $stmt = $pdo->prepare("UPDATE articles SET article_title = :title, article_resume = :resume, article_content = :content, article_image_path = :image, article_status = :status, article_published_date = :date WHERE article_id = :id");
            $stmt->execute([
                ':title' => $title,
                ':resume' => $resume,
                ':content' => $content,
                ':image' => $image_path,
                ':status' => $statut,
                ':date' => $date,
                ':id' => $id
            ]);

            $stmt = $pdo->prepare("DELETE FROM article_categories WHERE article_id = :id");
            $stmt->execute([':id' => $id]);

            // J'insère ici les nouvelles catégories
            if (!empty($selected_categories)) {
                $stmt = $pdo->prepare("INSERT INTO article_categories (article_id, category_id) VALUES (:article_id, :category_id)");
                foreach ($selected_categories as $cat_id) {
                    $stmt->execute([
                        ':article_id' => $id,
                        ':category_id' => (int)$cat_id
                    ]);
                }
            }

            $pdo->commit();
            $_SESSION['success'] = 'updated';
            header('Location: articlesAdmin.php');
            exit;
        }
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="accueil">

    <?php include '../includes/header.php'; ?>

    <main class="main-admin">
        <div class="admin_container">

            <h1 style="color: yellow;">Modifier un article</h1>

            <form action="" method="POST" enctype="multipart/form-data" id="create_article">

                <label>Titre :</label>
                <input type="text" name="title" value="<?= htmlspecialchars($article['article_title']) ?>">

                <label>Résumé :</label>
                <textarea name="resume"><?= htmlspecialchars($article['article_resume']) ?></textarea>

                <label>Contenu :</label>
                <textarea name="content"><?= htmlspecialchars($article['article_content']) ?></textarea>

                <label>Image actuelle :</label>
                <img src="../<?= htmlspecialchars($article['article_image_path']) ?>" width="200">

                <label>Nouvelle image (optionnel) :</label>
                <input type="file" name="image">

                <label>Date :</label>
                <input type="date" name="date" value="<?= htmlspecialchars($article['article_published_date']) ?>">

                <label>Statut :</label>
                <select name="statut">
                    <option value="draft" <?= $article['article_status'] === 'draft' ? 'selected' : '' ?>>Brouillon</option>
                    <option value="published" <?= $article['article_status'] === 'published' ? 'selected' : '' ?>>Publié</option>
                </select>

                <label>Catégories :</label>
                <div>
                    <?php foreach ($categories as $cat): ?>
                        <label>
                            <input type="checkbox" name="categories[]" value="<?= $cat['category_id'] ?>"
                                <?= in_array($cat['category_id'], $article_categories) ? 'checked' : '' ?>>
                            <?= htmlspecialchars($cat['category_name']) ?>
                        </label>
                    <?php endforeach; ?>
                </div>

                <button type="submit" id="btn_create">Modifier l'article</button>
            </form>


        </div>


    </main>

     <script src="../js/index.js"></script>

    <?php include '../includes/footer.php'; ?>


</body>

</html>