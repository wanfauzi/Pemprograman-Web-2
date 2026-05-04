<?php
$page_title = "Edit Anggota";

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int)$_GET['id'];
$errors = [];


// AMBIL DATA LAMA
$stmt = $conn->prepare("SELECT * FROM anggota WHERE id_anggota = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

if (!$data) {
    die("Data tidak ditemukan");
}

// PROSES UPDATE SANITASI
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $kode = sanitize($_POST['kode_anggota']);
    $nama = sanitize($_POST['nama']);
    $email = sanitize($_POST['email']);
    $telepon = sanitize($_POST['telepon']);
    $alamat = sanitize($_POST['alamat']);
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $pekerjaan = sanitize($_POST['pekerjaan']);

    
    // VALIDASI (SAMA SEPERTI CREATE)
    if (!$kode || !$nama || !$email || !$telepon || !$alamat || !$tanggal_lahir || !$jenis_kelamin) {
        $errors[] = "Semua field wajib diisi!";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid!";
    }

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

    // VALIDASI UNIK (KECUALI DIRINYA)
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id_anggota FROM anggota 
                               WHERE (kode_anggota = ? OR email = ?) 
                               AND id_anggota != ?");
        $stmt->bind_param("ssi", $kode, $email, $id);
        $stmt->execute();

        if ($stmt->get_result()->num_rows > 0) {
            $errors[] = "Kode atau email sudah digunakan!";
        }

        $stmt->close();
    }

   
    // FOTO
    $foto = $data['foto']; // default pakai foto lama

    if (empty($errors) && !empty($_FILES['foto']['name'])) {

        $folder = "uploads/";
        $filename = time() . '_' . $_FILES['foto']['name'];
        $path = $folder . $filename;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $path)) {

            // hapus foto lama
            if (!empty($data['foto']) && file_exists($folder . $data['foto'])) {
                unlink($folder . $data['foto']);
            }

            $foto = $filename;
        }
    }

    
    // UPDATE
    if (empty($errors)) {

        $stmt = $conn->prepare("UPDATE anggota SET
            kode_anggota=?,
            nama=?,
            email=?,
            telepon=?,
            alamat=?,
            tanggal_lahir=?,
            jenis_kelamin=?,
            pekerjaan=?,
            foto=?
            WHERE id_anggota=?");

        $stmt->bind_param("sssssssssi",
            $kode,
            $nama,
            $email,
            $telepon,
            $alamat,
            $tanggal_lahir,
            $jenis_kelamin,
            $pekerjaan,
            $foto,
            $id
        );

        if ($stmt->execute()) {
            header("Location: index.php?success=Data berhasil diupdate");
            exit;
        } else {
            $errors[] = "Gagal update data!";
        }

        $stmt->close();
    }
}
?>

<div class="container mt-4">
    <h3>Edit Anggota</h3>

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
                <input type="text" name="kode_anggota" class="form-control"
                    value="<?php echo htmlspecialchars($data['kode_anggota']); ?>" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control"
                    value="<?php echo htmlspecialchars($data['nama']); ?>" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control"
                    value="<?php echo htmlspecialchars($data['email']); ?>" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Telepon</label>
                <input type="text" name="telepon" class="form-control"
                    value="<?php echo htmlspecialchars($data['telepon']); ?>" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control"
                    value="<?php echo $data['tanggal_lahir']; ?>" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="Laki-laki" <?php echo $data['jenis_kelamin']=='Laki-laki'?'selected':''; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php echo $data['jenis_kelamin']=='Perempuan'?'selected':''; ?>>Perempuan</option>
                </select>
            </div>

            <div class="col-md-12 mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" required><?php echo htmlspecialchars($data['alamat']); ?></textarea>
            </div>

            <div class="col-md-6 mb-3">
                <label>Pekerjaan</label>
                <input type="text" name="pekerjaan" class="form-control"
                    value="<?php echo htmlspecialchars($data['pekerjaan']); ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label>Foto Baru (optional)</label><br>

                <?php if (!empty($data['foto'])): ?>
                    <img src="uploads/<?php echo $data['foto']; ?>" width="80"><br>
                <?php endif; ?>

                <input type="file" name="foto" class="form-control mt-2">
            </div>

        </div>

        <button class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>

    </form>
</div>

<?php
closeConnection();
require_once __DIR__ . '/../../includes/footer.php';
?>