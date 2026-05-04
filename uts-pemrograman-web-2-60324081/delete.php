<?php
require_once 'config/database.php';

// 1. Validasi ID dari GET
if (!isset($_GET['id'])) {
    header("Location: index.php?pesan=error");
    exit;
}

$id = (int)$_GET['id'];

if ($id <= 0) {
    header("Location: index.php?pesan=error");
    exit;
}

// 2. Cek apakah data ada
$stmt = $conn->prepare("SELECT id_kategori FROM kategori WHERE id_kategori = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: index.php?pesan=error");
    exit;
}

// 3. Delete data
$stmt = $conn->prepare("DELETE FROM kategori WHERE id_kategori = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

// 4. Cek berhasil atau tidak
if ($stmt->affected_rows > 0) {
    header("Location: index.php?pesan=hapus");
    exit;
} else {
    header("Location: index.php?pesan=error");
    exit;
}
?>