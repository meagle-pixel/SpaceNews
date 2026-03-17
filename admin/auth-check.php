<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$page = basename($_SERVER['PHP_SELF']);

$admin_only = ['article-delete.php', 'usersAdmin.php'];
$auteur_allowed = ['article-create.php', 'article-edit.php', 'articlesAdmin.php',];

if (!isset($_SESSION['user_id'])) {
    header('Location: ../connexion.php');
    exit;
}

if (in_array($page, $admin_only) && $_SESSION['user_role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

if (in_array($page, $auteur_allowed) && !in_array($_SESSION['user_role'], ['admin', 'autor'])) {
    header('Location: ../index.php');
    exit;
}



// ANCIEN AUTO CHECK

// <?php
// Vérifie que la session est démarrée
// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }

// // Vérifie si l'utilisateur est connecté
// if (!isset($_SESSION['user_id'])) {
//     header('Location: ../connexion.php');
//     exit;
// }

// // Vérifie si l'utilisateur est admin
// if ($_SESSION['user_role'] !== 'admin') {
//     header('Location: ../index.php');
//     exit;
// }
