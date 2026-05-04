<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kategori - UTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
    require_once 'config/database.php';
    
    // TODO: Query data kategori
    // QUERY dengan Prepared Statement sebagai keamanan
    // Menyiapkan query dulu, supaya aman, baru jalankan, ambil hasilnya
    $stmt = $conn->prepare("SELECT * FROM kategori ORDER BY id_kategori DESC");
    $stmt->execute();
    $result = $stmt->get_result();

    // TODO: Cek hasil query
    if (!$result) {
        die("Query error: " . $conn->error);
    }
    ?>
    
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Daftar Kategori Buku</h2>
            <a href="create.php" class="btn btn-primary">Tambah Kategori</a>
        </div>
        
        <!-- TODO: Tampilkan pesan sukses/error jika ada -->
        <!-- Pakai method get -->
        <?php if (isset($_GET['pesan'])) { ?>
            <?php if ($_GET['pesan'] == 'tambah') { ?>
                <div class="alert alert-success">Data berhasil ditambahkan</div>
            <?php } elseif ($_GET['pesan'] == 'edit') { ?>
                <div class="alert alert-success">Data berhasil diupdate</div>
            <?php } elseif ($_GET['pesan'] == 'hapus') { ?>
                <div class="alert alert-success">Data berhasil dihapus</div>
            <?php } elseif ($_GET['pesan'] == 'error') { ?>
                <div class="alert alert-danger">Terjadi kesalahan</div>
            <?php } ?>

        <?php } ?>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th width="100">Kode</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th width="100">Status</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // TODO: Loop data dan tampilkan
                        $no = 1;            

                        if($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($row['kode_kategori']); ?></td>
                            <td><?php echo htmlspecialchars($row['nama_kategori']);?></td>
                            <td><?php echo htmlspecialchars($row['deskripsi']); ?></td>
                        
                            <!-- Status ditampilkan -->
                            <td>
                                <?php if($row['status'] == 'Aktif') { ?>
                                    <span class = "badge bg-success">Aktif</span>
                                <?php } else { ?>
                                    <span class="badge bg-danger">Nonaktif</span>
                                <?php } ?>
                            </td>

                            <!-- Tombol edit dan hapus warna -->
                            <td>
                                <a href="edit.php?id=<?= $row['id_kategori']; ?>" 
                                    class="btn btn-warning btn-sm">Edit</a>
                                <button onclick="confirmDelete(<?= $row['id_kategori']; ?>)" class="btn btn-danger btn-sm">Hapus</button>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                        ?>
                        <tr>
                            <td colspan = "6" class= "text-center">Data tidak tersedia</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Function JS konfirm hapus -->
    <script>
    function confirmDelete(id) {
        if (confirm('Yakin ingin menghapus kategori ini?')) {
            window.location.href = 'delete.php?id=' + id;
        }
    }
    </script>
</body>
</html>