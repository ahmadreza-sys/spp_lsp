<?php

include "../config/koneksi.php";

$menu_aktif = "pembayaran";
$base = "../";

if (isset($_POST['simpan'])) {

    $id_pembayaran = $_POST['id_pembayaran'];
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
        "INSERT INTO tb_pembayaran
        (
            id_pembayaran,
            status,
            nisn,
            tgl_bayar,
            tgl_terakhir_bayar,
            batas_pembayaran,
            jumlah_bulan,
            id_spp,
            nominal_bayar,
            jumlah_bayar,
            kembalian
        )
        VALUES
        (
            '$id_pembayaran',
            '$status',
            '$nisn',
            '$tgl_bayar',
            '$tgl_terakhir_bayar',
            '$batas_pembayaran',
            '$jumlah_bulan',
            '$id_spp',
            '$nominal',
            '$jumlah_bayar',
            '$kembalian'
        )"
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

    <title>Tambah Pembayaran</title>

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

            <h3>Tambah Pembayaran</h3>

            <br>

            <form method="POST">

                <div class="mb-3">

                    <label>ID Pembayaran</label>

                    <input
                        type="text"
                        name="id_pembayaran"
                        class="form-control"
                        placeholder="Contoh: BYR0000005"
                        required
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

                        <option value="<?= $row['nisn']; ?>">

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
                        required
                    >

                </div>

                <div class="mb-3">

                    <label>Jumlah Bulan</label>

                    <input
                        type="number"
                        name="jumlah_bulan"
                        class="form-control"
                        value="1"
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

                        <option value="<?= $row['id_spp']; ?>">

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

                        <option value="Sudah Lunas">
                            Sudah Lunas
                        </option>

                        <option value="Belum Lunas">
                            Belum Lunas
                        </option>

                    </select>

                </div>

                <button
                    type="submit"
                    name="simpan"
                    class="btn btn-primary"
                >
                    Simpan
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