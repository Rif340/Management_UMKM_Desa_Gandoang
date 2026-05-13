<?php
session_start();

if (!isset($_SESSION['reset_email'])) {
    header('Location: ../view/forgot_password.php');
    exit;
}

require_once __DIR__ . '/../config/otp_config.php';

$otp = str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT);
$_SESSION['otp_code'] = $USE_REAL_OTP ? $otp : '123456';
$_SESSION['otp_expiry'] = time() + ($OTP_EXPIRY_MINUTES * 60);

if ($USE_REAL_OTP) {
    require_once __DIR__ . '/../vendor/autoload.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = $SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = $SMTP_USER;
        $mail->Password   = $SMTP_PASS;
        $mail->SMTPSecure = 'tls';
        $mail->Port       = $SMTP_PORT;

        $mail->setFrom($SMTP_USER, $SMTP_FROM_NAME);
        $mail->addAddress($_SESSION['reset_email']);
        $mail->Subject = 'Kode OTP Reset Password - UMKM Gandoang';
        $mail->Body    = "Kode OTP Anda: $otp\n\nKode berlaku selama $OTP_EXPIRY_MINUTES menit.";

        $mail->send();
    } catch (Exception $e) {
        $_SESSION['otp_code'] = '123456';
    }
}

header('Location: ../view/forgot_verify_otp.php');
exit;
