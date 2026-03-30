<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Info Buku - Perpustakaan</title>
</head>
<body>
    <div class = "container mt-5">
        <h1 class = "mb-4"> Informasi Buku </h1>    

    <?php 
    // Data Buku 1
    $judul1 = "Pemrograman PHP Modern";
    $pengarang1 = "Budi Jaya";
    $penerbit1 = "Sistem Informasi";
    $tahun1 = 2023 ;
    $harga1 = 115000 ;
    $stok1 = 12 ;
    $isbn1 = "978-602-1234-56-9";
    $kategori1 = "Programming";
    $bahasa1 = "Indonesia";
    $halaman1 = 160;
    $berat1 = 200;

    // Data Buku 2
    $judul2 = "Basic of MySQL Database";
    $pengarang2 = "Alexander";
    $penerbit2 = "Tech";
    $tahun2 = 2022 ;
    $harga2 = 105000 ;
    $stok2 = 40 ;
    $isbn2 = "978-602-1234-52-9";
    $kategori2 = "Database";
    $bahasa2 = "English";
    $halaman2 = 200;
    $berat2 = 300;

    // Data Buku 3
    $judul3 = "UI/UX for Beginner ";
    $pengarang3 = "Alexander";
    $penerbit3 = "Tech";
    $tahun3 = 2022 ;
    $harga3 = 90000 ;
    $stok3 = 29 ;
    $isbn3 = "978-602-1234-12-9";
    $kategori3 = "Web Design";
    $bahasa3 = "English";
    $halaman3 = 345;
    $berat3 = 469;
    
    // Data Buku 4
    $judul4 = "Laravel: From Beginner to Advance";
    $pengarang4 = "Budi Raharjo";
    $penerbit4 = "Informatika";
    $tahun4 = 2023 ;
    $harga4 = 125000 ;
    $stok4 = 8 ;
    $isbn4 = "978-602-1234-50-7";
    $kategori4 = "Programming";
    $bahasa4 = "English";
    $halaman4 = 123;
    $berat4 = 219;
    ?>

    <!-- Buku 1 -->
    <div class = "card mb-4">
        <div class = "card-header bg-primary text-white">
            <h5 class = "mb-0"><?php echo $judul1 ?></h5>
        </div>
        <div class = "card-body">
            <table class = "table table-borderless">
                <tr>
                    <th width="200">Pengarang</th>
                    <td>: <?php echo $pengarang1; ?></td>
                </tr>
                <tr>
                    <th>Penerbit</th>
                    <td>: <?php echo $penerbit1; ?></td>
                </tr>
                <tr>
                    <th>Tahun Terbit</th>
                    <td>: <?php echo $tahun1; ?></td>
                </tr>
                <tr>
                    <th>ISBN</th>
                    <td>: <?php echo $isbn1; ?></td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>: Rp <?php echo $harga_format = number_format($harga1, 0, ',','.');?></td>
                </tr>
                <tr>
                    <th>Stok</th>
                    <td>: <?php echo $stok1; ?></td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td>: <span class = "badge bg-secondary"><?php echo $kategori1; ?></span></td>
                </tr>
                <tr>
                    <th>Bahasa</th>
                    <td>: <?php echo $bahasa1; ?></td>
                </tr>
                <tr>
                    <th>Halaman</th>
                    <td>: <?php echo $halaman1;?></td>                
                </tr>
                <tr>
                    <th>Berat</th>
                    <td>: <?php echo $berat1 ?> gram</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Buku 2 -->
    <div class = "card mb-4">
        <div class = "card-header bg-primary text-white">
            <h5 class = "mb-0"><?php echo $judul2 ?></h5>
        </div>
        <div class = "card-body">
            <table class = "table table-borderless">
                <tr>
                    <th width="200">Pengarang</th>
                    <td>: <?php echo $pengarang2; ?></td>
                </tr>
                <tr>
                    <th>Penerbit</th>
                    <td>: <?php echo $penerbit2; ?></td>
                </tr>
                <tr>
                    <th>Tahun Terbit</th>
                    <td>: <?php echo $tahun2; ?></td>
                </tr>
                <tr>
                    <th>ISBN</th>
                    <td>: <?php echo $isbn2; ?></td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>: Rp <?php echo $harga_format = number_format($harga2, 0, ',','.');?></td>
                </tr>
                <tr>
                    <th>Stok</th>
                    <td>: <?php echo $stok2; ?></td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td>: <span class = "badge bg-warning"><?php echo $kategori2; ?></span></td>
                </tr>
                <tr>
                    <th>Bahasa</th>
                    <td>: <?php echo $bahasa2; ?></td>
                </tr>
                <tr>
                    <th>Halaman</th>
                    <td>: <?php echo $halaman2;?></td>                
                </tr>
                <tr>
                    <th>Berat</th>
                    <td>: <?php echo $berat2 ?> gram</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Buku 3 -->
    <div class = "card mb-4">
        <div class = "card-header bg-primary text-white">
            <h5 class = "mb-0"><?php echo $judul3 ?></h5>
        </div>
        <div class = "card-body">
            <table class = "table table-borderless">
                <tr>
                    <th width="200">Pengarang</th>
                    <td>: <?php echo $pengarang3; ?></td>
                </tr>
                                <tr>
                    <th>Penerbit</th>
                    <td>: <?php echo $penerbit3; ?></td>
                </tr>
                <tr>
                    <th>Tahun Terbit</th>
                    <td>: <?php echo $tahun3; ?></td>
                </tr>
                <tr>
                    <th>ISBN</th>
                    <td>: <?php echo $isbn3; ?></td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>: Rp <?php echo $harga_format = number_format($harga3, 0, ',','.');?></td>
                </tr>
                <tr>
                    <th>Stok</th>
                    <td>: <?php echo $stok3; ?></td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td>: <span class = "badge bg-dark"><?php echo $kategori3; ?></span></td>
                </tr>
                <tr>
                    <th>Bahasa</th>
                    <td>: <?php echo $bahasa3; ?></td>
                </tr>
                <tr>
                    <th>Halaman</th>
                    <td>: <?php echo $halaman3;?></td>                
                </tr>
                <tr>
                    <th>Berat</th>
                    <td>: <?php echo $berat3 ?> gram</td>
                </tr>
            </table>
        </div>
    </div>
    
    <!-- Buku 4 -->
    <div class = "card mb-4">
        <div class = "card-header bg-primary text-white">
            <h5 class = "mb-0"><?php echo $judul4 ?></h5>
        </div>
        <div class = "card-body">
            <table class = "table table-borderless">
                <tr>
                    <th width="200">Pengarang</th>
                    <td>: <?php echo $pengarang4; ?></td>
                </tr>
                <tr>
                    <th>Penerbit</th>
                    <td>: <?php echo $penerbit4; ?></td>
                </tr>
                <tr>
                    <th>Tahun Terbit</th>
                    <td>: <?php echo $tahun4; ?></td>
                </tr>
                <tr>
                    <th>ISBN</th>
                    <td>: <?php echo $isbn4; ?></td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>: Rp <?php echo $harga_format = number_format($harga4, 0, ',','.');?></td>
                </tr>
                <tr>
                    <th>Stok</th>
                    <td>: <?php echo $stok4; ?></td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td>: <span class = "badge bg-secondary"><?php echo $kategori4; ?></span></td>
                </tr>
                <tr>
                    <th>Bahasa</th>
                    <td>: <?php echo $bahasa4; ?></td>
                </tr>
                <tr>
                    <th>Halaman</th>
                    <td>: <?php echo $halaman4;?></td>                
                </tr>
                <tr>
                    <th>Berat</th>
                    <td>: <?php echo $berat4 ?> gram</td>
                </tr>
            </table>
        </div>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>