<?php
$page_title = "Data Anggota";
// Gunakan __DIR__ biar path selalu akurat
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/header.php';


// PAGINATION
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// SEARCH
$search = isset($_GET['search']) ? sanitize($_GET['search']) : '';

$status = $_GET['status'] ?? '';
$jk = $_GET['jk'] ?? '';

// QUERY
$where = [];
$params = [];
$types = "";

// SEARCH
if (!empty($search)) {
    $where[] = "(nama LIKE ? OR email LIKE ? OR telepon LIKE ?)";
    $search_param = "%$search%";
    $params[] = $search_param;
    $params[] = $search_param;
    $params[] = $search_param;
    $types .= "sss";
}

// STATUS
if (!empty($status)) {
    $where[] = "status = ?";
    $params[] = $status;
    $types .= "s";
}

// JENIS KELAMIN
if (!empty($jk)) {
    $where[] = "jenis_kelamin = ?";
    $params[] = $jk;
    $types .= "s";
}

// GABUNG WHERE
$where_sql = $where ? "WHERE " . implode(" AND ", $where) : "";

// QUERY UTAMA
$query = "SELECT * FROM anggota 
          $where_sql 
          ORDER BY created_at DESC 
          LIMIT ? OFFSET ?";

$params[] = $limit;
$params[] = $offset;
$types .= "ii";

$stmt = $conn->prepare($query);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

// COUNT DATA
$count_query = "SELECT COUNT(*) as total FROM anggota $where_sql";
$stmt_count = $conn->prepare($count_query);

if (!empty($where)) {
    $count_types = substr($types, 0, -2); // hilangkan ii
    $count_params = array_slice($params, 0, -2);
    $stmt_count->bind_param($count_types, ...$count_params);
}

$stmt_count->execute();
$total_rows = $stmt_count->get_result()->fetch_assoc()['total'];

$total_pages = ceil($total_rows / $limit);
?>

<div class="container">

    <!-- HEADER -->
    <div class="d-flex justify-content-between mb-3">
        <h3>Data Anggota</h3>
        <a href="create.php" class="btn btn-primary">+ Tambah Anggota</a>
    </div>
    <?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?php echo htmlspecialchars($_GET['success']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?php echo htmlspecialchars($_GET['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Dashboard statistik -->
    <?php
    $total = $conn->query("SELECT COUNT(*) as t FROM anggota")->fetch_assoc()['t'];
    $aktif = $conn->query("SELECT COUNT(*) as t FROM anggota WHERE status='Aktif'")->fetch_assoc()['t'];
    $nonaktif = $conn->query("SELECT COUNT(*) as t FROM anggota WHERE status='Nonaktif'")->fetch_assoc()['t'];

    $laki = $conn->query("SELECT COUNT(*) as t FROM anggota WHERE jenis_kelamin='Laki-laki'")->fetch_assoc()['t'];
    $perempuan = $conn->query("SELECT COUNT(*) as t FROM anggota WHERE jenis_kelamin='Perempuan'")->fetch_assoc()['t'];
    ?>

    <div class="row mb-3">

        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body text-center">
                    <h5>Total</h5>
                    <h3><?php echo $total; ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body text-center">
                    <h5>Aktif</h5>
                    <h3><?php echo $aktif; ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body text-center">
                    <h5>Nonaktif</h5>
                    <h3><?php echo $nonaktif; ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body text-center">
                    <h5>L / P</h5>
                    <h6><?php echo $laki; ?> Laki</h6>
                    <h6><?php echo $perempuan; ?> Perempuan</h6>
                </div>
            </div>
        </div>

    </div>
    
    
    <!-- SEARCH -->
    <div class="card mb-3">
        <div class="card-body">
            <form method="GET">
                <div class="row">

                    <!-- SEARCH -->
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari nama/email/telepon..."
                            value="<?php echo htmlspecialchars($search); ?>">
                    </div>

                    <!-- STATUS -->
                    <div class="col-md-3">
                        <select name="status" class="form-control">
                            <option value="">Semua Status</option>
                            <option value="Aktif" <?php echo (isset($_GET['status']) && $_GET['status']=='Aktif')?'selected':''; ?>>Aktif</option>
                            <option value="Nonaktif" <?php echo (isset($_GET['status']) && $_GET['status']=='Nonaktif')?'selected':''; ?>>Nonaktif</option>
                        </select>
                    </div>

                    <!-- JENIS KELAMIN -->
                    <div class="col-md-3">
                        <select name="jk" class="form-control">
                            <option value="">Semua JK</option>
                            <option value="Laki-laki" <?php echo (isset($_GET['jk']) && $_GET['jk']=='Laki-laki')?'selected':''; ?>>Laki-laki</option>
                            <option value="Perempuan" <?php echo (isset($_GET['jk']) && $_GET['jk']=='Perempuan')?'selected':''; ?>>Perempuan</option>
                        </select>
                    </div>

                    <!-- BUTTON -->
                    <div class="col-md-2">
                        <button class="btn btn-primary w-100">Cari</button>
                    </div>

                </div>

                <?php if ($search || isset($_GET['status']) || isset($_GET['jk'])): ?>
                    <a href="index.php" class="btn btn-secondary mt-2">Reset</a>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <!-- TABLE -->
    <div class="card">
        <div class="card-body">

        <?php if ($result->num_rows > 0): ?>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>JK</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            <?php 
            $no = $offset + 1;
            while ($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><?php echo $no++; ?></td>

                <!-- FOTO -->
                <td>
                    <?php if (!empty($row['foto'])): ?>
                        <img src="uploads/<?php echo $row['foto']; ?>" width="50">
                    <?php else: ?>
                        <span class="text-muted">-</span>
                    <?php endif; ?>
                </td>

                <td><?php echo htmlspecialchars($row['kode_anggota']); ?></td>
                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['telepon']); ?></td>

                <!-- JENIS KELAMIN -->
                <td>
                    <span class="badge bg-info">
                        <?php echo $row['jenis_kelamin']; ?>
                    </span>
                </td>

                <!-- STATUS -->
                <td>
                    <span class="badge <?php echo $row['status']=='Aktif' ? 'bg-success':'bg-danger'; ?>">
                        <?php echo $row['status']; ?>
                    </span>
                </td>

                <td>
                    <a href="edit.php?id=<?php echo $row['id_anggota']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete.php?id=<?php echo $row['id_anggota']; ?>" 
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>

            </tbody>
        </table>

        <!-- PAGINATION -->
        <?php if ($total_pages > 1): ?>
        <ul class="pagination justify-content-center mt-3">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php echo $page == $i ? 'active':''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&status=<?php echo $status; ?>&jk=<?php echo $jk; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
        <?php endif; ?>

        <div class="alert alert-info mt-3">
            Total: <?php echo $total_rows; ?> anggota |
            Halaman: <?php echo $page; ?> / <?php echo $total_pages; ?>
        </div>

        <?php else: ?>
            <div class="alert alert-warning">Belum ada data anggota</div>
        <?php endif; ?>

        </div>
    </div>
</div>

<?php
if (isset($stmt)) $stmt->close();
if (isset($stmt_count)) $stmt_count->close();
closeConnection();
require_once '../../../includes/footer.php';
?>