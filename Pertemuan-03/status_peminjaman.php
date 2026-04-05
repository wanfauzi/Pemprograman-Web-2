<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Status Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-4">
<?php 
// Data Anggota (sesuai instruksi)
$nama_anggota       = "Budi Santoso";
$total_pinjaman     = 2;
$buku_terlambat     = 3;
$hari_keterlambatan = 5;

// Konstanta
$denda_per_hari = 1000;
$maks_denda     = 50000;
$maks_pinjam    = 3;

// Hitung Denda
$total_denda = $buku_terlambat * $hari_keterlambatan * $denda_per_hari;
if ($total_denda > $maks_denda) {
    $total_denda = $maks_denda;
}

// Status Peminjaman
if ($buku_terlambat > 0) {
    $status = "Tidak bisa meminjam buku. Ada keterlambatan. "
            . "Denda: Rp " . number_format($total_denda, 0, ',', '.');
    $alert  = "alert-danger";
} elseif ($total_pinjaman >= $maks_pinjam) {
    $status = "Tidak bisa meminjam. Sudah mencapai batas maksimal 3 buku.";
    $alert  = "alert-warning";
} else {
    $status = "Silakan lakukan peminjaman (maks. 3 buku).";
    $alert  = "alert-success";
}

// Level Member
switch (true) {
    case ($total_pinjaman >= 0 && $total_pinjaman <= 5):
        $member = "Bronze"; 
        break;
    case ($total_pinjaman >= 6 && $total_pinjaman <= 15):
        $member = "Silver"; 
        break;
    case ($total_pinjaman > 15):
        $member = "Gold"; 
        break;
    default:
        $member = "Tidak Diketahui"; break;
}
?>

    <div class="container" style="max-width: 480px">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Status Peminjaman</h5>
                <h6 class="text-muted">Informasi Anggota</h6>
                <p class="mb-1">Nama           : <?= $nama_anggota ?></p>
                <p class="mb-1">Total Pinjaman : <?= $total_pinjaman ?> buku</p>
                <p class="mb-1">Level Member   : <?= $member ?></p>
                <p class="mb-1">Buku Terlambat : <?= $buku_terlambat ?> buku</p>
                <p class="mb-3">Hari Terlambat : <?= $hari_keterlambatan ?> hari</p>

                <h6 class="text-muted">Status</h6>
                <div class="alert <?= $alert ?> mb-0"><?= $status ?></div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>