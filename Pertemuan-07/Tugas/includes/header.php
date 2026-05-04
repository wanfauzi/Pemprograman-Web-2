<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <title><?php echo isset($page_title) ? $page_title : 'Perpustakaan'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            min-height : 100vh;
            display : flex;
            flex-direction: column;
        }
        main {
            flex: 1;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbark-dark bg-primary">
        <div class="container-fluid">
            <a href="/perpustakaan/" class="navbar-brand">
                <i class="bi bi-book"></i> Sistem Perpustakaan
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id= "navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/perpustakaan/" class="nav-link">
                            <i class="bi bi-house"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/perpustakaan/pertemuan-07/tugas/modules/anggota/index.php">
                            <i class="bi bi-person"></i> Data Anggota
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <main class = "py-4">
</body>
</html>