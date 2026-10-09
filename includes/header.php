<?php
$pageTitle = $pageTitle ?? 'Pinkverse';
$user = current_user($pdo);
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#fff1f7">
  <title><?= e($pageTitle) ?> · Pinkverse</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header class="site-header">
  <div class="nav-wrap">
    <a class="brand" href="index.php"><span class="brand-mark">♡</span> pinkverse<span class="brand-dot">.</span></a>
    <button class="menu-toggle" aria-label="Buka navigasi" aria-expanded="false">☰</button>
    <nav class="nav-links">
      <a href="index.php">Home</a>
      <a href="stories.php">Story Room</a>
      <a href="quiz.php">Fun Zone</a>
      <a href="moodboard.php">Moodboard</a>
      <?php if ($user): ?>
        <a href="favorites.php">Favorites</a>
        <span class="nav-user">Hi, <?= e($user['username']) ?> ✨</span>
        <a class="nav-cta" href="logout.php">Logout</a>
      <?php else: ?>
        <a href="login.php">Login</a>
        <a class="nav-cta" href="register.php">Join us ♡</a>
      <?php endif; ?>
    </nav>
  </div>
</header>
<main class="container">
<?php if ($message = flash_message()): ?>
  <div class="flash"><?= e($message) ?></div>
<?php endif; ?>
