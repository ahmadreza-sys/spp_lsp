<?php

include "../config/koneksi.php";

$menu_aktif = "kelas";
$base = "../";


if (isset($_GET['hapus'])) {

    $id_kelas = $_GET['hapus'];

    mysqli_query(
        $koneksi,
        "DELETE FROM tb_kelas WHERE id_kelas='$id_kelas'"
    );

    header("Location: kelas.php");

}


if (isset($_GET['cari'])) {

    $cari = $_GET['cari'];

    $data = mysqli_query(
        $koneksi,
        "SELECT * FROM tb_kelas
        WHERE id_kelas LIKE '%$cari%'
        OR nama_kelas LIKE '%$cari%'
        OR kompetensi_keahlian LIKE '%$cari%'
        ORDER BY id_kelas ASC"
    );

} else {

    $data = mysqli_query(
        $koneksi,
        "SELECT * FROM tb_kelas
        ORDER BY id_kelas ASC"
    );

}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Data Kelas</title>

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

            <h3>Data Kelas</h3>

            <a
                href="kelas_tambah.php"
                class="btn btn-primary"
            >
                Tambah
            </a>

            <br><br>


            <form method="GET">

                <input
                    type="text"
                    name="cari"
                    placeholder="Cari kelas"
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

                    <th>ID Kelas</th>

                    <th>Nama Kelas</th>

                    <th>Kompetensi Keahlian</th>

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
                        <?= $row['id_kelas']; ?>
                    </td>

                    <td>
                        <?= $row['nama_kelas']; ?>
                    </td>

                    <td>
                        <?= $row['kompetensi_keahlian']; ?>
                    </td>

                    <td>

                        <a
                            href="kelas_edit.php?id=<?= $row['id_kelas']; ?>"
                            class="btn btn-warning btn-sm"
                        >
                            Edit
                        </a>

                        <a
                            href="kelas.php?hapus=<?= $row['id_kelas']; ?>"
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