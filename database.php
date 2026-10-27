<?php
// ============================================================
// FILE SETUP DATABASE — jalankan SEKALI lewat browser:
//   http://localhost/MVC_login/database.php
// Script ini membuat database db_login, tabel users, dan
// dua user contoh. Setelah selesai, file ini boleh dihapus.
// ============================================================

$conn = new mysqli("localhost", "root", "");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Buat database kalau belum ada
$conn->query("CREATE DATABASE IF NOT EXISTS db_login");
$conn->select_db("db_login");

// Buat tabel users kalau belum ada
$conn->query("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
)");

// User contoh (password masih teks biasa, mengikuti UserModel)
$users = [
    ['username' => 'admin',  'password' => 'admin123'],
    ['username' => 'syauqi', 'password' => 'syauqi123'],
];

foreach ($users as $u) {
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $u['username']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        $insert = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $insert->bind_param("ss", $u['username'], $u['password']);
        $insert->execute();
        echo "User dibuat: " . $u['username'] . "<br>";
        $insert->close();
    } else {
        echo "User sudah ada: " . $u['username'] . "<br>";
    }
    $stmt->close();
}

echo "<br>Setup selesai. Silakan <a href='index.php'>login</a>.";
