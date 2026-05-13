<?php
session_start();
require_once __DIR__ . '/../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../views/forgot_password.php');
    exit;
}

if (!isset($_SESSION['reset_verified']) || !isset($_SESSION['reset_email'])) {
    header('Location: ../views/forgot_password.php');
    exit;
}

$password         = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

if (empty($password) || empty($confirm_password)) {
    $_SESSION['error'] = 'Password wajib diisi.';
    header('Location: ../views/reset_password.php');
    exit;
}

if (strlen($password) < 8) {
    $_SESSION['error'] = 'Password minimal 8 karakter.';
    header('Location: ../views/reset_password.php');
    exit;
}

if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
    $_SESSION['error'] = 'Password harus kombinasi huruf dan angka.';
    header('Location: ../views/reset_password.php');
    exit;
}

if ($password !== $confirm_password) {
    $_SESSION['error'] = 'Konfirmasi password tidak cocok.';
    header('Location: ../views/reset_password.php');
    exit;
}

$hashed = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("UPDATE user SET password = :password WHERE email = :email");
$stmt->execute([
    ':password' => $hashed,
    ':email'    => $_SESSION['reset_email']
]);

// Bersihkan session reset
unset($_SESSION['reset_email'], $_SESSION['reset_user_id'], $_SESSION['reset_verified']);

$_SESSION['success'] = 'Password berhasil direset! Silakan masuk.';
header('Location: ../views/login.php');
exit;
