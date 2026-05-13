<?php
session_start();
require_once __DIR__ . '/../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../views/register.php');
    exit;
}

if (!isset($_SESSION['otp_verified']) || !isset($_SESSION['reg_email'])) {
    header('Location: ../views/register.php');
    exit;
}

$password         = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

// Validasi server-side
if (empty($password) || empty($confirm_password)) {
    $_SESSION['error'] = 'Password wajib diisi.';
    header('Location: ../views/create_password.php');
    exit;
}

if (strlen($password) < 8) {
    $_SESSION['error'] = 'Password minimal 8 karakter.';
    header('Location: ../views/create_password.php');
    exit;
}

if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
    $_SESSION['error'] = 'Password harus kombinasi huruf dan angka.';
    header('Location: ../views/create_password.php');
    exit;
}

if ($password !== $confirm_password) {
    $_SESSION['error'] = 'Konfirmasi password tidak cocok.';
    header('Location: ../views/create_password.php');
    exit;
}

// Hash password (bcrypt - lebih aman dari MD5)
$hashed = password_hash($password, PASSWORD_DEFAULT);

// Insert ke database
$stmt = $conn->prepare("INSERT INTO user (nama, email, password, status) VALUES (:nama, :email, :password, 'aktif')");
$stmt->execute([
    ':nama'     => $_SESSION['reg_nama'],
    ':email'    => $_SESSION['reg_email'],
    ':password' => $hashed
]);

// Bersihkan session registrasi
unset($_SESSION['reg_nama'], $_SESSION['reg_email'], $_SESSION['otp_verified']);

$_SESSION['success'] = 'Registrasi berhasil! Silakan masuk.';
header('Location: ../views/login.php');
exit;
