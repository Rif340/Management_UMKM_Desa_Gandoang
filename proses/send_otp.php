<?php
// File ini di-require dari proses_register.php (session sudah aktif)
require_once __DIR__ . '/../config/otp_config.php';

// Generate OTP 6 digit
$otp = str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT);

// Simpan OTP di session
$_SESSION['otp_code']   = $USE_REAL_OTP ? $otp : '123456';
$_SESSION['otp_expiry'] = time() + ($OTP_EXPIRY_MINUTES * 60);

if ($USE_REAL_OTP) {
    // Kirim email via PHPMailer
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
        $mail->addAddress($_SESSION['reg_email']);
        $mail->Subject = 'Kode OTP Registrasi - UMKM Gandoang';
        $mail->Body    = "Kode OTP Anda: $otp\n\nKode berlaku selama $OTP_EXPIRY_MINUTES menit.";

        $mail->send();
    } catch (Exception $e) {
        // Fallback ke dummy jika gagal kirim
        $_SESSION['otp_code'] = '123456';
    }
}
// Jika $USE_REAL_OTP = false, OTP otomatis "123456" (sudah di-set di atas)
