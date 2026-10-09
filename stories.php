<?php
require 'config.php';
$pageTitle = 'Story Room';
$q = trim($_GET['q'] ?? '');
if ($q !== '') {
    $stmt = $pdo->prepare('SELECT id, title, category, excerpt, emoji FROM stories WHERE title LIKE ? OR category LIKE ? OR excerpt LIKE ? ORDER BY id DESC');
    $like = '%' . $q . '%'; $stmt->execute([$like, $like, $like]); $stories = $stmt->fetchAll();
} else {
    $stories = $pdo->query('SELECT id, title, category, excerpt, emoji FROM stories ORDER BY id DESC')->fetchAll();
}
require 'includes/header.php';
?>
<section class="page-hero compact-hero"><span class="eyebrow">📖 READ A LITTLE, DREAM A LOT</span><h1>Welcome to the <span>Story Room.</span></h1><p>Short reads for curious minds and main characters in their own right.</p></section>
<form class="search-bar" method="get"><span>⌕</span><input type="search" name="q" value="<?= e($q) ?>" placeholder="Search a story or category..."><button class="btn btn-primary" type="submit">Search</button></form>
<?php if (!$stories): ?><div class="empty-state"><span>🫧</span><h2>No stories found</h2><p>Try another keyword, bestie.</p><a class="text-link" href="stories.php">Show all stories</a></div><?php else: ?>
<div class="story-grid story-grid-large">
<?php foreach ($stories as $story): ?><article class="story-card"><div class="story-cover"><?= e($story['emoji']) ?><span><?= e(strtoupper($story['category'])) ?></span></div><div class="story-body"><h3><?= e($story['title']) ?></h3><p><?= e($story['excerpt']) ?></p><a class="text-link" href="story.php?id=<?= (int)$story['id'] ?>">Read story ↗</a></div></article><?php endforeach; ?>
</div><?php endif; ?>
<?php require 'includes/footer.php'; ?>
