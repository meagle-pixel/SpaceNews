<?php
require_once 'auth-check.php';
require_once '../includes/db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: articlesAdmin.php');
    exit;
}

try {
    // Vérifie que l'article existe
    $stmt = $pdo->prepare('SELECT * FROM articles WHERE article_id = :id');
    $stmt->execute([':id' => $id]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$article) {
        header('Location: articlesAdmin.php');
        exit;
    }

    // Supprimer l'article
    $stmt = $pdo->prepare('DELETE FROM articles WHERE article_id = :id');
    $stmt->execute([':id' => $id]);

    header('Location: articlesAdmin.php?success=deleted');
    exit;

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}