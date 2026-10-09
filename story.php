<?php
require 'config.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$stmt = $pdo->prepare('SELECT * FROM stories WHERE id = ?');
$stmt->execute([$id ?: 0]); $story = $stmt->fetch();
if (!$story) { http_response_code(404); $pageTitle = 'Story not found'; require 'includes/header.php'; echo '<div class="empty-state"><h1>Oops, story not found 🫧</h1><a href="stories.php" class="text-link">Back to stories</a></div>'; require 'includes/footer.php'; exit; }
$pageTitle = $story['title'];
$isFavorite = false;
if (is_logged_in()) { $f = $pdo->prepare('SELECT id FROM favorites WHERE user_id = ? AND story_id = ?'); $f->execute([$_SESSION['user_id'], $story['id']]); $isFavorite = (bool)$f->fetch(); }
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['favorite'])) {
    require_login();
    if ($isFavorite) { $d = $pdo->prepare('DELETE FROM favorites WHERE user_id = ? AND story_id = ?'); $d->execute([$_SESSION['user_id'], $story['id']]); $_SESSION['flash'] = 'Story dihapus dari favorites.'; }
    else { $a = $pdo->prepare('INSERT IGNORE INTO favorites (user_id, story_id) VALUES (?, ?)'); $a->execute([$_SESSION['user_id'], $story['id']]); $_SESSION['flash'] = 'Story masuk ke favorites! 💗'; }
    header('Location: story.php?id=' . $story['id']); exit;
}
require 'includes/header.php';
?>
<article class="reader"><a class="back-link" href="stories.php">← Back to Story Room</a><div class="reader-cover"><?= e($story['emoji']) ?></div><div class="reader-content"><span class="eyebrow"><?= e(strtoupper($story['category'])) ?> · A PINKVERSE ORIGINAL</span><h1><?= e($story['title']) ?></h1><p class="reader-excerpt"><?= e($story['excerpt']) ?></p><div class="reader-text"><?= nl2br(e($story['content'])) ?></div><form method="post" class="favorite-form"><button name="favorite" value="1" class="btn <?= $isFavorite ? 'btn-soft' : 'btn-primary' ?>" type="submit"><?= $isFavorite ? '♥ Saved to favorites' : '♡ Save to favorites' ?></button><?php if (!is_logged_in()): ?><small>Log in to save this story.</small><?php endif; ?></form></div></article>
<?php require 'includes/footer.php'; ?>
