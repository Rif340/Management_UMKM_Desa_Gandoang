<?php
session_start();
require_once __DIR__ . '/../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../views/register.php');
    exit;
}

$nama  = trim($_POST['nama'] ?? '');
$email = trim($_POST['email'] ?? '');

// Validasi server-side
if (empty($nama) || empty($email)) {
    $_SESSION['error'] = 'Nama dan email wajib diisi.';
    header('Location: ../views/register.php');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'Format email tidak valid.';
    header('Location: ../views/register.php');
    exit;
}

// Cek apakah email sudah terdaftar
$stmt = $conn->prepare("SELECT id_user FROM user WHERE email = :email");
$stmt->execute([':email' => $email]);
if ($stmt->fetch()) {
    $_SESSION['error'] = 'Email sudah terdaftar. Silakan masuk.';
    header('Location: ../views/register.php');
    exit;
}

// Simpan data sementara di session
$_SESSION['reg_nama']  = $nama;
$_SESSION['reg_email'] = $email;

// Kirim OTP
require_once __DIR__ . '/send_otp.php';

header('Location: ../views/verify_otp.php');
exit;
