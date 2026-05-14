<?php
require_once __DIR__ . '/../../config/koneksi.php';
require_once __DIR__ . '/../../config/path_config.php';

$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 5;

if (!in_array($limit, [3, 5, 10])) {
    $limit = 5;
}

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$offset = ($page - 1) * $limit;

$total_result = $conn->query("SELECT COUNT(*) AS total FROM bantuan WHERE status != 'dihapus'");
$total_row = $total_result->fetch(PDO::FETCH_ASSOC);
$total_data = $total_row['total'];
$total_page = ceil($total_data / $limit);

$sql = "SELECT 
        bantuan.*,
        umkm.nama_umkm,
        pengaju.nama AS nama_pengaju,
        validator.nama AS nama_validator
    FROM bantuan

    LEFT JOIN umkm 
        ON bantuan.id_umkm = umkm.id_umkm

    LEFT JOIN user AS pengaju
        ON umkm.id_user = pengaju.id_user

    LEFT JOIN user AS validator
        ON umkm.id_validator = validator.id_user

    WHERE bantuan.status != 'dihapus'

    LIMIT $limit OFFSET $offset
";

$result = $conn->query($sql);
$data = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ajukan Bantuan</title>

    <!-- bootstrap -->
    <link href="<?= $asset_path ?>/boostrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- css -->
    <link href="<?= $asset_path ?>/css/bantuan.css" rel="stylesheet">

</head>

<body>

    <!-- pembungkus utama -->
    <div class="wrapper">

        <!-- sidebar -->
        <?php require_once __DIR__ . '/../../views/layouts/sidebar_usser.php'; ?>
        <!-- akhir sidebar -->

        <!-- main -->
        <div class="main">

            <!-- navbar -->
            <?php require_once __DIR__ . '/../../views/layouts/navbar_usser.php'; ?>
            <!-- akhir navbar -->

            <!-- content -->
            <div class="content">
                <div class="card-dashboard">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2>Detail Bantuan</h2>
                            <p>Verifikasi Bantuan Yang Diajukan Oleh UMKM</p>
                        </div>
                    </div>

                    <!-- search -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <form method="get">
                            Show
                            <select name="limit" class="form-select d-inline-block w-auto" onchange="this.form.submit()">
                                <option value="3" <?= ($limit == 3) ? 'selected' : '' ?>>3</option>
                                <option value="5" <?= ($limit == 5) ? 'selected' : '' ?>>5</option>
                                <option value="10" <?= ($limit == 10) ? 'selected' : '' ?>>10</option>
                            </select>
                            entries
                        </form>
                        <div>
                            <input type="text" class="form-control" placeholder="Cari Pengajuan...">
                        </div>
                    </div>
                    <!-- akhir search -->

                    <!-- tabel -->
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>id_kebutuhan</th>
                                    <th>nama_umkm</th>
                                    <th>prioritas</th>
                                    <th>nama_pengaju</th>
                                    <th>nama_validator</th>
                                    <th>jenis_bantuan</th>
                                    <th>tanggal_pengajuan</th>
                                    <th>tanggal_validasi</th>
                                    <th>status</th>
                                    <th>catatan</th>
                                    <th>Deskripsi</th>
                                    <th>aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $row): ?>
                                    <tr>
                                        <td><?= $row['id_kebutuhan']; ?></td>
                                        <td><?= htmlspecialchars($row['nama_umkm']); ?></td>
                                        <td><?= htmlspecialchars($row['prioritas']); ?></td>
                                        <td><?= htmlspecialchars($row['nama_pengaju'] ?? 'Tidak diketahui'); ?></td>
                                        <td><?= $row['tanggal_validasi'] ? htmlspecialchars($row['nama_validator']) : 'Belum divalidasi'; ?></td>
                                        <td><?= htmlspecialchars($row['jenis']); ?></td>
                                        <td><?= $row['tanggal_pengajuan']; ?></td>
                                        <td><?= $row['tanggal_validasi'] ?? 'Null'; ?></td>
                                        <td><?= $row['catatan'] ? htmlspecialchars($row['catatan']) : 'Belum ada catatan'; ?></td>
                                        <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                                        <td>
                                            <span class="<?= $row['status']; ?>">
                                                <?= $row['status']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="edit_bantuan.php?id=<?= $row['id_kebutuhan'] ?>" class="btn btn-warning btn-sm">
                                                <img src="<?= $asset_path ?>/icon/edit.png" width="30px" height="30px">
                                            </a>

                                            <a href="hapus_bantuan.php?id=<?= $row['id_kebutuhan'] ?>" class="btn btn-danger btn-sm">
                                                <img src="<?= $asset_path ?>/icon/hapus.png" style="padding:5px" width="30px" height="30px">
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- akhir tabel -->

                    <br>

                    <!-- awal dari pagination -->
                    <ul class="pagination custom-pagination justify-content-center mt-4">

                        <!-- tombol previous -->
                        <li class="page-item <?= ($page == 1) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page - 1 ?>&limit=<?= $limit ?>">
                                Previous
                            </a>
                        </li>

                        <!-- nomor halaman -->
                        <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>&limit=<?= $limit ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                        <?php } ?>

                        <!-- tombol next -->
                        <li class="page-item <?= ($page == $total_page) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page + 1 ?>&limit=<?= $limit ?>">
                                Next
                            </a>
                        </li>

                    </ul>
                    <!-- akhir dari pagination -->

                    <!-- tambah -->
                    <div class="d-flex justify-content-end">
                        <a href="tambah_bantuan.php" class="btn" id="tambah">
                            + Tambah Pengajuan
                        </a>
                    </div>
                    <!-- akhir tambah -->

                </div>
                <!-- akhir card dashboard -->

            </div>
            <!-- akhir content -->

        </div>
        <!-- akhir main -->

    </div>
    <!-- akhir pembungkus utama -->

    <!-- alert sukses -->
    <?php if (isset($_GET['status']) && $_GET['status'] == 'tambah_sukses'): ?>
        <div class="alert_sukses_menambah">
            <div class="box_sukses_menambah">
                <div class="icon_sukses_menambah">
                    <img src="<?= $asset_path ?>/icon/sukses.png" alt="Sukses">
                </div>
                <h2>Berhasil Menambahkan</h2>
                <p>Pengajuan Bantuan Berhasil Ditambahkan</p>
                <a href="bantuan.php" class="tombol_sukses_menambah">
                    Tutup
                </a>
            </div>
        </div>
    <?php endif; ?>
    <!-- akhir alert sukses -->

    <script src="<?= $asset_path ?>/js/bantuan.js"></script>

</body>

</html>