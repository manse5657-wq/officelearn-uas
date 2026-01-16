<?php
// db.php
// letakkan di root project, include ini di file lain
define('DB_HOST','127.0.0.1');
define('DB_NAME','web_uas');    // ganti jika berbeda
define('DB_USER','root');      // ganti sesuai
define('DB_PASS','');          // ganti sesuai (kosong untuk XAMPP default)

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO(
        "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        $options
    );
} catch (Exception $e) {
    // jangan tampilkan di production; untuk debugging cukup echo
    echo "Koneksi DB gagal: " . $e->getMessage();
    exit;
}
