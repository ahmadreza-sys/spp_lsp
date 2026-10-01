<?php

include "../config/koneksi.php";

$menu_aktif = "kelas";
$base = "../";


$id = $_GET['id'];


// Ambil data kelas

$data = mysqli_query(
    $koneksi,
    "SELECT * FROM tb_kelas WHERE id_kelas='$id'"
);

$kelas = mysqli_fetch_assoc($data);


// Jika tombol update ditekan

if (isset($_POST['update'])) {

    $nama_kelas = $_POST['nama_kelas'];
    $kompetensi = $_POST['kompetensi_keahlian'];


    mysqli_query(
        $koneksi,
        "UPDATE tb_kelas SET
        nama_kelas='$nama_kelas',
        kompetensi_keahlian='$kompetensi'
        WHERE id_kelas='$id'"
    );


    header("Location: kelas.php");

}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Data Kelas</title>

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

            <h3>Edit Data Kelas</h3>

            <br>


            <form method="POST">


                <div class="mb-3">

                    <label>ID Kelas</label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= $kelas['id_kelas']; ?>"
                        readonly
                    >

                </div>


                <div class="mb-3">

                    <label>Nama Kelas</label>

                    <input
                        type="text"
                        name="nama_kelas"
                        class="form-control"
                        value="<?= $kelas['nama_kelas']; ?>"
                        required
                    >

                </div>


                <div class="mb-3">

                    <label>Kompetensi Keahlian</label>

                    <input
                        type="text"
                        name="kompetensi_keahlian"
                        class="form-control"
                        value="<?= $kelas['kompetensi_keahlian']; ?>"
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
                    href="kelas.php"
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