<?php

include "../config/koneksi.php";

$menu_aktif = "siswa";
$base = "../";


$nisn = $_GET['nisn'];


// Ambil data siswa

$data = mysqli_query(
    $koneksi,
    "SELECT * FROM tb_siswa WHERE nisn='$nisn'"
);

$siswa = mysqli_fetch_assoc($data);


// Jika tombol update ditekan

if (isset($_POST['update'])) {

    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $id_kelas = $_POST['id_kelas'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $id_spp = $_POST['id_spp'];


    // Ambil nama kelas

    $kelas = mysqli_query(
        $koneksi,
        "SELECT * FROM tb_kelas WHERE id_kelas='$id_kelas'"
    );

    $data_kelas = mysqli_fetch_assoc($kelas);

    $nama_kelas = $data_kelas['nama_kelas'];


    // Update data

    mysqli_query(
        $koneksi,
        "UPDATE tb_siswa SET
        nis='$nis',
        nama='$nama',
        id_kelas='$id_kelas',
        nama_kelas='$nama_kelas',
        alamat='$alamat',
        no_telp='$no_telp',
        id_spp='$id_spp'
        WHERE nisn='$nisn'"
    );


    header("Location: siswa.php");

}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Data Siswa</title>

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

            <h3>Edit Data Siswa</h3>

            <br>


            <form method="POST">


                <div class="mb-3">

                    <label>NISN</label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= $siswa['nisn']; ?>"
                        readonly
                    >

                </div>


                <div class="mb-3">

                    <label>NIS</label>

                    <input
                        type="text"
                        name="nis"
                        class="form-control"
                        value="<?= $siswa['nis']; ?>"
                        required
                    >

                </div>


                <div class="mb-3">

                    <label>Nama Siswa</label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        value="<?= $siswa['nama']; ?>"
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

                                <?php

                                if ($row['id_kelas'] == $siswa['id_kelas']) {
                                    echo "selected";
                                }

                                ?>
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

                                <?php

                                if ($row['id_spp'] == $siswa['id_spp']) {
                                    echo "selected";
                                }

                                ?>
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
                        value="<?= $siswa['no_telp']; ?>"
                        required
                    >

                </div>


                <div class="mb-3">

                    <label>Alamat</label>

                    <input
                        type="text"
                        name="alamat"
                        class="form-control"
                        value="<?= $siswa['alamat']; ?>"
                        required
                    >

                </div>


                <button
                    type="submit"
                    name="update"
                    class="btn btn-primary"
                >
                    Update
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