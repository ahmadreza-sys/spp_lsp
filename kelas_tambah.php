<?php

include "../config/koneksi.php";

$menu_aktif = "kelas";
$base = "../";


if (isset($_POST['simpan'])) {

    $id_kelas = $_POST['id_kelas'];
    $nama_kelas = $_POST['nama_kelas'];
    $kompetensi = $_POST['kompetensi_keahlian'];


    mysqli_query(
        $koneksi,
        "INSERT INTO tb_kelas
        (id_kelas, nama_kelas, kompetensi_keahlian)
        VALUES
        ('$id_kelas', '$nama_kelas', '$kompetensi')"
    );


    header("Location: kelas.php");

}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Tambah Data Kelas</title>

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

            <h3>Tambah Data Kelas</h3>

            <br>


            <form method="POST">


                <div class="mb-3">

                    <label>ID Kelas</label>

                    <input
                        type="text"
                        name="id_kelas"
                        class="form-control"
                        placeholder="Contoh: KLS006"
                        required
                    >

                </div>


                <div class="mb-3">

                    <label>Nama Kelas</label>

                    <input
                        type="text"
                        name="nama_kelas"
                        class="form-control"
                        placeholder="Contoh: X RPL 3"
                        required
                    >

                </div>


                <div class="mb-3">

                    <label>Kompetensi Keahlian</label>

                    <input
                        type="text"
                        name="kompetensi_keahlian"
                        class="form-control"
                        placeholder="Contoh: Rekayasa Perangkat Lunak"
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