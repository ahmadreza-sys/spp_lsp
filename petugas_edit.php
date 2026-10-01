<?php

include "../config/koneksi.php";

$menu_aktif = "petugas";
$base = "../";

$id = $_GET['id'];

$data = mysqli_query(
    $koneksi,
    "SELECT * FROM tb_petugas
    WHERE id_petugas='$id'"
);

$petugas = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama_petugas = $_POST['nama_petugas'];
    $level = $_POST['level'];

    mysqli_query(
        $koneksi,
        "UPDATE tb_petugas SET
        username='$username',
        password='$password',
        nama_petugas='$nama_petugas',
        level='$level'
        WHERE id_petugas='$id'"
    );

    header("Location: petugas.php");

}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Data Petugas</title>

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

            <h3>Edit Data Petugas</h3>

            <br>

            <form method="POST">

                <div class="mb-3">

                    <label>ID Petugas</label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= $petugas['id_petugas']; ?>"
                        readonly
                    >

                </div>

                <div class="mb-3">

                    <label>Username</label>

                    <input
                        type="text"
                        name="username"
                        class="form-control"
                        value="<?= $petugas['username']; ?>"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label>Password</label>

                    <input
                        type="text"
                        name="password"
                        class="form-control"
                        value="<?= $petugas['password']; ?>"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label>Nama Petugas</label>

                    <input
                        type="text"
                        name="nama_petugas"
                        class="form-control"
                        value="<?= $petugas['nama_petugas']; ?>"
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

                        <option
                            value="Admin"
                            <?php
                            if ($petugas['level'] == 'Admin')
                                echo 'selected';
                            ?>
                        >
                            Admin
                        </option>

                        <option
                            value="Petugas"
                            <?php
                            if ($petugas['level'] == 'Petugas')
                                echo 'selected';
                            ?>
                        >
                            Petugas
                        </option>

                    </select>

                </div>

                <button
                    type="submit"
                    name="update"
                    class="btn btn-primary"
                >
                    Update
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