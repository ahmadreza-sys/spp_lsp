<?php

if (!isset($base)) {
    $base = "";
}

if (!isset($menu_aktif)) {
    $menu_aktif = "";
}

?>

<div class="col-md-2 bg-dark min-vh-100 p-3">

    <h4 class="text-white mb-4">
        SPP LSP
    </h4>

    <ul class="nav flex-column">

        <li class="nav-item mb-1">
            <a
                href="<?= $base ?>index.php"
                class="nav-link <?= ($menu_aktif == 'dashboard') ? 'active' : 'text-white'; ?>"
            >
                Dashboard
            </a>
        </li>

        <li class="nav-item mb-1">
            <a
                href="<?= $base ?>pages/siswa.php"
                class="nav-link <?= ($menu_aktif == 'siswa') ? 'active' : 'text-white'; ?>"
            >
                Data Siswa
            </a>
        </li>

        <li class="nav-item mb-1">
            <a
                href="<?= $base ?>pages/kelas.php"
                class="nav-link <?= ($menu_aktif == 'kelas') ? 'active' : 'text-white'; ?>"
            >
                Data Kelas
            </a>
        </li>

        <li class="nav-item mb-1">
            <a
                href="<?= $base ?>pages/spp.php"
                class="nav-link <?= ($menu_aktif == 'spp') ? 'active' : 'text-white'; ?>"
            >
                Data SPP
            </a>
        </li>

        <li class="nav-item mb-1">
            <a
                href="<?= $base ?>pages/pembayaran.php"
                class="nav-link <?= ($menu_aktif == 'pembayaran') ? 'active' : 'text-white'; ?>"
            >
                Pembayaran
            </a>
        </li>

        <li class="nav-item mb-1">
            <a
                href="<?= $base ?>pages/cek_pembayaran.php"
                class="nav-link <?= ($menu_aktif == 'cek_pembayaran') ? 'active' : 'text-white'; ?>"
            >
                Cek Pembayaran
            </a>
        </li>

        <li class="nav-item mb-1">
            <a
                href="<?= $base ?>pages/laporan.php"
                class="nav-link <?= ($menu_aktif == 'laporan') ? 'active' : 'text-white'; ?>"
            >
                Laporan
            </a>
        </li>

        <li class="nav-item mb-1">
            <a
                href="<?= $base ?>pages/petugas.php"
                class="nav-link <?= ($menu_aktif == 'petugas') ? 'active' : 'text-white'; ?>"
            >
                Data Petugas
            </a>
        </li>

    </ul>

</div>