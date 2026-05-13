<?php
session_start();

if (!isset($_SESSION['reg_email'])) {
    header('Location: ../view/register.php');
    exit;
}

require_once __DIR__ . '/send_otp.php';

header('Location: ../view/verify_otp.php');
exit;
