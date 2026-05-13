<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../views/register.php');
    exit;
}

if (!isset($_SESSION['reg_email']) || !isset($_SESSION['otp_code'])) {
    header('Location: ../views/register.php');
    exit;
}

// Gabungkan 6 digit OTP dari input
$otp_input = '';
for ($i = 1; $i <= 6; $i++) {
    $otp_input .= $_POST["otp$i"] ?? '';
}

// Cek expired
if (time() > ($_SESSION['otp_expiry'] ?? 0)) {
    $_SESSION['error'] = 'Kode OTP sudah kadaluarsa. Silakan kirim ulang.';
    header('Location: ../views/verify_otp.php');
    exit;
}

// Verifikasi OTP
if ($otp_input !== $_SESSION['otp_code']) {
    $_SESSION['error'] = 'Kode OTP salah. Silakan coba lagi.';
    header('Location: ../views/verify_otp.php');
    exit;
}

// OTP valid
$_SESSION['otp_verified'] = true;
unset($_SESSION['otp_code'], $_SESSION['otp_expiry']);

header('Location: ../views/create_password.php');
exit;
