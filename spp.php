<?php

include "../config/koneksi.php";

$menu_aktif = "spp";
$base = "../";


if (isset($_GET['hapus'])) {

    $id_spp = $_GET['hapus'];

    mysqli_query(
        $koneksi,
        "DELETE FROM tb_spp WHERE id_spp='$id_spp'"
    );

    header("Location: spp.php");

}


if (isset($_GET['cari'])) {

    $cari = $_GET['cari'];

    $data = mysqli_query(
        $koneksi,
        "SELECT * FROM tb_spp
        WHERE id_spp LIKE '%$cari%'
        OR tahun LIKE '%$cari%'
        ORDER BY id_spp ASC"
    );

} else {

    $data = mysqli_query(
        $koneksi,
        "SELECT * FROM tb_spp
        ORDER BY id_spp ASC"
    );

}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Data SPP</title>

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

            <h3>Data SPP</h3>

            <a
                href="spp_tambah.php"
                class="btn btn-primary"
            >
                Tambah
            </a>

            <br><br>


            <form method="GET">

                <input
                    type="text"
                    name="cari"
                    placeholder="Cari ID SPP atau tahun"
                >

                <button type="submit">
                    Cari
                </button>

            </form>

            <br>


            <table
                border="1"
                cellpadding="8"
                class="table"
            >

                <tr>

                    <th>No</th>

                    <th>ID SPP</th>

                    <th>Tahun</th>

                    <th>Nominal</th>

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
                        <?= $row['id_spp']; ?>
                    </td>

                    <td>
                        <?= $row['tahun']; ?>
                    </td>

                    <td>
                        Rp <?= number_format(
                            $row['nominal'],
                            0,
                            ',',
                            '.'
                        ); ?>
                    </td>

                    <td>

                        <a
                            href="spp_edit.php?id=<?= $row['id_spp']; ?>"
                            class="btn btn-warning btn-sm"
                        >
                            Edit
                        </a>

                        <a
                            href="spp.php?hapus=<?= $row['id_spp']; ?>"
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