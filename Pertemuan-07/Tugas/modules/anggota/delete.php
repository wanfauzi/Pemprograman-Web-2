<?php
require_once __DIR__ . '/../../config/database.php';

// =======================
// CEK ID
// =======================
if (!isset($_GET['id'])) {
    header("Location: index.php?error=ID tidak valid");
    exit;
}

$id = (int)$_GET['id'];

// =======================
// AMBIL DATA (UNTUK FOTO)
// =======================
$stmt = $conn->prepare("SELECT foto FROM anggota WHERE id_anggota = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

if (!$data) {
    header("Location: index.php?error=Data tidak ditemukan");
    exit;
}

// =======================
// HAPUS FOTO (JIKA ADA)
// =======================
if (!empty($data['foto'])) {
    $path = "uploads/" . $data['foto'];

    if (file_exists($path)) {
        unlink($path);
    }
}

// =======================
// HAPUS DATA
// =======================
$stmt = $conn->prepare("DELETE FROM anggota WHERE id_anggota = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php?success=Data berhasil dihapus");
} else {
    header("Location: index.php?error=Gagal menghapus data");
}

$stmt->close();
closeConnection();
exit;
?>