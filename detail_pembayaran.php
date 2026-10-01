<?php

include "../config/koneksi.php";

$menu_aktif = "detail_pembayaran";
$base = "../";


/*
|--------------------------------------------------------------------------
| PENCARIAN DETAIL PEMBAYARAN
|--------------------------------------------------------------------------
*/

$cari = "";

if (isset($_GET['cari'])) {

    $cari = $_GET['cari'];

    $data = mysqli_query(
        $koneksi,
        "SELECT
            p.id_pembayaran,
            p.status,
            p.nisn,
            s.nis,
            s.nama,
            s.nama_kelas,
            p.tgl_bayar,
            p.tgl_terakhir_bayar,
            p.batas_pembayaran,
            p.jumlah_bulan,
            p.id_spp,
            p.nominal_bayar,
            p.jumlah_bayar,
            p.kembalian
         FROM tb_pembayaran p
         LEFT JOIN tb_siswa s
            ON p.nisn = s.nisn
         WHERE
            p.id_pembayaran LIKE '%$cari%'
            OR p.nisn LIKE '%$cari%'
            OR s.nis LIKE '%$cari%'
            OR s.nama LIKE '%$cari%'
            OR p.id_spp LIKE '%$cari%'
         ORDER BY p.id_pembayaran ASC"
    );

} else {

    $data = mysqli_query(
        $koneksi,
        "SELECT
            p.id_pembayaran,
            p.status,
            p.nisn,
            s.nis,
            s.nama,
            s.nama_kelas,
            p.tgl_bayar,
            p.tgl_terakhir_bayar,
            p.batas_pembayaran,
            p.jumlah_bulan,
            p.id_spp,
            p.nominal_bayar,
            p.jumlah_bayar,
            p.kembalian
         FROM tb_pembayaran p
         LEFT JOIN tb_siswa s
            ON p.nisn = s.nisn
         ORDER BY p.id_pembayaran ASC"
    );
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Detail Pembayaran - SPP LSP</title>

    <!-- Bootstrap Offline -->
    <link
        rel="stylesheet"
        href="../assets/bootstrap/css/bootstrap.min.css"
    >

</head>

<body>

<div class="container-fluid">

    <div class="row">

        <!-- =====================================================
             SIDEBAR
        ====================================================== -->

        <?php include "../config/sidebar.php"; ?>


        <!-- =====================================================
             CONTENT
        ====================================================== -->

        <div class="col-md-10 p-4">

            <!-- JUDUL -->

            <h3 class="fw-bold">
                Detail Pembayaran
            </h3>

            <p class="text-muted">
                Menampilkan detail transaksi pembayaran SPP siswa
            </p>

            <hr>


            <!-- =================================================
                 PENCARIAN
            ================================================== -->

            <div class="card shadow-sm mb-4">

                <div class="card-header">

                    <strong>
                        Cari Detail Pembayaran
                    </strong>

                </div>

                <div class="card-body">

                    <form method="GET">

                        <div class="row">

                            <div class="col-md-10">

                                <input
                                    type="text"
                                    name="cari"
                                    class="form-control"
                                    placeholder="Cari ID pembayaran, NISN, NIS, nama siswa atau ID SPP..."
                                    value="<?= htmlspecialchars($cari); ?>"
                                >

                            </div>

                            <div class="col-md-2">

                                <button
                                    type="submit"
                                    class="btn btn-primary w-100"
                                >
                                    Cari
                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>


            <!-- =================================================
                 TABEL DETAIL PEMBAYARAN
            ================================================== -->

            <div class="card shadow-sm">

                <div class="card-header">

                    <strong>
                        Daftar Detail Pembayaran
                    </strong>

                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table
                            class="table table-bordered table-striped table-hover"
                        >

                            <thead class="table-dark">

                                <tr>

                                    <th>No</th>

                                    <th>ID Pembayaran</th>

                                    <th>NISN</th>

                                    <th>NIS</th>

                                    <th>Nama Siswa</th>

                                    <th>Kelas</th>

                                    <th>Status</th>

                                    <th>Tanggal Bayar</th>

                                    <th>Terakhir Bayar</th>

                                    <th>Batas Pembayaran</th>

                                    <th>Jumlah Bulan</th>

                                    <th>ID SPP</th>

                                    <th>Nominal Bayar</th>

                                    <th>Jumlah Bayar</th>

                                    <th>Kembalian</th>

                                </tr>

                            </thead>


                            <tbody>

                            <?php

                            $no = 1;

                            if (mysqli_num_rows($data) > 0) {

                                while ($row = mysqli_fetch_assoc($data)) {

                            ?>

                                <tr>

                                    <!-- NO -->

                                    <td>
                                        <?= $no++; ?>
                                    </td>


                                    <!-- ID PEMBAYARAN -->

                                    <td>
                                        <?= htmlspecialchars(
                                            $row['id_pembayaran']
                                        ); ?>
                                    </td>


                                    <!-- NISN -->

                                    <td>
                                        <?= htmlspecialchars(
                                            $row['nisn']
                                        ); ?>
                                    </td>


                                    <!-- NIS -->

                                    <td>
                                        <?= htmlspecialchars(
                                            $row['nis']
                                        ); ?>
                                    </td>


                                    <!-- NAMA -->

                                    <td>
                                        <?= htmlspecialchars(
                                            $row['nama']
                                        ); ?>
                                    </td>


                                    <!-- KELAS -->

                                    <td>
                                        <?= htmlspecialchars(
                                            $row['nama_kelas']
                                        ); ?>
                                    </td>


                                    <!-- STATUS -->

                                    <td>

                                        <?php if (
                                            $row['status'] ==
                                            'Sudah Lunas'
                                        ) { ?>

                                            <span class="badge bg-success">
                                                Sudah Lunas
                                            </span>

                                        <?php } else { ?>

                                            <span class="badge bg-danger">
                                                Belum Lunas
                                            </span>

                                        <?php } ?>

                                    </td>


                                    <!-- TANGGAL BAYAR -->

                                    <td>
                                        <?= htmlspecialchars(
                                            $row['tgl_bayar']
                                        ); ?>
                                    </td>


                                    <!-- TERAKHIR BAYAR -->

                                    <td>
                                        <?= htmlspecialchars(
                                            $row['tgl_terakhir_bayar']
                                        ); ?>
                                    </td>


                                    <!-- BATAS PEMBAYARAN -->

                                    <td>
                                        <?= htmlspecialchars(
                                            $row['batas_pembayaran']
                                        ); ?>
                                    </td>


                                    <!-- JUMLAH BULAN -->

                                    <td>
                                        <?= htmlspecialchars(
                                            $row['jumlah_bulan']
                                        ); ?>
                                        Bulan
                                    </td>


                                    <!-- ID SPP -->

                                    <td>
                                        <?= htmlspecialchars(
                                            $row['id_spp']
                                        ); ?>
                                    </td>


                                    <!-- NOMINAL BAYAR -->

                                    <td>
                                        Rp
                                        <?= number_format(
                                            (int)$row['nominal_bayar'],
                                            0,
                                            ',',
                                            '.'
                                        ); ?>
                                    </td>


                                    <!-- JUMLAH BAYAR -->

                                    <td>
                                        Rp
                                        <?= number_format(
                                            (int)$row['jumlah_bayar'],
                                            0,
                                            ',',
                                            '.'
                                        ); ?>
                                    </td>


                                    <!-- KEMBALIAN -->

                                    <td>
                                        Rp
                                        <?= number_format(
                                            (int)$row['kembalian'],
                                            0,
                                            ',',
                                            '.'
                                        ); ?>
                                    </td>

                                </tr>

                            <?php

                                }

                            } else {

                            ?>

                                <tr>

                                    <td
                                        colspan="15"
                                        class="text-center"
                                    >
                                        Data pembayaran belum tersedia.
                                    </td>

                                </tr>

                            <?php

                            }

                            ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- Bootstrap Offline JS -->

<script
    src="../assets/bootstrap/js/bootstrap.bundle.min.js">
</script>

</body>

</html>