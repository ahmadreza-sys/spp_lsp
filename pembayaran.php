<?php

include "../config/koneksi.php";

$menu_aktif = "pembayaran";
$base = "../";

if (isset($_GET['hapus'])) {

    $id = $_GET['hapus'];

    mysqli_query(
        $koneksi,
        "DELETE FROM tb_pembayaran
         WHERE id_pembayaran='$id'"
    );

    header("Location: pembayaran.php");
    exit;
}

$data = mysqli_query(
    $koneksi,
    "SELECT
        tb_pembayaran.id_pembayaran,
        tb_pembayaran.nisn,
        tb_pembayaran.tgl_bayar,
        tb_pembayaran.jumlah_bulan,
        tb_pembayaran.status,
        tb_siswa.nama
    FROM tb_pembayaran
    LEFT JOIN tb_siswa
    ON tb_pembayaran.nisn = tb_siswa.nisn
    ORDER BY tb_pembayaran.id_pembayaran ASC"
);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Pembayaran</title>

    <link
        rel="stylesheet"
        href="../assets/bootstrap/css/bootstrap.min.css"
    >

</head>

<body>

<div class="container-fluid">

    <div class="row">

        <?php include "../config/sidebar.php"; ?>

        <div class="col-md-10 p-4">

            <h3>Data Pembayaran</h3>

            <br>

            <a
                href="pembayaran_tambah.php"
                class="btn btn-primary"
            >
                Tambah
            </a>

            <br><br>

            <table class="table table-bordered">

                <tr>

                    <th>No</th>

                    <th>ID Pembayaran</th>

                    <th>NISN</th>

                    <th>Nama</th>

                    <th>Tanggal Bayar</th>

                    <th>Jumlah Bulan</th>

                    <th>Status</th>

                    <th>Aksi</th>

                </tr>

                <?php

                $no = 1;

                while ($row = mysqli_fetch_assoc($data)) {

                ?>

                <tr>

                    <td>
                        <?= $no++; ?>
                    </td>

                    <td>
                        <?= $row['id_pembayaran']; ?>
                    </td>

                    <td>
                        <?= $row['nisn']; ?>
                    </td>

                    <td>
                        <?= $row['nama']; ?>
                    </td>

                    <td>
                        <?= $row['tgl_bayar']; ?>
                    </td>

                    <td>
                        <?= $row['jumlah_bulan']; ?> Bulan
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

                    <td>

                        <a
                            href="pembayaran_edit.php?id=<?= $row['id_pembayaran']; ?>"
                            class="btn btn-warning btn-sm"
                        >
                            Edit
                        </a>

                        <a
                            href="pembayaran.php?hapus=<?= $row['id_pembayaran']; ?>"
                            class="btn btn-danger btn-sm"
                        >
                            Hapus
                        </a>

                    </td>

                </tr>

                <?php } ?>

            </table>

        </div>

    </div>

</div>

</body>

</html>