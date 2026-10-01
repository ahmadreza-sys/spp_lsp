<?php

include "../config/koneksi.php";

$menu_aktif = "siswa";
$base = "../";


if (isset($_POST['simpan'])) {

    $nisn = $_POST['nisn'];
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $id_kelas = $_POST['id_kelas'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $id_spp = $_POST['id_spp'];


    $kelas = mysqli_query(
        $koneksi,
        "SELECT * FROM tb_kelas WHERE id_kelas='$id_kelas'"
    );

    $data_kelas = mysqli_fetch_assoc($kelas);

    $nama_kelas = $data_kelas['nama_kelas'];


    mysqli_query(
        $koneksi,
        "INSERT INTO tb_siswa
        (nisn, nis, nama, id_kelas, nama_kelas, alamat, no_telp, id_spp)
        VALUES
        ('$nisn', '$nis', '$nama', '$id_kelas', '$nama_kelas', '$alamat', '$no_telp', '$id_spp')"
    );


    header("Location: siswa.php");

}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Tambah Data Siswa</title>

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

            <h3>Tambah Data Siswa</h3>

            <br>


            <form method="POST">


                <div class="mb-3">

                    <label>NISN</label>

                    <input
                        type="text"
                        name="nisn"
                        class="form-control"
                        required
                    >

                </div>


                <div class="mb-3">

                    <label>NIS</label>

                    <input
                        type="text"
                        name="nis"
                        class="form-control"
                        required
                    >

                </div>


                <div class="mb-3">

                    <label>Nama Siswa</label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        required
                    >

                </div>


                <div class="mb-3">

                    <label>Kelas</label>

                    <select
                        name="id_kelas"
                        class="form-control"
                        required
                    >

                        <option value="">
                            Pilih Kelas
                        </option>


                        <?php

                        $kelas = mysqli_query(
                            $koneksi,
                            "SELECT * FROM tb_kelas"
                        );

                        while ($row = mysqli_fetch_assoc($kelas)) {

                        ?>

                            <option
                                value="<?= $row['id_kelas']; ?>"
                            >

                                <?= $row['nama_kelas']; ?>

                            </option>

                        <?php } ?>

                    </select>

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
                            "SELECT * FROM tb_spp"
                        );

                        while ($row = mysqli_fetch_assoc($spp)) {

                        ?>

                            <option
                                value="<?= $row['id_spp']; ?>"
                            >

                                <?= $row['id_spp']; ?>
                                -
                                Rp <?= number_format($row['nominal'], 0, ',', '.'); ?>

                            </option>

                        <?php } ?>

                    </select>

                </div>


                <div class="mb-3">

                    <label>No Telepon</label>

                    <input
                        type="text"
                        name="no_telp"
                        class="form-control"
                        required
                    >

                </div>


                <div class="mb-3">

                    <label>Alamat</label>

                    <input
                        type="text"
                        name="alamat"
                        class="form-control"
                        required
                    >

                </div>


                <button
                    type="submit"
                    name="simpan"
                    class="btn btn-primary"
                >
                    Simpan
                </button>


                <a
                    href="siswa.php"
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