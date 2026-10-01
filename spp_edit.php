<?php

include "../config/koneksi.php";

$menu_aktif = "spp";
$base = "../";


$id = $_GET['id'];


// Ambil data SPP

$data = mysqli_query(
    $koneksi,
    "SELECT * FROM tb_spp WHERE id_spp='$id'"
);

$spp = mysqli_fetch_assoc($data);


// Jika tombol update ditekan

if (isset($_POST['update'])) {

    $tahun = $_POST['tahun'];
    $nominal = $_POST['nominal'];


    mysqli_query(
        $koneksi,
        "UPDATE tb_spp SET
        tahun='$tahun',
        nominal='$nominal'
        WHERE id_spp='$id'"
    );


    header("Location: spp.php");

}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Data SPP</title>

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

            <h3>Edit Data SPP</h3>

            <br>


            <form method="POST">


                <div class="mb-3">

                    <label>ID SPP</label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= $spp['id_spp']; ?>"
                        readonly
                    >

                </div>


                <div class="mb-3">

                    <label>Tahun</label>

                    <input
                        type="number"
                        name="tahun"
                        class="form-control"
                        value="<?= $spp['tahun']; ?>"
                        required
                    >

                </div>


                <div class="mb-3">

                    <label>Nominal</label>

                    <input
                        type="number"
                        name="nominal"
                        class="form-control"
                        value="<?= $spp['nominal']; ?>"
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