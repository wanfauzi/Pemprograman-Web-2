<!DOCTYPE html>
<html lang="en">
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
    // Data Buku
    $judulBuku = "Laravel: From Beginner to Advance";
    $pengarang = "Budi Raharjo";
    $penerbit = "Informatika";
    $tahunTerbit = 2023 ;
    $harga = 125000 ;
    $stok = 8 ;
    $isbn = "978-602-1234-56-7";

    /* Modifikasi format harga */
    $harga_format = number_format($harga, 0, ',','.');
    ?>

    <div class = "card">
        <div class = "card-header bg-primary text-white">
            <h5 class = "mb-0"><?php echo $judulBuku ?></h5>
        </div>
        <div class = "card-body">
            <table class = "table table-borderless">
                <tr>
                    <th width="200">Pengarang</th>
                    <td>: <?php echo $pengarang; ?></td>
                </tr>
                <tr>
                    <th>Penerbit</th>
                    <td>: <?php echo $penerbit; ?></td>
                </tr>
                <tr>
                    <th>Tahun Terbit</th>
                    <td>: <?php echo $tahunTerbit; ?></td>
                </tr>
                <tr>
                    <th>ISBN</th>
                    <td>: <?php echo $isbn; ?></td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>: <?php echo $harga_format;?></td>
                </tr>
                <tr>
                    <th>Stok</th>
                    <td>: <?php echo $stok; ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>