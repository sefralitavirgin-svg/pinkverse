# Pinkverse 🎀

Website hiburan bertema Pink IT Girl yang dibuat dengan PHP native, MySQL, HTML, CSS, dan JavaScript.

## Fitur
- Landing page responsif
- Registrasi dan login dengan password hashing
- Story Room: daftar, pencarian, dan halaman baca cerita
- Favorites: simpan cerita per akun
- Fun Zone: kuis personality ringan yang berjalan di browser
- Moodboard: kartu afirmasi, tombol salin, dan shuffle
- Prepared statements (PDO) untuk query database
- Escape output HTML untuk mengurangi risiko XSS

## Kebutuhan
- PHP 8.0+ (disarankan PHP 8.1+)
- MySQL/MariaDB
- Laragon atau XAMPP
- Ekstensi PDO MySQL dan mbstring

## Menjalankan di Laragon
1. Ekstrak folder `pinkverse` ke `C:\laragon\www\pinkverse`.
2. Buka Laragon, klik **Start All**.
3. Buka `http://localhost/phpmyadmin` (atau menu Database Laragon).
4. Import file `database.sql`.
5. Jika kredensial MySQL lokalmu berbeda, ubah `$host`, `$db`, `$user`, dan `$pass` di `config.php`.
6. Buka `http://localhost/pinkverse`.

## Menjalankan di XAMPP
1. Ekstrak folder `pinkverse` ke `C:\xampp\htdocs\pinkverse`.
2. Jalankan Apache dan MySQL dari XAMPP Control Panel.
3. Buka phpMyAdmin, lalu import `database.sql`.
4. Sesuaikan kredensial database di `config.php` bila perlu.
5. Buka `http://localhost/pinkverse`.

## Catatan
- Website ini adalah MVP lokal. Sebelum dipasang online, gunakan kredensial database khusus, HTTPS, proteksi CSRF pada form, pembatasan percobaan login, validasi tambahan, serta konfigurasi error/logging yang aman.
- Kuis adalah hiburan ringan, bukan asesmen psikologis.
- Font Google Fonts membutuhkan koneksi internet; fallback font tetap tersedia.
