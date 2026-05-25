<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerpustakaanController;
use App\Http\Controllers\KategoriController;

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