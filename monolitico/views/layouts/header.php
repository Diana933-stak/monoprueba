<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestor de Historias de Usuario</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<nav>
  <a href="index.php?route=dashboard">Dashboard</a>
  <a href="index.php?route=sprints">Sprints</a>
  <a href="index.php?route=historias">Historias</a>
  <a href="index.php?route=reportes">Reportes</a>
</nav>
<main>
<?php if (!empty($_SESSION['success'])): ?><p class="msg success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></p><?php endif; ?>
<?php if (!empty($_SESSION['error'])): ?><p class="msg error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p><?php endif; ?>
