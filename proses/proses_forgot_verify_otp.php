<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../views/forgot_password.php');
    exit;
}

if (!isset($_SESSION['reset_email']) || !isset($_SESSION['otp_code'])) {
    header('Location: ../views/forgot_password.php');
    exit;
}

$otp_input = '';
for ($i = 1; $i <= 6; $i++) {
    $otp_input .= $_POST["otp$i"] ?? '';
}

if (time() > ($_SESSION['otp_expiry'] ?? 0)) {
    $_SESSION['error'] = 'Kode OTP sudah kadaluarsa. Silakan kirim ulang.';
    header('Location: ../views/forgot_verify_otp.php');
    exit;
}

if ($otp_input !== $_SESSION['otp_code']) {
    $_SESSION['error'] = 'Kode OTP salah. Silakan coba lagi.';
    header('Location: ../views/forgot_verify_otp.php');
    exit;
}

// OTP valid
$_SESSION['reset_verified'] = true;
unset($_SESSION['otp_code'], $_SESSION['otp_expiry']);

header('Location: ../views/reset_password.php');
exit;
