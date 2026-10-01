<?php

include "../config/koneksi.php";

$menu_aktif = "spp";
$base = "../";


if (isset($_POST['simpan'])) {

    $id_spp = $_POST['id_spp'];
    $tahun = $_POST['tahun'];
    $nominal = $_POST['nominal'];


    mysqli_query(
        $koneksi,
        "INSERT INTO tb_spp
        (id_spp, tahun, nominal)
        VALUES
        ('$id_spp', '$tahun', '$nominal')"
    );


    header("Location: spp.php");

}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Tambah Data SPP</title>

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

            <h3>Tambah Data SPP</h3>

            <br>


            <form method="POST">


                <div class="mb-3">

                    <label>ID SPP</label>

                    <input
                        type="text"
                        name="id_spp"
                        class="form-control"
                        placeholder="Contoh: SPP006"
                        required
                    >

                </div>


                <div class="mb-3">

                    <label>Tahun</label>

                    <input
                        type="number"
                        name="tahun"
                        class="form-control"
                        placeholder="Contoh: 2026"
                        required
                    >

                </div>


                <div class="mb-3">

                    <label>Nominal</label>

                    <input
                        type="number"
                        name="nominal"
                        class="form-control"
                        placeholder="Contoh: 150000"
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
                    href="spp.php"
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