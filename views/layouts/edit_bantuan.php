<?php
require_once __DIR__ . '/../../config/koneksi.php';
require_once __DIR__ . '/../../config/path_config.php';

$umkm_result = $conn->query("SELECT id_umkm, nama_umkm FROM umkm");
$umkm_data = $umkm_result->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Tambah Bantuan</title>

    <link href="<?= $asset_path ?>boostrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $asset_path ?>css/tambah_bantuan.css" rel="stylesheet">
</head>

<body>
    <!-- pembungkus utama -->
    <div class="wrapper">

        <!-- sidebar bagian paling atas -->
        <?php require_once __DIR__ . '/sidebar_usser.php'; ?>
        <!-- akhir sidebar -->

        <!-- pembungkus kedua  -->
        <div class="main">

            <!-- awal navbar (isi pertama pembungkus kedua) -->
           <?php require_once __DIR__ . '/navbar_usser.php'; ?>
            <!-- akhir navbar -->

            <!-- awal content (isi kedua pembungkus kedua) -->
            <div class="content">

                <div class="card-dashboard">

                    <form action="../../controllers/proses_edit_bantuan.php" method="post">
                        <h2 class="judul-form">Edit Bantuan</h2>
                        <div class="form-bantuan">
                            <label>Jenis</label>
                            <span>:</span>
                            <input type="text" name="jenis" class="form-control" required>

                            <label>Deksripsi</label>
                            <span>:</span>
                            <textarea name="deksripsi" class="form-control" required></textarea>

                            <label>Pilih UMKM</label>
                            <span>:</span>
                            <select name="id_umkm" class="form-select" required>

                                <option value="">Pilih UMKM</option>

                                <?php foreach ($umkm_data as $umkm): ?>
                                    <option value="<?= $umkm['id_umkm']; ?>">
                                        <?= htmlspecialchars($umkm['nama_umkm']); ?>
                                    </option>
                                <?php endforeach; ?>

                            </select>

                            <!-- Awal prioritas -->
                            <label>Prioritas</label>
                            <span>:</span>
                            <div class="prioritas">

                                <!-- isi  -->
                                <label>
                                    <input type="radio" name="prioritas" value="tinggi" required>
                                    Tinggi
                                </label>

                                <label>
                                    <input type="radio" name="prioritas" value="sedang">
                                    Sedang
                                </label>

                                <label>
                                    <input
                                        type="radio" name="prioritas" value="rendah">
                                    Rendah
                                </label>
                                <!-- akhir dari isi -->
                            </div>
                            <!-- akhir dari prioritas -->

                        </div>

                        <!-- awal tombol -->
                        <div class="tombol">
                            <a href="bantuan.php" class="tombol_batal">
                                Batal
                            </a>

                            <button type="submit" class="tombol_simpan">
                              <img src="<?= $asset_path ?>icon/simpan.png" style="padding:5px" width="30px" height="30px">
                                Simpan
                            </button>
                        </div>
                        <!-- akhir tombol -->

                    </form>
                    <!-- akhir  -->

                </div>

            </div>

        </div>

    </div>
    <!-- akhir pembungkus utama -->

   <script src="<?= $asset_path ?>js/bantuan.js"></script>

</body>

</html>