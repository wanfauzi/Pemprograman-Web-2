<?php
 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerpustakaanController;
use App\Http\Controllers\KategoriController;
use App\Models\Buku;
use App\Models\Anggota;

// Route default
Route::get('/', function () {
    return view('welcome');
});

// Route menggunakan Controller
Route::get('/perpustakaan', [PerpustakaanController::class, 'index']);
Route::get('/buku/{id}', [PerpustakaanController::class, 'show']);
Route::get('/about', [PerpustakaanController::class, 'about']);

// Route controller kategori
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/kategori/{id}', [KategoriController::class, 'show']);
Route::get('/kategori/search/{keyword}', [KategoriController::class, 'search']);

// Route baru - return text
Route::get('/hello', function () {
    return 'Hello dari Laravel!';
});
 
// Route dengan HTML
Route::get('/info', function () {
    return '<h1>Sistem Perpustakaan</h1><p>Selamat datang!</p>';
});
 
// Route dengan JSON
Route::get('/buku', function () {
    return [
        'judul' => 'Laravel Programming',
        'pengarang' => 'John Doe',
        'harga' => 150000
    ];
});


 
// Route dengan multiple parameters
Route::get('/search/{kategori}/{keyword}', function ($kategori, $keyword) {
    return "Cari buku kategori: $kategori dengan keyword: $keyword";
});

// Named route
Route::get('/home-perpus', function () {
    return 'Halaman Perpustakaan';
})->name('perpus.home');
 
// Gunakan named route
Route::get('/test-route', function () {
    $url = route('perpus.home');
    return "URL perpustakaan: " . $url;
});

// ROUTE ANGGOTA PERPUSTAKAAN
// ===============================

// Route daftar anggota
Route::get('/anggota', function () {

    $anggota_list = [
        [
            'id' => 1,
            'kode' => 'AGT-001',
            'nama' => 'Budi Santoso',
            'email' => 'budi@email.com',
            'telepon' => '081234567890',
            'alamat' => 'Jakarta',
            'status' => 'Aktif'
        ],
        [
            'id' => 2,
            'kode' => 'AGT-002',
            'nama' => 'Siti Aminah',
            'email' => 'siti@email.com',
            'telepon' => '082345678901',
            'alamat' => 'Bandung',
            'status' => 'Aktif'
        ],
        [
            'id' => 3,
            'kode' => 'AGT-003',
            'nama' => 'Andi Saputra',
            'email' => 'andi@email.com',
            'telepon' => '083456789012',
            'alamat' => 'Surabaya',
            'status' => 'Nonaktif'
        ],
        [
            'id' => 4,
            'kode' => 'AGT-004',
            'nama' => 'Dewi Lestari',
            'email' => 'dewi@email.com',
            'telepon' => '084567890123',
            'alamat' => 'Yogyakarta',
            'status' => 'Aktif'
        ],
        [
            'id' => 5,
            'kode' => 'AGT-005',
            'nama' => 'Rina Wijaya',
            'email' => 'rina@email.com',
            'telepon' => '085678901234',
            'alamat' => 'Semarang',
            'status' => 'Aktif'
        ]
    ];

    return view('anggota.index', compact('anggota_list'));
});

// Route detail anggota
Route::get('/anggota/{id}', function ($id) {

    $anggota_list = [
        1 => [
            'id' => 1,
            'kode' => 'AGT-001',
            'nama' => 'Budi Santoso',
            'email' => 'budi@email.com',
            'telepon' => '081234567890',
            'alamat' => 'Jakarta',
            'status' => 'Aktif'
        ],
        2 => [
            'id' => 2,
            'kode' => 'AGT-002',
            'nama' => 'Siti Aminah',
            'email' => 'siti@email.com',
            'telepon' => '082345678901',
            'alamat' => 'Bandung',
            'status' => 'Aktif'
        ],
        3 => [
            'id' => 3,
            'kode' => 'AGT-003',
            'nama' => 'Andi Saputra',
            'email' => 'andi@email.com',
            'telepon' => '083456789012',
            'alamat' => 'Surabaya',
            'status' => 'Nonaktif'
        ],
        4 => [
            'id' => 4,
            'kode' => 'AGT-004',
            'nama' => 'Dewi Lestari',
            'email' => 'dewi@email.com',
            'telepon' => '084567890123',
            'alamat' => 'Yogyakarta',
            'status' => 'Aktif'
        ],
        5 => [
            'id' => 5,
            'kode' => 'AGT-005',
            'nama' => 'Rina Wijaya',
            'email' => 'rina@email.com',
            'telepon' => '085678901234',
            'alamat' => 'Semarang',
            'status' => 'Aktif'
        ]
    ];

    // Cek data anggota
    if (!isset($anggota_list[$id])) {
        abort(404, 'Anggota tidak ditemukan');
    }

    $anggota = $anggota_list[$id];

    return view('anggota.show', compact('anggota'));
});

