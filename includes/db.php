<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
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
