<?php
$USE_REAL_OTP = true; // Ganti ke true jika SMTP sudah siap

// Konfigurasi SMTP (Gmail)
$SMTP_HOST = 'sandbox.smtp.mailtrap.io';
$SMTP_PORT = 2525;
$SMTP_USER = 'd38b08e42484f8';
$SMTP_PASS = '57cb6c34ae5694';
$SMTP_FROM_NAME = 'UMKM Gandoang';

// OTP Settings
$OTP_LENGTH = 6;
$OTP_EXPIRY_MINUTES = 5;