Route::get('/test-accessor-scope', function () {

    $buku = Buku::all();
    $bukuTerbaru = Buku::terbaru()->get();
    $stokMenipis = Buku::stokMenipis()->get();

    $html = '
    <!DOCTYPE html>
    <html>
    <head>

        <title>Testing Accessor & Scope</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <style>

            body{
                background:#f5f5f5;
            }

            .card{
                border-radius:10px;
                overflow:hidden;
            }

            .card-header{
                font-weight:bold;
                font-size:20px;
            }

            table td, table th{
                vertical-align:middle;
            }

        </style>

    </head>

    <body>

    <div class="container mt-4">

        <h1 class="text-primary fw-bold mb-4">
            Testing Accessor & Scope
        </h1>

        <!-- ACCESSOR BUKU -->
        <div class="card mb-4">

            <div class="card-header bg-primary text-white">
                Accessor Buku
            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped">

                    <thead class="table-primary">
                        <tr>
                            <th>Judul</th>
                            <th>Stok</th>
                            <th>Status Stok</th>
                            <th>Tahun</th>
                        </tr>
                    </thead>

                    <tbody>
    ';

    foreach ($buku as $item) {

        $html .= "
            <tr>
                <td>{$item->judul}</td>
                <td>{$item->stok}</td>
                <td>{$item->status_stok_badge}</td>
                <td>{$item->tahun_label}</td>
            </tr>
        ";
    }

    $html .= '
                    </tbody>

                </table>

            </div>

        </div>

        <!-- BUKU TERBARU -->
        <div class="card mb-4">

            <div class="card-header bg-success text-white">
                Buku Terbaru
            </div>

            <div class="card-body">

                <ul class="list-group">
    ';

    foreach ($bukuTerbaru as $item) {

        $html .= "
            <li class='list-group-item d-flex justify-content-between align-items-center'>

                {$item->judul}

                <span class='badge bg-success'>
                    {$item->tahun_terbit}
                </span>

            </li>
        ";
    }

    $html .= '
                </ul>

            </div>

        </div>

        <!-- STOK MENIPIS -->
        <div class="card mb-4">

            <div class="card-header bg-warning">
                Buku Stok Menipis
            </div>

            <div class="card-body">

                <ul class="list-group">
    ';

    foreach ($stokMenipis as $item) {

        $html .= "
            <li class='list-group-item d-flex justify-content-between align-items-center'>

                {$item->judul}

                <span class='badge bg-danger'>
                    Stok: {$item->stok}
                </span>

            </li>
        ";
    }

    $html .= '
                </ul>

            </div>

        </div>

        <!-- ACCESSOR ANGGOTA -->
        <div class="card mb-4">

            <div class="card-header bg-info text-white">
                Accessor Anggota
            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped">

                    <thead class="table-info">
                        <tr>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Kategori Usia</th>
                        </tr>
                    </thead>

                    <tbody>
    ';

    foreach (Anggota::all() as $anggota) {

        $html .= "
            <tr>
                <td>{$anggota->nama}</td>
                <td>{$anggota->status_badge}</td>
                <td>{$anggota->kategori_usia}</td>
            </tr>
        ";
    }

    $html .= '
                    </tbody>

                </table>

            </div>

        </div>

        <!-- ANGGOTA TERDAFTAR BULAN INI -->
        <div class="card mb-4">

            <div class="card-header bg-secondary text-white">
                Anggota Terdaftar Bulan Ini
            </div>

            <div class="card-body">

                <ul class="list-group">
    ';

    foreach (Anggota::terdaftarBulanIni()->get() as $anggota) {

        $tanggal = \Carbon\Carbon::parse($anggota->tanggal_daftar)
                    ->format('d M Y');

        $html .= "
            <li class='list-group-item d-flex justify-content-between align-items-center'>

                {$anggota->nama}

                <span class='badge bg-primary'>
                    {$tanggal}
                </span>

            </li>
        ";
    }

    $html .= '
                </ul>

            </div>

        </div>

    </div>

    </body>
    </html>
    ';

    return $html;
});