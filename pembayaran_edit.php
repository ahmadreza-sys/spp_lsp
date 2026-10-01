<?php

include "../config/koneksi.php";

$menu_aktif = "pembayaran";
$base = "../";

$id = $_GET['id'];

$data = mysqli_query(
    $koneksi,
    "SELECT * FROM tb_pembayaran
     WHERE id_pembayaran='$id'"
);

$pembayaran = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {

    $nisn = $_POST['nisn'];
    $tgl_bayar = $_POST['tgl_bayar'];
    $jumlah_bulan = $_POST['jumlah_bulan'];
    $id_spp = $_POST['id_spp'];
    $status = $_POST['status'];

    $data_spp = mysqli_query(
        $koneksi,
        "SELECT * FROM tb_spp
         WHERE id_spp='$id_spp'"
    );

    $spp = mysqli_fetch_assoc($data_spp);

    $nominal = $spp['nominal'];

    $jumlah_bayar = $nominal * $jumlah_bulan;

    $tgl_terakhir_bayar = $tgl_bayar;

    $batas_pembayaran = date(
        'Y-m-d',
        strtotime($tgl_bayar . ' +30 days')
    );

    $kembalian = 0;

    mysqli_query(
        $koneksi,
        "UPDATE tb_pembayaran SET

            status='$status',

            nisn='$nisn',

            tgl_bayar='$tgl_bayar',

            tgl_terakhir_bayar='$tgl_terakhir_bayar',

            batas_pembayaran='$batas_pembayaran',

            jumlah_bulan='$jumlah_bulan',

            id_spp='$id_spp',

            nominal_bayar='$nominal',

            jumlah_bayar='$jumlah_bayar',

            kembalian='$kembalian'

        WHERE id_pembayaran='$id'"
    );

    header("Location: pembayaran.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Edit Pembayaran</title>

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

            <h3>Edit Pembayaran</h3>

            <br>

            <form method="POST">

                <div class="mb-3">

                    <label>ID Pembayaran</label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= $pembayaran['id_pembayaran']; ?>"
                        readonly
                    >

                </div>

                <div class="mb-3">

                    <label>Siswa</label>

                    <select
                        name="nisn"
                        class="form-control"
                        required
                    >

                        <option value="">
                            Pilih Siswa
                        </option>

                        <?php

                        $siswa = mysqli_query(
                            $koneksi,
                            "SELECT * FROM tb_siswa
                             ORDER BY nama ASC"
                        );

                        while ($row = mysqli_fetch_assoc($siswa)) {

                        ?>

                        <option
                            value="<?= $row['nisn']; ?>"
                            <?php

                            if (
                                $row['nisn']
                                ==
                                $pembayaran['nisn']
                            ) {

                                echo "selected";

                            }

                            ?>
                        >

                            <?= $row['nisn']; ?>
                            -
                            <?= $row['nama']; ?>

                        </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Tanggal Bayar</label>

                    <input
                        type="date"
                        name="tgl_bayar"
                        class="form-control"
                        value="<?= $pembayaran['tgl_bayar']; ?>"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label>Jumlah Bulan</label>

                    <input
                        type="number"
                        name="jumlah_bulan"
                        class="form-control"
                        value="<?= $pembayaran['jumlah_bulan']; ?>"
                        min="1"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label>SPP</label>

                    <select
                        name="id_spp"
                        class="form-control"
                        required
                    >

                        <option value="">
                            Pilih SPP
                        </option>

                        <?php

                        $spp = mysqli_query(
                            $koneksi,
                            "SELECT * FROM tb_spp
                             ORDER BY id_spp ASC"
                        );

                        while ($row = mysqli_fetch_assoc($spp)) {

                        ?>

                        <option
                            value="<?= $row['id_spp']; ?>"
                            <?php

                            if (
                                $row['id_spp']
                                ==
                                $pembayaran['id_spp']
                            ) {

                                echo "selected";

                            }

                            ?>
                        >

                            <?= $row['id_spp']; ?>
                            -
                            Rp <?= number_format(
                                $row['nominal'],
                                0,
                                ',',
                                '.'
                            ); ?>

                        </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Status</label>

                    <select
                        name="status"
                        class="form-control"
                        required
                    >

                        <option
                            value="Sudah Lunas"
                            <?php

                            if (
                                $pembayaran['status']
                                ==
                                "Sudah Lunas"
                            ) {

                                echo "selected";

                            }

                            ?>
                        >
                            Sudah Lunas
                        </option>

                        <option
                            value="Belum Lunas"
                            <?php

                            if (
                                $pembayaran['status']
                                ==
                                "Belum Lunas"
                            ) {

                                echo "selected";

                            }

                            ?>
                        >
                            Belum Lunas
                        </option>

                    </select>

                </div>

                <button
                    type="submit"
                    name="update"
                    class="btn btn-primary"
                >
                    Update
                </button>

                <a
                    href="pembayaran.php"
                    class="btn btn-secondary"
                >
                    Kembali
                </a>

            </form>

        </div>

    </div>

</div>

</body>

</html>