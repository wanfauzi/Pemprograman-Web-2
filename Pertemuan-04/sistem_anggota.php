<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Anggota Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <?php
    // Include functions
    require_once 'functions_anggota.php';
    // Data anggota minimal 5
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
    
    <div class="container mt-5">
        <h1 class="mb-4"><i class="bi bi-people"></i> Sistem Anggota Perpustakaan</h1>
        
        <!-- Dashboard Statistik -->
        <div class="row mb-4">
            
            <!-- TODO: Cards statistik -->
             <!-- Total Anggota -->
            <div class="col-md-4">
                <div class="card text-bg-primary">
                    <div class="card-body">
                        <h5>Total Anggota</h5>
                        <h3><?php echo hitung_total_anggota($anggota_list); ?></h3>
                    </div>
                </div>
            </div>
            <!-- Anggota Aktif- -->
            <div class="col-md-4">
                <div class="card text-bg-success">
                    <div class="card-body">
                        <h5>Anggota Aktif</h5>
                        <h3><?php echo hitung_anggota_aktif($anggota_list); ?></h3>
                    </div>
                </div>
            </div>
            <!-- Rata pinjaman -->
            <div class="col-md-4">
                <div class="card text-bg-warning">
                    <div class="card-body">
                        <h5>Rata-rata Pinjaman</h5>
                        <h3><?php echo hitung_rata_rata_pinjaman($anggota_list); ?></h3>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tabel Anggota -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Daftar Anggota</h5>
            </div>
            <div class="card-body">
                <!-- TODO: Tabel anggota -->
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Total Pinjam</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Tanggal Daftar</th>
                    </tr>

                    <?php foreach($anggota_list as $anggota): ?>
                    <tr>
                        <td><?php echo $anggota["id"]; ?></td>
                        <td><?php echo $anggota["nama"];?></td>
                        <td><?php echo $anggota["email"];?></td>
                        <td><?php echo $anggota["status"];?></td>
                        <td><?php echo $anggota["total_pinjam"];?></td>
                        <td><?php echo $anggota["telepon"]; ?></td>
                        <td><?php echo $anggota["alamat"]; ?></td>
                        <td><?php echo $anggota["tanggal_daftar"];?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
        
        <!-- Anggota Teraktif -->
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Anggota Teraktif</h5>
            </div>
            <div class="card-body">
                <!-- TODO: Info anggota teraktif -->
                <?php 
                $teraktif = cari_anggota_teraktif($anggota_list); 
                ?>

                <?php if ($teraktif): ?>
                    <h5 class="card-title"><?php echo $teraktif["nama"]; ?></h5>
                    <p class="card-text">
                        ID: <?php echo $teraktif["id"]; ?><br>
                        Email: <?php echo$teraktif["email"]; ?><br>
                        Total Pinjam: <strong><?php echo $teraktif["total_pinjam"]; ?></strong>
                    </p>
                <?php else: ?>
                    <p>Tidak ada data</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Anggota aktif dan Tidak -->
        <div class="card mt-4">
    <div class="card-header">
        <h5>Daftar Berdasarkan Status</h5>
    </div>
    <div class="card-body">
        <div class="row">

            <!-- ANGOTA AKTIF -->
            <div class="col-md-6">
                <h6 class="text-success">Anggota Aktif</h6>
                <ul class="list-group">
                    <?php foreach(filter_by_status($anggota_list, "Aktif") as $anggota): ?>
                        <li class="list-group-item">
                            <?= $anggota["nama"]; ?>
                            <span class="badge bg-success">Aktif</span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- ANGGOTA NON-AKTIF -->
            <div class="col-md-6">
                <h6 class="text-danger">Anggota Non-Aktif</h6>
                <ul class="list-group">
                    <?php foreach(filter_by_status($anggota_list, "Non-Aktif") as $anggota): ?>
                        <li class="list-group-item">
                            <?= $anggota["nama"]; ?>
                            <span class="badge bg-secondary">Non-Aktif</span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>
    </div>
</div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>