<?php
require 'config.php'; $pageTitle = 'Fun Zone'; require 'includes/header.php';
?>
<section class="page-hero compact-hero"><span class="eyebrow">🪩 FOR THE PLOT</span><h1>What's your <span>main-character vibe?</span></h1><p>No pressure, no wrong answers. Just a little fun.</p></section>
<section class="quiz-shell" id="quiz">
  <div class="quiz-progress"><span id="question-count">QUESTION 1 OF 5</span><div class="progress-track"><div id="progress-fill"></div></div></div>
  <h2 id="question-title">Your ideal Saturday looks like...</h2>
  <div id="answer-list" class="answer-list"></div>
  <div class="quiz-controls"><button class="btn btn-soft" id="prev-question" disabled>← Back</button><button class="btn btn-primary" id="next-question" disabled>Next question →</button></div>
  <div id="quiz-result" class="quiz-result" hidden></div>
  <button class="btn btn-soft restart-btn" id="restart-quiz" hidden>Try again ↻</button>
</section>
<script>
window.PINKVERSE_QUIZ = [
 {q:"Your ideal Saturday looks like...",a:[["A cozy day with a book and playlist","dreamer"],["A spontaneous city adventure","itgirl"],["A deep talk with my favorite people","softie"],["A plan to learn or build something","visionary"]]},
 {q:"Pick your comfort aesthetic.",a:[["Pink bows, gloss, and cute details","itgirl"],["Cloudy skies and handwritten notes","dreamer"],["Warm lights and comfy sweaters","softie"],["Clean desk, goals, and iced coffee","visionary"]]},
 {q:"Your friends come to you when they need...",a:[["An honest plan and a reality check","visionary"],["A safe space to vent","softie"],["A fresh idea or new place to try","itgirl"],["A thoughtful perspective","dreamer"]]},
 {q:"Choose a fictional setting.",a:[["A mysterious library after midnight","dreamer"],["A stylish city full of possibilities","itgirl"],["A little cottage with found family","softie"],["A futuristic lab solving big problems","visionary"]]},
 {q:"Your personal motto is...",a:[["Make it meaningful","dreamer"],["Make it memorable","itgirl"],["Make it kind","softie"],["Make it happen","visionary"]]}
];
</script>
<?php require 'includes/footer.php'; ?>
