<?php
$base_url = '/Management_UMKM_Desa_Gandoang';
$is_view = (strpos($_SERVER['SCRIPT_NAME'], '/views/') !== false);
$asset_path = $is_view ? '../asset' : 'asset';
$view_path = $is_view ? '' : 'views/';
$root_path = $is_view ? '../' : '';
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">

<style>
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
nav { padding: 0.8rem 3rem; width: 100%; background-color: #2d5a3f; display: flex; align-items: center; justify-content: space-between; }
.logo a { display: flex; align-items: center; text-decoration: none; }
.logo img { height: 40px; width: auto; }
.menu a { text-decoration: none; color: white; font-size: 1rem; font-weight: 600; }
.auth { display: flex; gap: 0.8rem; }
.auth a { text-decoration: none; color: #2d5a3f; font-size: 0.9rem; font-weight: 600; padding: 0.5rem 1.5rem; border-radius: 20px; border: 2px solid white; background: white; }
.auth a:hover { background: transparent; color: white; }
</style>

<nav>
    <div class="logo">
        <a href="<?= $root_path ?>index.php">
            <img src="<?= $asset_path ?>/images/logo.png" alt="UMKM Gandoang">
        </a>
    </div>
    <div class="menu">
        <a href="#">Lihat Product</a>
    </div>
    <div class="auth">
        <a href="<?= $root_path ?><?= $view_path ?>login.php">Masuk</a>
        <a href="<?= $root_path ?><?= $view_path ?>register.php">Daftar</a>
    </div>
</nav>
