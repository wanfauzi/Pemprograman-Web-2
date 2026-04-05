<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h4 class="mb-4">Daftar Transaksi Peminjaman</h4>

    <?php
    // LOOP 1: Hitung Statistik
    $total_transaksi  = 0;
    $total_dipinjam   = 0;
    $total_dikembalikan = 0;

    for ($i = 1; $i <= 10; $i++) {
        if ($i % 2 == 0) // $i = 2,4,6,8,10 maka dilewati, lanjut iterasi berikutnya
            continue; // skip genap
        if ($i > 8)    // $i = 9,10 maka loop berhenti total
            break;    // stop di transaksi ke-8

        $status = ($i % 3 == 0) ? "Dikembalikan" : "Dipinjam";

        $total_transaksi++;
        if ($status == "Dipinjam")      
            $total_dipinjam++;
        if ($status == "Dikembalikan")  
            $total_dikembalikan++;
    }
    ?>

    <!-- Tampilan Statistik dalam cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="text-muted">Total Ditampilkan</h6>
                    <h3><?= $total_transaksi ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center border-primary">
                <div class="card-body">
                    <h6 class="text-muted">Dipinjam</h6>
                    <h3 class="text-primary"><?= $total_dipinjam ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center border-success">
                <div class="card-body">
                    <h6 class="text-muted">Dikembalikan</h6>
                    <h3 class="text-success"><?= $total_dikembalikan ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Tampilan Tabel Transaksi -->
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Peminjam</th>
                <th>Buku</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Hari</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // LOOP 2: Tampilkan Data Transaksi
            $no = 1;
            for ($i = 1; $i <= 10; $i++) {

                if ($i % 2 == 0) 
                    continue; // skip transaksi genap
                if ($i > 8)      
                    break;    // stop di transaksi ke-8

                $id_transaksi   = "TRX-" . str_pad($i, 4, "0", STR_PAD_LEFT); /* $i = 1  →  TRX-0001,$i = 7  →  TRX-0007*/
                $nama_peminjam  = "Anggota " . $i;
                $judul_buku     = "Buku Teknologi Vol. " . $i;
                $tanggal_pinjam = date('Y-m-d', strtotime("-$i days")); //  Hari ini dikurangi $i hari  →  tanggal pinjam di masa lalu
                $tanggal_kembali= date('Y-m-d', strtotime("+7 days", strtotime($tanggal_pinjam))); //  Dari tanggal_pinjam, ditambah 7 hari  →  batas pengembalian
                $status         = ($i % 3 == 0) ? "Dikembalikan" : "Dipinjam"; //  Jika $i habis dibagi 3 → "Dikembalikan", selainnya → "Dipinjam"
                $hari_pinjam    = $i; // sama dengan jumlah hari yang lalu

                $badge = ($status == "Dipinjam") ? "bg-primary" : "bg-success"; //  Kondisi ? nilai_jika_true : nilai_jika_false
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $id_transaksi ?></td>
                <td><?= $nama_peminjam ?></td>
                <td><?= $judul_buku ?></td>
                <td><?= $tanggal_pinjam ?></td>
                <td><?= $tanggal_kembali ?></td>
                <td><?= $hari_pinjam ?> hari</td>
                <td><span class="badge <?= $badge ?>"><?= $status ?></span></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>