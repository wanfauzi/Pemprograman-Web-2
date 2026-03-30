<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perhitungan Diskon Bertingkat - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class = "container mt-5">
        <h2 class = "text-center mb-4"> Sistem Perhitungan Diskon Bertingkat</h2>

        <?php 
        // Data pembeli dan buku
        $nama_pembeli = "Tarno Wijayanto";
        $judul_buku = "Laravel Advanced";
        $harga_satuan = 150000;
        $jumlah_beli = 4;
        $is_member = true;
    
        // Hitung Subtotal
        $subtotal = $harga_satuan * $jumlah_beli; 

        // Diskon berdasarkan jumlah
        if ($jumlah_beli > 10) { 
            $persentase_diskon = 20;
        } else if ($jumlah_beli >= 6){
            $persentase_diskon = 15;
        }  else if ($jumlah_beli >= 3){
            $persentase_diskon = 10;
        } else {
            $persentase_diskon = 0;
        }

        // Jumlah diskon
        $diskon = $subtotal * ($persentase_diskon /100); // 600 x 10% = 60.000
        $sisa = $subtotal - $diskon; //600.000 - 60.000 =  540.000 

        //Persentase diskon member 
        // Diskon Member (Sisa x Diskon member)
        if ($is_member) {
            $persentase_diskon_member = 5; //Member diskon 5%
            $diskon_member = $sisa * ($persentase_diskon_member/100); // 540.000 x 5% = 27.000
        } else {
            $persentase_diskon_member = 0; 
            $diskon_member = 0; //Bukan member tidak diskon
        }

        // Total setelah diskon
        $total_setelah_diskon = $subtotal - ($diskon + $diskon_member);

        // PPN 11%
        $persentase_ppn = 11;
        $ppn = $total_setelah_diskon * ($persentase_ppn/100); //513.000 x 11%

        // Total akhir
        $total_akhir = $total_setelah_diskon + $ppn;

        // Total hemat
        $total_hemat = $diskon + $diskon_member;
        ?>

       
        <!-- TODO: Tampilkan hasil perhitungan dengan Bootstrap -->
        <!-- Gunakan card, table, dan badge -->
        <div class = "card-shadow">
            <div class ="card-body">
                
                <!-- Data pembeli -->
                <span class = "badge bg-primary mb-3">Transaksi</span>
                <table class = "table table-sm">
                    <tr>
                        <th width = "250" >Nama Pembeli</th>
                        <td>: <?php echo $nama_pembeli; ?></td>
                    </tr>
                    <tr>
                        <th>Judul Buku</th>
                        <td>: <?php echo $judul_buku; ?></td>
                    </tr>   
                    <tr>
                        <th>Harga Satuan</th>
                        <td>: Rp <?php echo number_format($harga_satuan, 0,',','.'); ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah Beli</th>
                        <td>: <?php echo $jumlah_beli; ?>
                    </tr>
                    <tr>
                        <th>Status</th> <!-- Struktur ternary operator Kondisi ? "Jika Benar" : "Jika salah"; -->
                        <td>: <?php 
                                echo $is_member 
                                ? '<span class = "badge bg-success">Member</span>' 
                                : '<span class = "badge bg-secondary">Bukan Member</span>'; ?> <!-- Cek dengan ternary operator dengan ? TRUE : FALSE -->
                    </tr>
                </table>

                <table class ="table table-bordered">   
                    <tr>
                        <th>Subtotal</th>
                        <td class = "text-end">Rp <?php echo number_format($subtotal, 0,',','.'); ?></td>
                    </tr>
                    <tr>
                        <th>Diskon (<?php echo $persentase_diskon ?>%)</th>
                        <td class="text-end text-danger">Rp <?php echo number_format($diskon, 0,',','.');?></td>
                    </tr>
                    <tr>
                        <th>Diskon Member (<?php echo $persentase_diskon_member; ?>%)</th>
                        <td class="text-end text-danger">Rp <?php echo number_format($diskon_member, 0,',','.');?> 
                             (Dari Rp <?php echo number_format($sisa,0,',','.'); ?>)</td>
                    </tr>
                        <th>Total Setelah Diskon</th>
                        <td class="text-end">Rp <?php echo number_format($total_setelah_diskon,0,',','.');?></td>
                    </tr>
                    <tr>
                        <th>PPN (<?php echo $persentase_ppn; ?>%)</th>
                        <td class="text-end">Rp <?php echo number_format($ppn, 0,',','.');?></td>
                    </tr>
                    <tr class="table-success">
                        <th>Total Akhir</th>
                        <td class="text-end">Rp <?php echo number_format($total_akhir,0,',','.');?></td>
                    </tr>
                </table>
                    <div class ="text-end">
                        <span class= "badge bg-warning"> Anda Hemat Rp 
                            <?php echo number_format($total_hemat,0,',','.');?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>