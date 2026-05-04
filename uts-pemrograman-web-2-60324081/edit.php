<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kategori - UTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
    require_once 'config/database.php';
    
    // TODO: Ambil ID dari GET
    if (!isset($_GET['id'])) {
        header("Location: index.php?pesan=error");
        exit;
    }
    $id = (int) $_GET['id'];

    // TODO: Retrieve data berdasarkan ID
    $stmt = $conn->prepare("SELECT * FROM kategori WHERE id_kategori = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 0) {
        header("Location: index.php?pesan=error");
        exit;    
    }

    $data = $result->fetch_assoc();
    
    
    // TODO: Jika POST, proses update
    // Inisiasi data awal dulu
    $kode = $data['kode_kategori'];
    $nama = $data['nama_kategori'];
    $deskripsi = $data['deskripsi'];
    $status = $data['status'];

    $errors = [];

    // Proses update ketika submit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $kode = htmlspecialchars(trim($_POST['kode']));
        $nama = htmlspecialchars(trim($_POST['nama']));
        $deskripsi = htmlspecialchars(trim($_POST['deskripsi']));
        $status = htmlspecialchars($_POST['status']);

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
        
        // Cek kode buku duplikat dengan id dan kode
        if (empty($errors)) {
            $stmt = $conn->prepare("SELECT id_kategori FROM kategori WHERE kode_kategori = ? AND id_kategori != ?");
            $stmt->bind_param("si", $kode, $id);
            $stmt->execute();
            $cek = $stmt->get_result();

            if ($cek->num_rows > 0) {
                $errors[] = "Kode sudah digunakan";
            }
        }

        // UPDATE 
        if (empty($errors)) {
            $stmt = $conn->prepare("UPDATE kategori SET kode_kategori=?, nama_kategori=?, deskripsi=?, status=? WHERE id_kategori=?");
            $stmt->bind_param("ssssi", $kode, $nama, $deskripsi, $status, $id);

            if ($stmt->execute()) {
                header("Location: index.php?pesan=edit");
                exit;
            } else {
                $errors[] = "Gagal update data";
            }
        }
    }
    
    ?>
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Kategori</h4>
                    </div>
                    <div class="card-body">
                        <!-- TODO: Form dengan data pre-filled -->
                        <!-- ERROR -->
                        <?php if (!empty($errors)) { ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php foreach ($errors as $e) { ?>
                                        <li><?= $e ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>

                        <!-- FORM -->
                        <form method="POST">

                            <div class="mb-3">
                                <label>Kode</label>
                                <input type="text" name="kode" class="form-control" value="<?= $kode ?>">
                            </div>

                            <div class="mb-3">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" value="<?= $nama ?>">
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

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="index.php" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>