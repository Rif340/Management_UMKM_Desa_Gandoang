<?php
declare(strict_types=1);

$host = "localhost";
$db   = "nama_database";
$user = "root";
$pass = "";

try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    error_log($e->getMessage());
    die("Terjadi kesalahan pada server.");
}