<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori - UTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
    require_once 'config/database.php';
    
    $errors = [];
    $kode = '';
    $nama = '';
    $deskripsi = '';
    $status = 'Aktif';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // TODO: Ambil dan sanitasi data dari form
        $kode = htmlspecialchars(trim($_POST['kode']));
        $nama = htmlspecialchars(trim($_POST['nama']));
        $deskripsi = htmlspecialchars(trim($_POST['deskripsi']));
        $status = isset($_POST['status']) ? htmlspecialchars($_POST['status']) : 'Aktif';
    

    // Validasi kode kategori
    if (empty($kode)) {
        $errors[] = "Kode kategori wajib diisi";
    } elseif (strlen($kode) <4 || strlen($kode) > 10) {
        $errors[] = "Kode kategori harus 4-10 karakter";
    } elseif (!preg_match('/^KAT-\d{3,}$/', $kode)) { // \d{3,} angka minimal 3 digit
        $errors[] = "Format kode harus KAT- diikuti minimal 3 angka (contoh: KAT-001)";
    }
   
    // Validasi nama
    if (empty($nama)) {
        $errors[] = "Nama kategori buku wajib diisi";
    } elseif (strlen($nama) < 3) {
        $errors[] = "Nama kategori minimal 3 karakter";
    } elseif (strlen($nama) > 50) {
        $errors[] = "Nama kategori maksimal 50 karakter";
    }
    
    // Validasi deskripsi
    if (!empty($deskripsi) && strlen($deskripsi) > 200) {
        $errors[] = "Deskripsi maksimal 200 karakter";
    }

    // Validasi status
    if (!in_array($status, ['Aktif', 'Nonaktif'])) {
        $errors[] = "Status tidak valid";
    }
    
    // TODO: Cek duplikasi kode
    // Cek kode buku duplikat
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id_kategori FROM kategori WHERE kode_kategori = ?");
        $stmt->bind_param("s", $kode);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $errors[] = "Kode kategori sudah digunakan";
        }
        $stmt->close();
    }
    
    // Jika tidak ada error, insert data ke database
    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO kategori (kode_kategori, nama_kategori, deskripsi, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $kode, $nama, $deskripsi, $status);

        // TODO: Redirect jika berhasil
        if ($stmt->execute()) {
            header("Location: index.php?pesan=tambah");
            exit;
        } else {
            $errors[] = "Gagal menambahkan data";
        }
    }
}

    ?>
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Kategori Baru</h4>
                    </div>
                    <div class="card-body">
                        <!-- TODO: Tampilkan error jika ada -->
                        <?php if (!empty($errors)) { ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php foreach ($errors as $error) { ?>
                                        <li><?= $error; ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>
                        <form method="POST">
                            <!-- TODO: Form fields -->
                            <div class="mb-3">
                                <label>Kode Kategori</label>
                                <input type="text" name="kode" class="form-control" value="<?= $kode ?>" required>
                            </div>

                            <div class="mb-3">
                                <label>Nama Kategori</label>
                                <input type="text" name="nama" class="form-control" value="<?= $nama ?>" required>
                            </div>

                            <div class="mb-3">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" class="form-control"><?= $deskripsi ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label>Status</label><br>
                                <input type="radio" name="status" value="Aktif" <?= $status == 'Aktif' ? 'checked' : '' ?>> Aktif
                                <input type="radio" name="status" value="Nonaktif" <?= $status == 'Nonaktif' ? 'checked' : '' ?>> Nonaktif
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="index.php" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>