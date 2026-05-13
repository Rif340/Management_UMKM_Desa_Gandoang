<?php
session_start();

if (!isset($_SESSION['reg_email'])) {
    header('Location: ../views/register.php');
    exit;
}

require_once __DIR__ . '/send_otp.php';

header('Location: ../views/verify_otp.php');
exit;
