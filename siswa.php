<?php

include "../config/koneksi.php";

$menu_aktif = "siswa";
$base = "../";

if (isset($_GET['hapus'])) {

    $nisn = $_GET['hapus'];

    mysqli_query($koneksi, "DELETE FROM tb_siswa WHERE nisn='$nisn'");

    header("Location: siswa.php");
}

if (isset($_GET['cari'])) {

    $cari = $_GET['cari'];

    $data = mysqli_query(
        $koneksi,
        "SELECT * FROM tb_siswa
        WHERE nisn LIKE '%$cari%'
        OR nis LIKE '%$cari%'
        OR nama LIKE '%$cari%'
        ORDER BY nama ASC"
    );

} else {

    $data = mysqli_query(
        $koneksi,
        "SELECT * FROM tb_siswa ORDER BY nama ASC"
    );

}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Data Siswa</title>

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

            <h3>Data Siswa</h3>

            <a
                href="siswa_tambah.php"
                class="btn btn-primary"
            >
                Tambah
            </a>

            <br><br>

            <form method="GET">

                <input
                    type="text"
                    name="cari"
                    placeholder="Cari nama atau NISN"
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
                    <th>NISN</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>No Telepon</th>
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
                        <?= $row['nisn']; ?>
                    </td>

                    <td>
                        <?= $row['nis']; ?>
                    </td>

                    <td>
                        <?= $row['nama']; ?>
                    </td>

                    <td>
                        <?= $row['nama_kelas']; ?>
                    </td>

                    <td>
                        <?= $row['no_telp']; ?>
                    </td>

                    <td>

                        <a
                            href="siswa_edit.php?nisn=<?= $row['nisn']; ?>"
                            class="btn btn-warning btn-sm"
                        >
                            Edit
                        </a>

                        <a
                            href="siswa.php?hapus=<?= $row['nisn']; ?>"
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