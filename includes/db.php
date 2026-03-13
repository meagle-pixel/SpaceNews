<?php

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

require_once __DIR__ . '/../vendor/autoload.php';

if (file_exists(__DIR__ . '/../.env')) {
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
  $dotenv->load();
}


// Détecte automatiquement l'environnement
if ($_SERVER['HTTP_HOST'] === 'localhost') {
  define('BASE_URL', '/SpaceNews');
} else {
  define('BASE_URL', '');
}


try {
  $pdo = new PDO(
    "mysql:host={$_ENV['AD_HOST']};dbname={$_ENV['AD_NAME']};charset=utf8mb4",
    $_ENV['AD_USER'],
    $_ENV['AD_PASS']
  );
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Erreur de connexion : " . $e->getMessage());
}
