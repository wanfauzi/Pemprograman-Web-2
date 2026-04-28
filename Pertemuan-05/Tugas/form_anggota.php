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
    // Fungsi untuk sanitasi input(hanya menghapus spasi)
    function sanitize_input($data) {
        return trim($data);
    }
    // 1. Inisialisasi variabel untuk menyimpan nilai input 
    // Supaya form bisa keep value setelah submit
    $nama = "";
    $email = "";
    $telepon = "";
    $alamat = "";
    $jenis_kelamin = "";
    $tgl_lahir = "";
    $pekerjaan = "";

    $errors = []; // Array untuk menampung error per bagian

    // 2. Cek submit form, kode hanya jalan saat tombol submit ditekan
    // Menggunakan method POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil data dari form + sanitasi ringan (trim)
        $nama = sanitize_input($_POST['nama'] ?? '');
        $email = sanitize_input($_POST['email'] ?? '');
        $telepon = sanitize_input($_POST['telepon'] ?? '');
        $alamat = sanitize_input($_POST['alamat'] ?? '');
        $jenis_kelamin = $_POST['jenis_kelamin'] ?? ''; // Tidak perlu sanitze karena radio button
        $tgl_lahir = $_POST['tgl_lahir'] ?? '';
        $pekerjaan = $_POST['pekerjaan'] ?? '';

    // 3. Cek validasi input
        // Validasi nama
        if (empty($nama)) {
            $errors['nama'] = "Nama wajib diisi";
        } elseif (strlen($nama) < 3) {
            $errors['nama'] = "Nama minimal 3 karakter";
        }

        // Validasi email menggunakan built in function php
        if (empty($email)) {
            $errors['email'] = "Email wajib diisi";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Format email tidak valid";
        }

        // Validasi telepon pakai regex
        if (empty($telepon)) {
            $errors['telepon'] = "Nomor telepon wajib diisi";
        } elseif (!preg_match("/^08[0-9]{8,11}$/", $telepon)) {
            $errors['telepon'] = "Format harus 08xxxxxxxxxx (10-13 digit)";
            // Regex:
            // ^08 , harus diawali 08
            // [0-9]{8,11} , diikuti angka 8–11 digit
            // $, akhir string
        }

        // Validasi alamat
        if (empty($alamat)) {
            $errors['alamat'] = "Alamat wajib diisi";
        } elseif (strlen($alamat) < 10) {
            $errors['alamat'] = "Alamat minimal 10 karakter";
        }

        // Validasi jenis kelamin
        if (empty($jenis_kelamin)) {
            $errors['jenis_kelamin'] = "Pilih jenis kelamin";
        }

        // Validasi umur
        if (empty($tgl_lahir)) {
            $errors['tgl_lahir'] = "Tanggal lahir wajib diisi";
        } elseif (!strtotime($tgl_lahir)) {
            // Cek apakah format tanggal valid
            $errors['tgl_lahir'] = "Format tanggal tidak valid";
        } else {
            // Hitung umur
            $tgl = date_create($tgl_lahir);
            $today = date_create('today');
            $umur = date_diff($tgl, $today)->y;

            // Cek umur minimal
            if ($umur < 10) {
                $errors['tgl_lahir'] = "Umur minimal 10 tahun";
            }
        }

        // Validasi pekerjaan
        if (empty($pekerjaan)) {
            $errors['pekerjaan'] = "Pilih pekerjaan";
        }

        // CEK HASIL AKHIR JIKA TIDAK ADA EROR
        if (empty($errors)) {
            $success = "Data berhasil disimpan";
        }

        // Tambahan reset
        if (isset($_POST['reset'])) {
            $nama = $email = $telepon = $alamat = $jenis_kelamin = $tgl_lahir = $pekerjaan = "";
            $errors = [];
        }
    }
    ?>


    <!-- Kode html php bootstrap -->
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-person"></i> Form Input Anggota</h4>
            </div>
            <div class="card-body">
                <!-- Tampilkan pesan sukses -->
                <?php if (isset($success) && $success): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle-fill"></i> <strong>Berhasil!</strong> <?php echo $success; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>

                <!-- Tampilakn pesan error -->
                <?php if (count($errors) > 0): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <h6><i class="bi bi-exclamation-triangle-fill"></i> Terdapat <?php echo count($errors); ?> kesalahan:</h6>
                    <ul class="mb-0">
                        <?php foreach ($errors as $field => $error): ?>
                            <li><strong><?php echo ucfirst($field); ?>:</strong> <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>
                

                <!-- TAMPILAN FORM -->
                <form action="" novalidate method="POST">
                    <!-- Nama Lengkap   -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">
                            Nama Lengkap <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                            name="nama" id="nama" 
                            class="form-control <?php echo isset($errors['nama']) ? 'is-invalid' : '';?>"
                            value="<?php echo htmlspecialchars($nama);?>"
                            >
                        <div class="invalid-feedback">
                            <?php echo $errors['nama'] ?? '' ;?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            Email <span class="text-danger">*</span>
                        </label>
                        <input type="email" name="email" id="email"
                                class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : '';?>"
                                value="<?php echo htmlspecialchars($email);?>"
                                >

                        <div class="invalid-feedback">
                            <?php echo $errors['email'] ?? '' ;?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="telepon" class="form-label">
                            Telepon <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                            name="telepon" id="telepon" 
                            class="form-control <?php echo isset($errors['telepon']) ? 'is-invalid' : '';?>"
                            value="<?php echo htmlspecialchars($telepon);?>">

                        <div class="invalid-feedback">
                            <?php echo $errors['telepon'] ?? '' ;?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">
                            Alamat <span class="text-danger">*</span>
                        </label>
                        <textarea name="alamat"
                                class="form-control <?php echo isset($errors['alamat']) ? 'is-invalid' : '' ;?>"><?php echo htmlspecialchars($alamat) ;?></textarea>

                        <div class="invalid-feedback">
                            <?php echo $errors['alamat'] ?? '' ;?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Jenis Kelamin <span class="text-danger">*</span>
                        </label><br>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-laki"
                            <?php echo ($jenis_kelamin == 'Laki-laki') ? 'checked' : '' ;?>>
                            <label class="form-check-label">Laki-laki</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan"
                            <?php echo ($jenis_kelamin == 'Perempuan') ? 'checked' : '' ;?>>
                            <label class="form-check-label">Perempuan</label>
                        </div>

                        <div class="text-danger">
                            <?php echo $errors['jenis_kelamin'] ?? '' ;?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tgl_lahir" class="form-label">
                            Tanggal Lahir <span class="text-danger">*</span>
                        </label>

                        <input 
                            type="date" 
                            name="tgl_lahir" 
                            id="tgl_lahir"
                            class="form-control <?= isset($errors['tgl_lahir']) ? 'is-invalid' : '' ?>"
                            value="<?= htmlspecialchars($tgl_lahir) ?>"
                        >

                        <div class="invalid-feedback">
                            <?= $errors['tgl_lahir'] ?? '' ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="pekerjaan" class="form-label">
                            Pekerjaan <span class="text-danger">*</span>
                        </label>
                        
                        <select name="pekerjaan" 
                                class="form-select <?php echo isset($errors['pekerjaan']) ? 'is-invalid' : ''; ?>">
                            <option value="">-- Pilih Pekerjaan --</option>
                            <option value="Pelajar" <?php echo ($pekerjaan == 'Pelajar') ? 'selected' : '' ;?>>Pelajar</option>
                            <option value="Mahasiswa" <?php echo ($pekerjaan == 'Mahasiswa') ? 'selected' : '' ;?>>Mahasiswa</option>
                            <option value="Pegawai" <?php echo ($pekerjaan == 'Pegawai') ? 'selected' : '' ;?>>Pegawai</option>
                            <option value="Lainnya" <?php echo ($pekerjaan == 'Lainnya') ? 'selected' : '' ;?>>Lainnya</option>
                        </select>

                        <div class="invalid-feedback">
                            <?php echo $errors['pekerjaan'] ?? '' ;?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="submit" name="reset" class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>
    </div>


</body>
</html>                                                                                                                                         