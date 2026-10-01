<?php

include "../config/koneksi.php";

$menu_aktif = "laporan";
$base = "../";

$data = mysqli_query(
    $koneksi,
    "SELECT
        tb_pembayaran.id_pembayaran,
        tb_pembayaran.nisn,
        tb_siswa.nama,
        tb_siswa.nama_kelas,
        tb_pembayaran.tgl_bayar,
        tb_pembayaran.jumlah_bulan,
        tb_pembayaran.id_spp,
        tb_pembayaran.jumlah_bayar,
        tb_pembayaran.status
    FROM tb_pembayaran
    LEFT JOIN tb_siswa
    ON tb_pembayaran.nisn = tb_siswa.nisn
    ORDER BY tb_pembayaran.tgl_bayar ASC"
);

$total_transaksi = 0;
$total_pembayaran = 0;

?>

<!DOCTYPE html>
<html>

<head>

<title>Laporan Pembayaran</title>

<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">

</head>

<body>

<div class="container-fluid">

<div class="row">

<?php include "../config/sidebar.php"; ?>

<div class="col-md-10 p-4">

<h3>Laporan Pembayaran</h3>

<p>Rekap data pembayaran SPP</p>

<br>

<table class="table table-bordered">

<tr>

<th>No</th>
<th>ID Pembayaran</th>
<th>NISN</th>
<th>Nama</th>
<th>Kelas</th>
<th>Tanggal Bayar</th>
<th>Jumlah Bulan</th>
<th>SPP</th>
<th>Jumlah Bayar</th>
<th>Status</th>

</tr>

<?php

$no = 1;

while ($row = mysqli_fetch_assoc($data)) {

    $total_transaksi++;

    if ($row['status'] == "Sudah Lunas") {
        $total_pembayaran += $row['jumlah_bayar'];
    }

?>

<tr>

<td>
<?= $no++; ?>
</td>

<td>
<?= $row['id_pembayaran']; ?>
</td>

<td>
<?= $row['nisn']; ?>
</td>

<td>
<?= $row['nama']; ?>
</td>

<td>
<?= $row['nama_kelas']; ?>
</td>

<td>
<?= $row['tgl_bayar']; ?>
</td>

<td>
<?= $row['jumlah_bulan']; ?> Bulan
</td>

<td>
<?= $row['id_spp']; ?>
</td>

<td>
Rp <?= number_format($row['jumlah_bayar'], 0, ',', '.'); ?>
</td>

<td>

<?php if ($row['status'] == "Sudah Lunas") { ?>

<span class="badge bg-success">
Sudah Lunas
</span>

<?php } else { ?>

<span class="badge bg-danger">
Belum Lunas
</span>

<?php } ?>

</td>

</tr>

<?php } ?>

<?php if ($total_transaksi == 0) { ?>

<tr>

<td colspan="10" class="text-center">

Belum ada data pembayaran.

</td>

</tr>

<?php } ?>

</table>

<br>

<h5>
Total Transaksi : <?= $total_transaksi; ?>
</h5>

<h5>
Total Pembayaran :
Rp <?= number_format($total_pembayaran, 0, ',', '.'); ?>
</h5>

</div>

</div>

</div>

</body>

</html>