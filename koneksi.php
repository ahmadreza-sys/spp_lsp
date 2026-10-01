sambungkan koneksi

<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "spp_lsp";
$port = 8111;

$koneksi = mysqli_connect($host, $user, $pass, $db, $port);

if (!$koneksi) {
    die("❌ Koneksi database gagal: " . mysqli_connect_error());
}

echo "✅ Koneksi database berhasil!";

?>

