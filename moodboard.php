<?php
require 'config.php'; $pageTitle = 'Moodboard'; require 'includes/header.php';
$moods = [
 ['title'=>'Soft Girl Era','tag'=>'GENTLE REMINDER','quote'=>'You can grow gently. You do not have to rush every version of yourself.','emoji'=>'🌷','class'=>'mood-rose'],
 ['title'=>'Main Character Energy','tag'=>'A LITTLE CONFIDENCE','quote'=>'You are allowed to take up space in the story you are living.','emoji'=>'🎀','class'=>'mood-pink'],
 ['title'=>'Dream Big, Start Small','tag'=>'FOR YOUR FUTURE SELF','quote'=>'A tiny step still counts. Keep showing up for the things that matter to you.','emoji'=>'☁️','class'=>'mood-lilac'],
 ['title'=>'Romanticize the Ordinary','tag'=>'NOTICE THE LITTLE THINGS','quote'=>'A good playlist, fresh sheets, and a moment to breathe can be enough for today.','emoji'=>'🫧','class'=>'mood-peach'],
 ['title'=>'Quietly Becoming','tag'=>'GROW AT YOUR OWN PACE','quote'=>'You can be a work in progress and still be proud of how far you have come.','emoji'=>'🦢','class'=>'mood-blue'],
 ['title'=>'A Little More Courage','tag'=>'ONE THING AT A TIME','quote'=>'You do not need the whole map. Just choose your next kind step.','emoji'=>'✨','class'=>'mood-gold'],
];
?>
<section class="page-hero compact-hero"><span class="eyebrow">🎀 YOUR AESTHETIC CORNER</span><h1>A mood for <span>every version of you.</span></h1><p>Pick a card, take a breath, and keep what speaks to you.</p></section>
<div class="mood-toolbar"><span>THE LITTLE REMINDER COLLECTION</span><button class="btn btn-soft" id="shuffle-moods">Shuffle cards ↻</button></div>
<div class="mood-grid" id="mood-grid">
<?php foreach ($moods as $i => $mood): ?><article class="mood-card <?= e($mood['class']) ?>"><div class="mood-card-top"><span><?= e($mood['tag']) ?></span><span><?= e($mood['emoji']) ?></span></div><h2><?= e($mood['title']) ?></h2><p>“<?= e($mood['quote']) ?>”</p><button class="copy-quote" type="button" data-quote="<?= e($mood['quote']) ?>">Copy reminder ♡</button></article><?php endforeach; ?>
</div><p class="tiny-note">These reminders are here to inspire, not to pressure you. Take what you need. 💗</p>
<?php require 'includes/footer.php'; ?>
