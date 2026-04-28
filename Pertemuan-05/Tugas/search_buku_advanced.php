<!DOCTYPE html>
<html lang="id">                                                                                                                                                                                                                                                                            
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">                                                                                                          
    <title>Form Registrasi Anggota</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">                                                                                                                                                                                                    
</head>
<body>
    <?php
    // Data buku (minimal 10)
    $buku_list = [
        // TODO: Isi dengan 10+ data buku
        [
            "kode" => "BK-001",
            "judul" => "Dasar C++",
            "kategori" => "Programming",
            "pengarang" => "Ahmad Bahtiar",
            "penerbit" => "Elangga",
            "tahun" => 2018,
            "harga" => 65000,
            "stok" => 28
        ],
        [
            "kode" => "BK-002",
            "judul" => "Javascript for Beginner",
            "kategori" => "Programming",
            "pengarang" => "Arunia Wijaya",
            "penerbit" => "Darma Abadi",
            "tahun" => 2016,
            "harga" => 45000,
            "stok" => 11
        ],
        [
            "kode" => "BK-003",
            "judul" => "MySQL Basic",
            "kategori" => "Database",
            "pengarang" => "Yono Boyu",
            "penerbit" => "Gamadei Bersama",
            "tahun" => 2020,
            "harga" => 120000,
            "stok" => 10
        ],
        [
            "kode" => "BK-004",
            "judul" => "Atomic Habits",
            "kategori" => "Self Development",
            "pengarang" => "James Clear",
            "penerbit" => "Gramedia Pustaka",
            "tahun" => 2019,
            "harga" => 90000,
            "stok" => 45
        ],
        [
            "kode" => "BK-005",
            "judul" => "Filosofi Teras",
            "kategori" => "Self Development",
            "pengarang" => "Henry Manarimping",
            "penerbit" => "Gramedia Pustaka",
            "tahun" => 2018,
            "harga" => 75000,
            "stok" => 25
        ],
        [
            "kode" => "BK-006",
            "judul" => "Laskar Pelangi",
            "kategori" => "Novel",
            "pengarang" => "Andrea Hinata",
            "penerbit" => "Kompas",
            "tahun" => 2005,
            "harga" => 85000,
            "stok" => 50
        ],
        [
            "kode" => "BK-007",
            "judul" => "Bumi Manusia",
            "kategori" => "Sastra",
            "pengarang" => "Pramoedya Ananta Toer",
            "penerbit" => "Hastra Mitra",
            "tahun" => 1980,
            "harga" =>110000,
            "stok" => 40
        ],
        [
            "kode" => "BK-008",
            "judul" => "Sapiens",
            "kategori" => "Sejarah",
            "pengarang" => "Yuval Noah Harari",
            "penerbit" => "KPG",
            "tahun" => 2017,
            "harga" => 115000,
            "stok" => 20
        ],
        [
            "kode" => "BK-009",
            "judul" =>  "Belajar Laravel 10",
            "kategori" => "Programming",
            "pengarang" => "Rizki Darmawan",
            "penerbit" => "Informatika",
            "tahun" => 2023,
            "harga" => 95000,
            "stok" => 18
        ],
        [
            "kode" => "BK-010",
            "judul" => "Laut Bercerita",
            "kategori" => "Novel",
            "pengarang" => "Leila S. Chudori",
            "penerbit" => "Gramedia",
            "tahun" => 2017,
            "harga" => 115000,
            "stok" => 20
        ]
    ];
    
    // Ambil parameter GET
    $keyword = $_GET['keyword'] ?? '';
    $kategori = $_GET['kategori'] ?? '';
    $min_harga = $_GET['min_harga'] ?? '';
    $max_harga = $_GET['max_harga'] ?? '';
    $tahun = $_GET['tahun'] ?? '';
    $status = $_GET['status'] ?? 'semua';
    $sort = $_GET['sort'] ?? 'judul';
    $page = $_GET['page'] ?? 1; //parameter get
    
    
    // Validasi
    $errors = [];
    
    if (!empty($min_harga) && !empty($max_harga)) {
        if ($min_harga > $max_harga) {
            $errors[] = "Harga minimum tidak boleh lebih besar dari harga maksimum";
        }
    }

    // Validasi Tahun
    $current_year = date('Y');

    if (!empty($tahun)) {
        if ($tahun < 1900 || $tahun > $current_year) {
            $errors[] = "Tahun harus antara 1900 - $current_year";
        }
    }

    
    // TODO: Filter dan sorting
    $hasil = []; // Array untuk menyimpan hasil filter

    // Loop semua data buku satu per satu
    foreach($buku_list as $buku) {

        // Default: Lolos filter diawal
        $lolos = true;

        // Filter berdasarkan Keyword
        // Cek user apakah mengisi keyword
        if (!empty($keyword)) {
            // strlower untuk pencarian tidak case sensitive (diubah kecil semua)
            $keyword_lower = strtolower($keyword);
            $judul = strtolower ($buku['judul']);
            $pengarang = strtolower($buku['pengarang']);

            // Kalau keyword tidak ada maka tidak lolos filter
            if (
                strpos ($judul, $keyword_lower) === false &&
                strpos ($pengarang, $keyword_lower) === false
            ) {
                $lolos = false;
            }
        }

        // FILTER KATEGORI
        // Cek user apakah memilih kategori
        if (!empty($kategori)) {
            //Bandingkan kategori buku dengan input user
            if($buku['kategori'] != $kategori) {
                $lolos = false;
            }
        }

        // FILTER HARGA(min, max)
        // FILTER HARGA MIN
        // Jika user mengisi harga minimum
        if ($min_harga !== '') {
            //Jika harga buku lebih kecil dari min 
            if ($buku['harga'] < $min_harga) {
                $lolos = false;
            }
        }

        // FILTER HARGA MAX
        if ($max_harga !== '') {
            //Jika harga buku lebih dari max
            if ($buku['harga'] > $max_harga) {
                $lolos = false;
            }
        }

        // FILTER TAHUN
        if (!empty($tahun)) {
            if ($buku['tahun'] != $tahun) {
                $lolos = false;
            }
        }

        // FILTER STATUS
        // Jika pilih tersedia
        if ($status != 'semua') {
            if ($status == 'tersedia' && $buku['stok'] <=0) {
                $lolos = false;
            }
            // Jika pilih habis
            if ($status == 'habis' && $buku['stok'] > 0) {
                $lolos = false;
            } 
        }

        if ($lolos) {
            $hasil[] = $buku;
        }
    }

    // SORTING
    usort($hasil, function ($a, $b) use ($sort) {

        if ($sort == 'judul') {
            return strcmp($a['judul'], $b['judul']);
        }

        if ($sort == 'harga') {
            return $a['harga'] <=> $b['harga'];
        }

        if ($sort == 'tahun') {
            return $a['tahun'] <=> $b['tahun'];
        }

        return 0;
    });


    // TO DO: PAGINATION
    $per_page = 10; // Jumlah data per page
    $total_data = count($hasil);
    $total_page = ceil($total_data / $per_page);
    $offset = ($page - 1) * $per_page;
    $hasil = array_slice($hasil, $offset, $per_page);



    // TODO: Tampilkan form dan hasil
    
    
    ?>

    <div class="container mt-4">

    <!-- ERROR -->
    <?php if ($errors): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $e): ?>
                <div><?= $e ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- FORM -->
    <form method="GET" class="row g-2 mb-3">

        <div class="col">
            <input 
                class="form-control" 
                name="keyword" 
                placeholder="Keyword"
                value="<?= $keyword ?>">
        </div>

        <div class="col">
            <select class="form-control" name="kategori">
                <option value="">Semua</option>
                <option <?= $kategori=='Programming'?'selected':'' ?>>Programming</option>
                <option <?= $kategori=='Novel'?'selected':'' ?>>Novel</option>
            </select>
        </div>

        <div class="col">
            <input 
                class="form-control" 
                type="number" 
                name="min_harga" 
                placeholder="Min"
                value="<?= $min_harga ?>">
        </div>

        <div class="col">
            <input 
                class="form-control" 
                type="number" 
                name="max_harga" 
                placeholder="Max"
                value="<?= $max_harga ?>">
        </div>

        <div class="col">
            <input 
                class="form-control" 
                type="number" 
                name="tahun" 
                placeholder="Tahun"
                value="<?= $tahun ?>">
        </div>

        <div class="col">
            <select name="sort" class="form-control">
                <option value="judul">Judul</option>
                <option value="harga">Harga</option>
                <option value="tahun">Tahun</option>
            </select>
        </div>

        <div class="col">
            <button class="btn btn-primary w-100">Cari</button>
        </div>

    </form>

    <!-- TOTAL -->
    <h5>Total hasil: <?= $total_data ?></h5>

    <!-- TABEL -->
    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>Kode</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Harga</th>
            </tr>
        </thead>

        <tbody>
            <?php if ($hasil): ?>
                <?php foreach ($hasil as $b): ?>
                    <tr>
                        <td><?= $b['kode'] ?></td>

                        <td>
                            <?= !empty($keyword)
                                ? str_ireplace($keyword, "<mark>$keyword</mark>", $b['judul'])
                                : $b['judul'] ?>
                        </td>

                        <td><?= $b['kategori'] ?></td>

                        <td>
                            Rp <?= number_format($b['harga'], 0, ',', '.') ?>
                        </td>
                    </tr>
                <?php endforeach; ?>

            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">
                        Tidak ada data
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- PAGINATION -->
    <nav>
        <ul class="pagination">

            <?php for ($i = 1; $i <= $total_page; $i++): ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a class="page-link" href="?<?= build_query($i) ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>

        </ul>
    </nav>

</div>
</body>
</html>                                                                                                                                         