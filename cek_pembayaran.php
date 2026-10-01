<?php

include "../config/koneksi.php";

$menu_aktif = "cek_pembayaran";
$base = "../";

$cari = "";
$data = null;

if (isset($_GET['cari']) && $_GET['cari'] != "") {

    $cari = $_GET['cari'];

    $data = mysqli_query(
        $koneksi,
        "SELECT
            s.nisn,
            s.nis,
            s.nama,
            s.nama_kelas,
            p.tgl_bayar,
            p.jumlah_bulan,
            p.status
        FROM tb_siswa s
        LEFT JOIN tb_pembayaran p
        ON s.nisn = p.nisn
        WHERE
            s.nisn LIKE '%$cari%'
            OR s.nama LIKE '%$cari%'
        ORDER BY s.nama ASC"
    );
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cek Pembayaran</title>

    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">

</head>

<body>

<div class="container-fluid">

    <div class="row">

        <?php include "../config/sidebar.php"; ?>

        <div class="col-md-10 p-4">

            <h3>Cek Pembayaran</h3>

            <p>
                Cek status pembayaran SPP siswa
            </p>

            <hr>

            <form method="GET">

                <div class="row">

                    <div class="col-md-10">

                        <input
                            type="text"
                            name="cari"
                            class="form-control"
                            placeholder="Masukkan NISN atau Nama Siswa"
                            value="<?= $cari; ?>"
                            required
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

            <br>

            <?php if ($data != null) { ?>

                <table class="table table-bordered">

                    <tr>

                        <th>No</th>

                        <th>NISN</th>

                        <th>NIS</th>

                        <th>Nama</th>

                        <th>Kelas</th>

                        <th>Tanggal Bayar</th>

                        <th>Jumlah Bulan</th>

                        <th>Status</th>

                    </tr>

                    <?php

                    $no = 1;

                    if (mysqli_num_rows($data) > 0) {

                        while ($row = mysqli_fetch_assoc($data)) {

                    ?>

                    <tr>

                        <td>
                            <?= $no++; ?>
                        </td>

                        <td>
                            <?= $row['nisn']; ?>
                        </td>

                        <td>
                            <?= $row['nis']; ?>
                        </td>

                        <td>
                            <?= $row['nama']; ?>
                        </td>

                        <td>
                            <?= $row['nama_kelas']; ?>
                        </td>

                        <td>

                            <?php

                            if (
                                $row['tgl_bayar'] != null &&
                                $row['tgl_bayar'] != '0000-00-00'
                            ) {

                                echo $row['tgl_bayar'];

                            } else {

                                echo "-";

                            }

                            ?>

                        </td>

                        <td>

                            <?php

                            if ($row['jumlah_bulan'] != null) {

                                echo $row['jumlah_bulan'] . " Bulan";

                            } else {

                                echo "-";

                            }

                            ?>

                        </td>

                        <td>

                            <?php

                            if ($row['status'] == "Sudah Lunas") {

                            ?>

                                <span class="badge bg-success">
                                    Sudah Lunas
                                </span>

                            <?php

                            } else {

                            ?>

                                <span class="badge bg-danger">
                                    Belum Lunas
                                </span>

                            <?php

                            }

                            ?>

                        </td>

                    </tr>

                    <?php

                        }

                    } else {

                    ?>

                    <tr>

                        <td colspan="8" class="text-center">

                            Data siswa tidak ditemukan.

                        </td>

                    </tr>

                    <?php

                    }

                    ?>

                </table>

            <?php } ?>

        </div>

    </div>

</div>

</body>

</html>