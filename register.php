<?php
require 'config.php';
if (is_logged_in()) { header('Location: index.php'); exit; }
$pageTitle = 'Create an account';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    if (mb_strlen($username) < 3 || mb_strlen($username) > 24) $errors[] = 'Username harus 3–24 karakter.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Format email belum benar.';
    if (strlen($password) < 8) $errors[] = 'Password minimal 8 karakter.';
    if (!$errors) {
        $check = $pdo->prepare('SELECT id FROM users WHERE username = ? OR email = ?');
        $check->execute([$username, $email]);
        if ($check->fetch()) $errors[] = 'Username atau email sudah digunakan.';
        else {
            $stmt = $pdo->prepare('INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)');
            $stmt->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT)]);
            session_regenerate_id(true);
            $_SESSION['user_id'] = (int)$pdo->lastInsertId();
            $_SESSION['flash'] = 'Welcome to Pinkverse! Akunmu berhasil dibuat 🎀';
            header('Location: index.php'); exit;
        }
    }
}
require 'includes/header.php';
?>
<section class="auth-layout"><div class="auth-aside"><span class="big-bow">🎀</span><span class="eyebrow">A LITTLE SPACE FOR YOU</span><h1>Your next chapter starts here.</h1><p>Save your favorites, explore your vibe, and make this tiny corner of the internet yours.</p></div>
<div class="auth-card"><span class="eyebrow">JOIN THE UNIVERSE</span><h2>Create your account</h2><p class="muted">It takes less than a minute 💗</p>
<?php foreach ($errors as $error): ?><div class="error"><?= e($error) ?></div><?php endforeach; ?>
<form method="post" class="form-stack">
<label>Username<input name="username" required minlength="3" maxlength="24" autocomplete="username" value="<?= e($_POST['username'] ?? '') ?>" placeholder="yourmaincharacter"></label>
<label>Email address<input type="email" name="email" required autocomplete="email" value="<?= e($_POST['email'] ?? '') ?>" placeholder="you@example.com"></label>
<label>Password<input type="password" name="password" required minlength="8" autocomplete="new-password" placeholder="At least 8 characters"></label>
<button class="btn btn-primary btn-full" type="submit">Create my account ♡</button>
</form><p class="auth-switch">Already one of us? <a href="login.php">Log in</a></p></div></section>
<?php require 'includes/footer.php'; ?>
