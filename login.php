<?php
require 'config.php';
if (is_logged_in()) { header('Location: index.php'); exit; }
$pageTitle = 'Log in';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identity = trim($_POST['identity'] ?? '');
    $password = $_POST['password'] ?? '';
    $stmt = $pdo->prepare('SELECT id, password_hash FROM users WHERE email = ? OR username = ? LIMIT 1');
    $stmt->execute([$identity, $identity]);
    $found = $stmt->fetch();
    if ($found && password_verify($password, $found['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = (int)$found['id'];
        $_SESSION['flash'] = 'You’re back! Welcome home 💗';
        header('Location: index.php'); exit;
    }
    $error = 'Login gagal. Periksa username/email dan password kamu.';
}
require 'includes/header.php';
?>
<section class="auth-layout"><div class="auth-aside"><span class="big-bow">💌</span><span class="eyebrow">GOOD TO HAVE YOU BACK</span><h1>Your little corner missed you.</h1><p>Come back to your saved stories, favorite vibes, and tiny moments of joy.</p></div>
<div class="auth-card"><span class="eyebrow">WELCOME BACK</span><h2>Log in to Pinkverse</h2><p class="muted">Your universe is waiting ✨</p>
<?php if ($error): ?><div class="error"><?= e($error) ?></div><?php endif; ?>
<form method="post" class="form-stack"><label>Username or email<input name="identity" required autocomplete="username" value="<?= e($_POST['identity'] ?? '') ?>" placeholder="your username or email"></label><label>Password<input type="password" name="password" required autocomplete="current-password" placeholder="Your password"></label><button class="btn btn-primary btn-full" type="submit">Log in ♡</button></form>
<p class="auth-switch">New here? <a href="register.php">Create an account</a></p></div></section>
<?php require 'includes/footer.php'; ?>
