<?php
declare(strict_types=1);

$host = "localhost";
$port = "3306";
$db   = "umkm_desa";
$user = "root";
$pass = "";

try {
    $conn = new PDO(
        "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4",
        $user,
        $pass
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log($e->getMessage());
    die("Terjadi kesalahan pada server.");
}
