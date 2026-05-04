<?php
$page_title = "Tambah Anggota";

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/header.php';

$errors = [];

// =======================
// PROSES SUBMIT
// =======================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $kode = sanitize($_POST['kode_anggota']);
    $nama = sanitize($_POST['nama']);
    $email = sanitize($_POST['email']);
    $telepon = sanitize($_POST['telepon']);
    $alamat = sanitize($_POST['alamat']);
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $pekerjaan = sanitize($_POST['pekerjaan']);

    // =======================
    // VALIDASI
    // =======================

    // REQUIRED
    if (!$kode || !$nama || !$email || !$telepon || !$alamat || !$tanggal_lahir || !$jenis_kelamin) {
        $errors[] = "Semua field wajib diisi!";
    }

    // EMAIL
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid!";
    }

    // TELEPON
    if (!preg_match('/^08[0-9]{8,11}$/', $telepon)) {
        $errors[] = "Nomor telepon harus diawali 08!";
    }

    // UMUR
    $birth = new DateTime($tanggal_lahir);
    $today = new DateTime();
    $age = $today->diff($birth)->y;

    if ($age < 10) {
        $errors[] = "Umur minimal 10 tahun!";
    }

    // =======================
    // CEK DUPLIKAT
    // =======================
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id_anggota FROM anggota WHERE kode_anggota = ? OR email = ?");
        $stmt->bind_param("ss", $kode, $email);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $errors[] = "Kode atau email sudah digunakan!";
        }
        $stmt->close();
    }

    // =======================
    // UPLOAD FOTO
    // =======================
    $foto = '';

    if (empty($errors) && !empty($_FILES['foto']['name'])) {

        $folder = "uploads/";
        $filename = time() . '_' . $_FILES['foto']['name'];
        $path = $folder . $filename;

        move_uploaded_file($_FILES['foto']['tmp_name'], $path);
        $foto = $filename;
    }

    // =======================
    // INSERT
    // =======================
    if (empty($errors)) {

        $stmt = $conn->prepare("INSERT INTO anggota 
        (kode_anggota, nama, email, telepon, alamat, tanggal_lahir, jenis_kelamin, pekerjaan, tanggal_daftar, status, foto)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, CURDATE(), 'Aktif', ?)");

        $stmt->bind_param("sssssssss",
            $kode,
            $nama,
            $email,
            $telepon,
            $alamat,
            $tanggal_lahir,
            $jenis_kelamin,
            $pekerjaan,
            $foto
        );

        if ($stmt->execute()) {
            header("Location: index.php?success=Anggota berhasil ditambahkan");
            exit;
        } else {
            $errors[] = "Gagal menyimpan data!";
        }

        $stmt->close();
    }
}
?>

<div class="container mt-4">
    <h3>Tambah Anggota</h3>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $e): ?>
                    <li><?php echo $e; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Kode Anggota</label>
                <input type="text" name="kode_anggota" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Telepon</label>
                <input type="text" name="telepon" class="form-control" placeholder="08xxxxxxxxxx" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="col-md-12 mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" required></textarea>
            </div>

            <div class="col-md-6 mb-3">
                <label>Pekerjaan</label>
                <input type="text" name="pekerjaan" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Foto (optional)</label>
                <input type="file" name="foto" class="form-control">
            </div>

        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>

    </form>
</div>

<?php
closeConnection();
require_once __DIR__ . '/../../includes/footer.php';
?>