<?php

include "../config/koneksi.php";

$menu_aktif = "petugas";
$base = "../";

if (isset($_POST['simpan'])) {

    $id_petugas = $_POST['id_petugas'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama_petugas = $_POST['nama_petugas'];
    $level = $_POST['level'];

    mysqli_query(
        $koneksi,
        "INSERT INTO tb_petugas
        (
            id_petugas,
            username,
            password,
            nama_petugas,
            level
        )
        VALUES
        (
            '$id_petugas',
            '$username',
            '$password',
            '$nama_petugas',
            '$level'
        )"
    );

    header("Location: petugas.php");

}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Tambah Data Petugas</title>

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

            <h3>Tambah Data Petugas</h3>

            <br>

            <form method="POST">

                <div class="mb-3">

                    <label>ID Petugas</label>

                    <input
                        type="text"
                        name="id_petugas"
                        class="form-control"
                        placeholder="Contoh: PTG001"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label>Username</label>

                    <input
                        type="text"
                        name="username"
                        class="form-control"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label>Password</label>

                    <input
                        type="text"
                        name="password"
                        class="form-control"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label>Nama Petugas</label>

                    <input
                        type="text"
                        name="nama_petugas"
                        class="form-control"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label>Level</label>

                    <select
                        name="level"
                        class="form-control"
                        required
                    >

                        <option value="">
                            Pilih Level
                        </option>

                        <option value="Admin">
                            Admin
                        </option>

                        <option value="Petugas">
                            Petugas
                        </option>

                    </select>

                </div>

                <button
                    type="submit"
                    name="simpan"
                    class="btn btn-primary"
                >
                    Simpan
                </button>

                <a
                    href="petugas.php"
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