document.addEventListener('DOMContentLoaded', () => {
  const toggle = document.querySelector('.menu-toggle');
  const nav = document.querySelector('.nav-links');
  if (toggle && nav) toggle.addEventListener('click', () => {
    const open = nav.classList.toggle('nav-open');
    toggle.setAttribute('aria-expanded', String(open));
  });

  document.querySelectorAll('.copy-quote').forEach(button => {
    button.addEventListener('click', async () => {
      const quote = button.dataset.quote || '';
      try {
        await navigator.clipboard.writeText(quote);
        button.textContent = 'Copied! ♡';
      } catch {
        const area = document.createElement('textarea');
        area.value = quote; document.body.appendChild(area); area.select();
        document.execCommand('copy'); area.remove();
        button.textContent = 'Copied! ♡';
      }
      setTimeout(() => button.textContent = 'Copy reminder ♡', 1600);
    });
  });

  const shuffle = document.getElementById('shuffle-moods');
  const moodGrid = document.getElementById('mood-grid');
  if (shuffle && moodGrid) shuffle.addEventListener('click', () => {
    for (let i = moodGrid.children.length; i >= 0; i--) {
      moodGrid.appendChild(moodGrid.children[Math.random() * i | 0]);
    }
  });

  const quizData = window.PINKVERSE_QUIZ;
  if (!quizData) return;
  let index = 0;
  const answers = [];
  const title = document.getElementById('question-title');
  const answerList = document.getElementById('answer-list');
  const count = document.getElementById('question-count');
  const fill = document.getElementById('progress-fill');
  const prev = document.getElementById('prev-question');
  const next = document.getElementById('next-question');
  const result = document.getElementById('quiz-result');
  const restart = document.getElementById('restart-quiz');
  const descriptions = {
    dreamer: ['The Thoughtful Dreamer', 'You notice the details, find meaning in little moments, and bring imagination wherever you go. 🌙'],
    itgirl: ['The Effortless It Girl', 'You bring energy, curiosity, and a little sparkle to the places you enter. Your vibe is unmistakably yours. 🎀'],
    softie: ['The Warm-Hearted Softie', 'You value connection, kindness, and the kind of comfort that makes people feel seen. 🌷'],
    visionary: ['The Quiet Visionary', 'You like turning ideas into something real. Curious, intentional, and always becoming. ✨']
  };
  function render() {
    const item = quizData[index];
    title.textContent = item.q;
    count.textContent = `QUESTION ${index + 1} OF ${quizData.length}`;
    fill.style.width = `${((index + 1) / quizData.length) * 100}%`;
    answerList.innerHTML = '';
    item.a.forEach(([label, type], i) => {
      const button = document.createElement('button');
      button.type = 'button';
      button.className = 'answer-option' + (answers[index] === type ? ' selected' : '');
      button.textContent = label;
      button.addEventListener('click', () => {
        answers[index] = type;
        answerList.querySelectorAll('.answer-option').forEach(el => el.classList.remove('selected'));
        button.classList.add('selected');
        next.disabled = false;
      });
      answerList.appendChild(button);
    });
    prev.disabled = index === 0;
    next.disabled = !answers[index];
    next.textContent = index === quizData.length - 1 ? 'Reveal my vibe ✨' : 'Next question →';
  }
  prev.addEventListener('click', () => { if (index > 0) { index--; render(); } });
  next.addEventListener('click', () => {
    if (!answers[index]) return;
    if (index < quizData.length - 1) { index++; render(); return; }
    const scores = {};
    answers.forEach(type => scores[type] = (scores[type] || 0) + 1);
    const winner = Object.keys(scores).sort((a,b) => scores[b] - scores[a])[0];
    title.hidden = true; answerList.hidden = true;
    document.querySelector('.quiz-progress').hidden = true;
    document.querySelector('.quiz-controls').hidden = true;
    result.hidden = false;
    result.innerHTML = `<span class="result-emoji">💗</span><span class="eyebrow">YOUR PINKVERSE RESULT</span><h2></h2><p></p><small>This is just for fun—not a scientific personality assessment.</small>`;
    result.querySelector('h2').textContent = descriptions[winner][0];
    result.querySelector('p').textContent = descriptions[winner][1];
    restart.hidden = false;
  });
  restart.addEventListener('click', () => {
    index = 0; answers.length = 0;
    title.hidden = false; answerList.hidden = false;
    document.querySelector('.quiz-progress').hidden = false;
    document.querySelector('.quiz-controls').hidden = false;
    result.hidden = true; restart.hidden = true; render();
  });
  render();
});
