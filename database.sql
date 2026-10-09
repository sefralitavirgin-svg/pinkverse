CREATE DATABASE IF NOT EXISTS pinkverse CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE pinkverse;

CREATE TABLE IF NOT EXISTS users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(24) NOT NULL UNIQUE,
  email VARCHAR(190) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS stories (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(180) NOT NULL,
  category VARCHAR(60) NOT NULL,
  excerpt VARCHAR(300) NOT NULL,
  emoji VARCHAR(20) NOT NULL DEFAULT '📖',
  content TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS favorites (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NOT NULL,
  story_id INT UNSIGNED NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY unique_favorite (user_id, story_id),
  CONSTRAINT fk_favorites_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  CONSTRAINT fk_favorites_story FOREIGN KEY (story_id) REFERENCES stories(id) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO stories (title, category, excerpt, emoji, content) VALUES
('The Girl Who Collected Sunsets', 'Short fiction', 'A tiny story about noticing the moments everyone else walks past.', '🌅',
'Every evening, Nara took the long way home.

Not because she was lost, but because the sky changed its mind every few minutes. Peach became pink, pink became lavender, and the rooftops turned into silhouettes against the last gold of the day.

She started keeping a notebook of sunsets. Not photographs—just a few words for how each one felt.

One Tuesday, a stranger stopped beside her on the bridge. “What are you writing?”

“Proof that ordinary days can still be beautiful,” Nara said.

The stranger looked at the sky, then smiled. “I think I needed that.”

Nara wrote one more line before going home: Today, the sky reminded someone to look up.

And somehow, that felt like enough.'),
('A Playlist for Starting Over', 'Little journal', 'For the days when your next chapter feels exciting and a little scary.', '🎧',
'There is a specific kind of quiet that arrives after you decide to begin again.

Your room looks the same. Your playlist is unchanged. The world has not put up a banner to celebrate your brave little decision.

But something in you has shifted.

So you make a playlist. The first song is for the person you used to be. The second is for the person you are becoming. The third is just there because it makes you want to dance around your room.

Starting over does not always look like a dramatic movie scene. Sometimes it is opening a blank document, sending one email, or choosing to try tomorrow.

Press play. Your next chapter can begin quietly.'),
('The Midnight Bookshop', 'Cozy mystery', 'A mysterious bookshop, a handwritten note, and one very curious reader.', '📚',
'At 11:47 p.m., the bookshop on Willow Lane was supposed to be closed.

Mila knew this because she had checked the sign twice. Still, warm light glowed behind the dusty window, and a small paper star had appeared on the door.

Inside, every clock showed a different time. On the counter sat a book with her name written on a card tucked between its pages.

The first sentence read: “If you found this, someone has been leaving stories for you.”

Mila glanced toward the shelves. Somewhere between mystery and fantasy, a floorboard creaked.

She turned the page.

For the first time that night, she was not sure whether she was reading a story—or stepping into one.');
