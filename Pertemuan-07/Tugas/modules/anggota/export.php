<?php
require_once __DIR__ . '/../../config/database.php';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data_anggota.xls");

// Query
$result = $conn->query("SELECT * FROM anggota");

echo "<table border='1'>";
echo "<tr>
        <th>No</th>
        <th>Kode</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Telepon</th>
        <th>Status</th>
        <th>JK</th>
      </tr>";

$no = 1;
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$no}</td>
            <td>{$row['kode_anggota']}</td>
            <td>{$row['nama']}</td>
            <td>{$row['email']}</td>
            <td>{$row['telepon']}</td>
            <td>{$row['status']}</td>
            <td>{$row['jenis_kelamin']}</td>
          </tr>";
    $no++;
}

echo "</table>";
exit;
?>