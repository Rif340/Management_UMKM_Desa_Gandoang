<?php
session_start();
require_once __DIR__ . '/../config/koneksi.php';

// Cegah akses langsung via URL
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../view/login.php');
    exit;
}

$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Validasi server-side
if (empty($email) || empty($password)) {
    $_SESSION['error'] = 'Email dan kata sandi wajib diisi.';
    header('Location: ../view/login.php');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'Format email tidak valid.';
    header('Location: ../view/login.php');
    exit;
}

// Cek user di database (Prepared Statement - cegah SQL Injection)
$stmt = $conn->prepare("SELECT id_user, nama, email, password, status FROM user WHERE email = :email");
$stmt->execute([':email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($password, $user['password'])) {
    $_SESSION['error'] = 'Email atau kata sandi salah.';
    header('Location: ../view/login.php');
    exit;
}

if ($user['status'] !== 'aktif') {
    $_SESSION['error'] = 'Akun Anda belum aktif. Hubungi admin.';
    header('Location: ../view/login.php');
    exit;
}

// Set session
$_SESSION['user_id']   = $user['id_user'];
$_SESSION['user_nama'] = $user['nama'];
$_SESSION['user_email'] = $user['email'];
$_SESSION['logged_in'] = true;

header('Location: ../index.php');
exit;
