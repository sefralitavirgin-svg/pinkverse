<?php
require 'config.php';
$pageTitle = 'Your little internet escape';
$stories = $pdo->query('SELECT id, title, category, excerpt, emoji FROM stories ORDER BY id DESC LIMIT 3')->fetchAll();
require 'includes/header.php';
?>
<section class="hero">
  <div class="hero-copy">
    <span class="eyebrow">✦ YOUR LITTLE INTERNET ESCAPE ✦</span>
    <h1>Your world.<br><span>Your vibe.</span><br>Your rules.</h1>
    <p>A cozy pink corner for stories, personality quizzes, moodboards, and all the little things that make you <em>you</em>.</p>
    <div class="hero-actions">
      <a class="btn btn-primary" href="stories.php">Explore the universe ↗</a>
      <a class="btn btn-soft" href="quiz.php">Find your vibe ♡</a>
    </div>
    <div class="hero-note"><span class="avatar-stack">♡ ✿ ☆</span> A little universe, endless possibilities.</div>
  </div>
  <div class="hero-art" aria-label="Ilustrasi dekoratif">
    <div class="sparkle s1">✦</div><div class="sparkle s2">✧</div><div class="sparkle s3">♡</div>
    <div class="art-card art-back"><span>MAIN CHARACTER</span><strong>energy</strong><small>only ✨</small></div>
    <div class="art-card art-front"><div class="art-heart">♡</div><span>REMINDER</span><strong>You are<br>the plot.</strong><small>pinkverse journal · vol. 01</small></div>
    <div class="floating-pill">☁️ soft days</div>
    <div class="floating-pill pill-two">💌 good vibes</div>
  </div>
</section>

<section class="section-heading">
  <div><span class="eyebrow">PICK YOUR LITTLE ESCAPE</span><h2>What are we feeling today?</h2></div>
  <p>Choose your next adventure.</p>
</section>
<section class="feature-grid">
  <a class="feature-card feature-story" href="stories.php"><span class="feature-icon">📖</span><span class="feature-label">READ & DAYDREAM</span><h3>Story Room</h3><p>Short reads for your imagination, whenever you need a little escape.</p><span class="card-link">Open the story room ↗</span></a>
  <a class="feature-card feature-quiz" href="quiz.php"><span class="feature-icon">🪩</span><span class="feature-label">JUST FOR FUN</span><h3>Fun Zone</h3><p>Take a playful quiz and discover your fictional main-character energy.</p><span class="card-link">Find your vibe ↗</span></a>
  <a class="feature-card feature-mood" href="moodboard.php"><span class="feature-icon">🎀</span><span class="feature-label">COLLECT YOUR VIBE</span><h3>Moodboard</h3><p>Little affirmations and aesthetic inspiration for your current mood.</p><span class="card-link">Get inspired ↗</span></a>
</section>

<section class="latest-section">
  <div class="section-heading"><div><span class="eyebrow">FRESH FROM THE STORY ROOM</span><h2>A little something to read</h2></div><a class="text-link" href="stories.php">All stories ↗</a></div>
  <div class="story-grid">
    <?php foreach ($stories as $story): ?>
      <article class="story-card">
        <div class="story-cover"><?= e($story['emoji']) ?><span><?= e(strtoupper($story['category'])) ?></span></div>
        <div class="story-body"><h3><?= e($story['title']) ?></h3><p><?= e($story['excerpt']) ?></p><a class="text-link" href="story.php?id=<?= (int)$story['id'] ?>">Read story ↗</a></div>
      </article>
    <?php endforeach; ?>
  </div>
</section>
<section class="join-banner"><div><span class="eyebrow">YOUR SPACE, YOUR RULES</span><h2>Keep the things that feel like you.</h2><p>Create an account to save favorite stories and keep your personal collection close.</p></div><a class="btn btn-white" href="<?= is_logged_in() ? 'favorites.php' : 'register.php' ?>"><?= is_logged_in() ? 'See my favorites ♡' : 'Make it yours ♡' ?></a></section>
<?php require 'includes/footer.php'; ?>
