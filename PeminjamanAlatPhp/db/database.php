<?php
// database.php

$host     = 'localhost';
$username = 'root';
$password = '';
$dbname   = 'db_peminjaman_alat';
$charset  = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

// Helper function untuk query simpel
function dbQuery($sql, $params = []) {
    global $pdo;
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt;
}

// Helper function untuk ambil 1 baris data
function fetchOne($sql, $params = []) {
    return dbQuery($sql, $params)->fetch();
}

// Helper function untuk ambil banyak data (array)
function fetchAll($sql, $params = []) {
    return dbQuery($sql, $params)->fetchAll();
}
?>
