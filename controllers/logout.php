<?php
session_start();
session_unset();
session_destroy();
header('Location: /Management_UMKM_Desa_Gandoang/index.php');
exit;
