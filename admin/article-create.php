<?php
require_once 'auth-check.php';
require_once '../includes/db.php';

$erreurs = [];
$image_path = '';

// je récupére les catégories
$stmtCat = $pdo->query("SELECT * FROM categories");
$categories = $stmtCat->fetchAll(PDO::FETCH_ASSOC);

// Traitement du formulaire
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
        $erreurs[] = "Veuillez entrer du contenu pour l'article";
    }

    // Gestion de l'image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
        $file_type = $_FILES['image']['type'];

        if (!in_array($file_type, $allowed_types)) {
            $erreurs[] = "Format d'image non autorisé (JPG, PNG, WEBP uniquement)";
        } else {
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $filename = uniqid('article_') . '.' . $extension;
            $upload_path = '../images/articles/' . $filename;

            if (!is_dir('../images/articles')) {
                mkdir('../images/articles', 0755, true);
            }

            // Déplacer le fichier uploadé
            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                $image_path = 'images/articles/' . $filename;
            } else {
                $erreurs[] = "Erreur lors de l'upload de l'image";
            }
        }
    } else {
        $erreurs[] = "Une image est requise";
    }

    // Insertion en BDD si pas d'erreurs
    if (empty($erreurs)) {
        try {
            $pdo->beginTransaction();

            // Insérer l'article
            $stmt = $pdo->prepare("
                INSERT INTO articles (article_title, article_resume, article_content, article_image_path, article_status, article_published_date, article_user_id)
                VALUES (:title, :resume, :content, :image, :status, :date, :user_id)
            ");
            $stmt->execute([
                ':title' => $title,
                ':resume' => $resume,
                ':content' => $content,
                ':image' => $image_path,
                ':status' => $statut,
                ':date' => $date,
                ':user_id' => $_SESSION['user_id']
            ]);

            $article_id = $pdo->lastInsertId();

            // Insérer les catégories
            if (!empty($selected_categories)) {
                $stmtCat = $pdo->prepare("INSERT INTO article_categories (article_id, category_id) VALUES (:article_id, :category_id)");
                foreach ($selected_categories as $cat_id) {
                    $stmtCat->execute([
                        ':article_id' => $article_id,
                        ':category_id' => (int)$cat_id
                    ]);
                }
            }

            $pdo->commit();
            header('Location: articlesAdmin.php?success=created');
            exit;
        } catch (PDOException $e) {
            $pdo->rollBack();
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
    <title>Formulaire create article</title>
    <link rel="stylesheet" href="../css/style.css?v=<?= time() ?>">
</head>

<body class="accueil">
    <?php include '../includes/header.php'; ?>


    <main class="main-admin">
        <div class="admin_container">
            <h1 style="color: yellow;">Créer un article</h1>
            <?php if (!empty($erreurs)): ?>
                <ul style="color: red;">
                    <?php foreach ($erreurs as $erreur): ?>
                        <li><?= htmlspecialchars($erreur) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <form action="" method="POST" id="create_article" enctype="multipart/form-data">
                <label for="titre">Titre :</label>
                <input type="text" name="title">
                <label for="resume">Résumé :</label>
                <textarea name="resume" placeholder="Résumé de l'article ici"></textarea>
                <label for="content">Contenu :</label>
                <textarea name="content" id="content" placeholder="Contenu de l'article ici"></textarea>

                <label for="image">Image :</label>
                <input type="file" name="image">

                <label for="date">Date :</label>
                <input type="date" name="date">

                <label>Statut :</label>
                <select name="statut">
                    <option value="draft">Brouillon</option>
                    <option value="published">Publié</option>
                </select>

                <label for="category">Catégories :</label>
                <div>
                    <?php foreach ($categories as $cat): ?>
                        <label>
                            <input type="checkbox" name="categories[]" value="<?= $cat['category_id'] ?>">
                            <?= htmlspecialchars($cat['category_name']) ?>
                        </label>

                    <?php endforeach; ?>
                </div>

                <button type="submit" id="btn_create">Créer l'article</button>
            </form>
        </div>


    </main>


    <?php include '../includes/footer.php'; ?>

</body>

</html>