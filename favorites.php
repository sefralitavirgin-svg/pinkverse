<?php
require 'config.php'; require_login();
$pageTitle = 'My favorites';
$stmt = $pdo->prepare('SELECT s.id, s.title, s.category, s.excerpt, s.emoji FROM favorites f JOIN stories s ON s.id = f.story_id WHERE f.user_id = ? ORDER BY f.created_at DESC');
$stmt->execute([$_SESSION['user_id']]); $stories = $stmt->fetchAll();
require 'includes/header.php';
?>
<section class="page-hero compact-hero"><span class="eyebrow">YOUR PERSONAL COLLECTION 💗</span><h1>Little things you <span>love.</span></h1><p>Your saved stories, all in one place.</p></section>
<?php if (!$stories): ?><div class="empty-state"><span>♡</span><h2>Your favorites are waiting</h2><p>Save a story you love and it will show up here.</p><a href="stories.php" class="btn btn-primary">Explore stories ↗</a></div><?php else: ?><div class="story-grid story-grid-large"><?php foreach ($stories as $story): ?><article class="story-card"><div class="story-cover"><?= e($story['emoji']) ?><span><?= e(strtoupper($story['category'])) ?></span></div><div class="story-body"><h3><?= e($story['title']) ?></h3><p><?= e($story['excerpt']) ?></p><a class="text-link" href="story.php?id=<?= (int)$story['id'] ?>">Read story ↗</a></div></article><?php endforeach; ?></div><?php endif; ?>
<?php require 'includes/footer.php'; ?>
