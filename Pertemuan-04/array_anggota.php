<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4"><i class="bi bi-person"></i> Array Data Anggota Perpustakaan</h1>
    
    <?php 
    // 1. Array List Data Anggota
    $anggota_list = [
        [
            "id" => "AGT-001",
            "nama" => "Budi Santoso",
            "email" => "budi@email.com",
            "telepon" => "081234567890",
            "alamat" => "Jakarta",
            "tanggal_daftar" => "2024-01-15",
            "status" => "Aktif",
            "total_pinjam" => 5
        ],
        [
            "id" => "AGT-002",
            "nama" => "Aruni Wijaya",
            "email" => "aruni@email.com",
            "telepon" => "039830282802",
            "alamat" => "Surabaya",
            "tanggal_daftar" => "2023-10-02",
            "status" => "Aktif",
            "total_pinjam" => 4
        ],
        [
            "id" => "AGT-003",
            "nama" => "Ani Jayanti",
            "email" => "ani@email.com",
            "telepon" => "0892090942020",
            "alamat" => "Ambon",
            "tanggal_daftar" => "2023-05-12",
            "status" => "Non-Aktif",
            "total_pinjam" => 0
        ],
        [
            "id" => "AGT-004",
            "nama" => "Umay Stefano",
            "email" => "umay@email.com",
            "telepon" => "082121313313",
            "alamat" => "Jakarta",
            "tanggal_daftar" => "2023-02-15",
            "status" => "Aktif",
            "total_pinjam" => 4
        ],
        [
            "id" => "AGT-005",
            "nama" => "Andi Prayoga",
            "email" => "andi@email.com",
            "telepon" => "083131231311",
            "alamat" => "Pekalongan",
            "tanggal_daftar" => "2024-01-02",
            "status" => "Non-Aktif",
            "total_pinjam" => 3
        ],
    ];
    ?>

    <!-- Menampilkan semua anggota dalam tabel -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-1">Anggota Perpustakaan</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th>Total Pinjam</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no =1; ?>
                        <?php foreach ($anggota_list as $anggota): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><code><?php echo $anggota["id"]; ?></code></td>
                            <td><?php echo $anggota["nama"];?></td>
                            <td><?php echo $anggota["email"];?></td>
                            <td><?php echo $anggota["telepon"]?></td>
                            <td><?php echo $anggota["alamat"]?></td>
                            <td><?php echo $anggota["tanggal_daftar"];?></td>
                            <td><?php echo $anggota["status"];?></td>
                            <td><?php echo $anggota["total_pinjam"]?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <?php
    // STATISTIK DARI ARRAY DATA ANGGOTA

    // Total anggota
    $total_anggota = count($anggota_list);

    $aktif = 0;
    $nonaktif = 0;
    $total_pinjam = 0;
    $terbanyak = $anggota_list[0];
    $anggota_aktif = [];

    // Persentase statistik status aktif nonaktif
    

    foreach ($anggota_list as $anggota) {

        // Hitung jumlah status maupun nonaktif 
        if ($anggota["status"] == "Aktif") {
            $aktif++;
            $anggota_aktif[] = $anggota["nama"]; // sekalian filter
        } else {
            $nonaktif++;
        }
                            
        // Cari total pinjam
        $total_pinjam += $anggota["total_pinjam"];
        
        // Cari terbanyak
        if ($anggota["total_pinjam"] > $terbanyak["total_pinjam"]) {
            $terbanyak = $anggota;
        }
    }
    
    // Persentase anggota aktif/nonaktif
    $persen_aktif = ($aktif / $total_anggota) * 100;
    $persen_nonaktif = ($nonaktif / $total_anggota) * 100;

    // Persentase rata2 peminjaman
    $rata_pinjam = ($total_anggota > 0) 
        ? $total_pinjam / $total_anggota : 0;
    ?>

    <!-- Tampilkan dengan card dan modifikasi versi saya dengan row -->
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-info text-white p-3">
                <!-- Total anggota -->
                <h6>Total Anggota</h6>
                <h3><?php echo $total_anggota; ?></h3>
            </div>
        </div>
        <!-- Aktif -->
        <div class="col-md-3">
            <div class="card bg-success text-white p-3">
                <h6>Aktif</h6>
                <h3><?php echo $aktif; ?></h3>
                <h3><?php echo $persen_aktif; ?> %</h3>
            </div>
        </div>
        <!-- Nonaktif -->
        <div class="col-md-3">
            <div class="card bg-danger text-white p-3">
                <h6>Non-Aktif</h6>
                <h3><?php echo $nonaktif; ?></h3>
                <h3><?php echo $persen_nonaktif; ?> %</h3>
            </div>
        </div>      
        <!-- Terbanyak Pinjam -->
        <div class="col-md-3">
            <div class="card bg-warning p-3">
                <h6>Terbanyak Pinjam</h6>
                <strong><?php echo $terbanyak["nama"] . " dengan peminjaman sebanyak " . $terbanyak["total_pinjam"] . " buku";
                ?></strong><br>
            </div>
        </div>
    </div>


    <div class="row mt-3">
    <!-- Rata-rata Peminjaman -->
    <div class="col-md-6">
        <div class="card bg-secondary text-white p-3 text-center">
            <h6>Rata-Rata Peminjaman</h6>
            <h3><?= number_format($rata_pinjam, 1); ?></h3>
            <small>buku per anggota</small>
        </div>
    </div>

    <!-- Anggota Aktif -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-info text-white">
                Anggota Aktif
            </div>
            <div class="card-body">
                <ul class="mb-0">
                    <?php foreach ($anggota_aktif as $nama): ?>
                        <li><?= $nama; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

</div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</body>
</html>