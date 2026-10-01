<?php

include "../config/koneksi.php";

$menu_aktif = "petugas";
$base = "../";

if (isset($_GET['hapus'])) {

    $id = $_GET['hapus'];

    mysqli_query(
        $koneksi,
        "DELETE FROM tb_petugas WHERE id_petugas='$id'"
    );

    header("Location: petugas.php");
}

if (isset($_GET['cari'])) {

    $cari = $_GET['cari'];

    $data = mysqli_query(
        $koneksi,
        "SELECT * FROM tb_petugas
        WHERE id_petugas LIKE '%$cari%'
        OR username LIKE '%$cari%'
        OR nama_petugas LIKE '%$cari%'
        OR level LIKE '%$cari%'
        ORDER BY id_petugas ASC"
    );

} else {

    $data = mysqli_query(
        $koneksi,
        "SELECT * FROM tb_petugas
        ORDER BY id_petugas ASC"
    );
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Data Petugas</title>

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

            <h3>Data Petugas</h3>

            <a
                href="petugas_tambah.php"
                class="btn btn-primary"
            >
                Tambah
            </a>

            <br><br>

            <form method="GET">

                <input
                    type="text"
                    name="cari"
                    placeholder="Cari petugas"
                >

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Cari
                </button>

            </form>

            <br>

            <table class="table table-bordered">

                <tr>

                    <th>No</th>

                    <th>ID Petugas</th>

                    <th>Username</th>

                    <th>Password</th>

                    <th>Nama Petugas</th>

                    <th>Level</th>

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
                        <?= $row['id_petugas']; ?>
                    </td>

                    <td>
                        <?= $row['username']; ?>
                    </td>

                    <td>
                        <?= $row['password']; ?>
                    </td>

                    <td>
                        <?= $row['nama_petugas']; ?>
                    </td>

                    <td>
                        <?= $row['level']; ?>
                    </td>

                    <td>

                        <a
                            href="petugas_edit.php?id=<?= $row['id_petugas']; ?>"
                            class="btn btn-warning btn-sm"
                        >
                            Edit
                        </a>

                        <a
                            href="petugas.php?hapus=<?= $row['id_petugas']; ?>"
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