<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerpustakaanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Models\Buku;
use App\Models\Anggota;

// PERTEMUAN 11
Route::get('/', function () {
    return view('home');
})->name('home');

// Custom route untuk filter kategori dan kategori
 Route::get('kategori', [BukuController::class,'index'])
    ->name('kategori.index');
Route::get('/buku/kategori/{kategori}', [BukuController::class, 'filterKategori'])
    ->name('buku.kategori');
Route::get('/buku/search', [BukuController::class, 'search'])
    ->name('buku.search');

// Bulk Delete Operations
Route::post('/buku/bulk-delete', [BukuController::class, 'bulkDelete'])
    ->name('buku.bulk-delete');

    // Export CSV
Route::get('/buku/export', [BukuController::class, 'export'])
    ->name('buku.export');

// Resource route untuk Buku
Route::resource('buku', BukuController::class);


// Resource route untuk Anggota (akan dibuat nanti)

Route::get('/anggota/search', [AnggotaController::class,'search'])
    ->name('anggota.search');

Route::get('/anggota/export', [AnggotaController::class,'export'])
    ->name('anggota.export');

Route::resource('anggota', AnggotaController::class)
    ->parameters(['anggota' => 'anggota']);
    
// Route untuk dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');


// 
//Route Menggunakan Controller
// PERTEMUAN 9
Route::get('/perpustakaan', [PerpustakaanController::class, 'index']);
Route::get('/about', [PerpustakaanController::class, 'about']);

//Route dan View untuk Anggota 
//Menggunakan route di web.php bukan controller
// Route::get('/anggota', function () {

//     $anggota_list = [
//         [
//             'id' => 1,
//             'kode' => 'AGT-001',
//             'nama' => 'Budi Santoso',
//             'email' => 'budi@email.com',
//             'telepon' => '081234567890',
//             'alamat' => 'Jakarta',
//             'status' => 'Aktif'
//         ],
//         [
//             'id' => 2,
//             'kode' => 'AGT-002',
//             'nama' => 'Siti Aminah',
//             'email' => 'siti@email.com',
//             'telepon' => '081234567891',
//             'alamat' => 'Bandung',
//             'status' => 'Aktif'
//         ],
//         [
//             'id' => 3,
//             'kode' => 'AGT-003',
//             'nama' => 'Andi Wijaya',
//             'email' => 'andi@email.com',
//             'telepon' => '081234567892',
//             'alamat' => 'Semarang',
//             'status' => 'Nonaktif'
//         ],
//         [
//             'id' => 4,
//             'kode' => 'AGT-004',
//             'nama' => 'Dewi Lestari',
//             'email' => 'dewi@email.com',
//             'telepon' => '081234567893',
//             'alamat' => 'Yogyakarta',
//             'status' => 'Aktif'
//         ],
//         [
//             'id' => 5,
//             'kode' => 'AGT-005',
//             'nama' => 'Rudi Hartono',
//             'email' => 'rudi@email.com',
//             'telepon' => '081234567894',
//             'alamat' => 'Surabaya',
//             'status' => 'Aktif'
//         ]
//     ];

//     return view('anggota.index', compact('anggota_list'));
// });

// //Route link detail anggota
// Route::get('/anggota/{id}', function ($id) {

//     $anggota_list = [
//         1 => [
//             'id' => 1,
//             'kode' => 'AGT-001',
//             'nama' => 'Budi Santoso',
//             'email' => 'budi@email.com',
//             'telepon' => '081234567890',
//             'alamat' => 'Jakarta',
//             'status' => 'Aktif'
//         ],
//         2 => [
//             'id' => 2,
//             'kode' => 'AGT-002',
//             'nama' => 'Siti Aminah',
//             'email' => 'siti@email.com',
//             'telepon' => '082345678901',
//             'alamat' => 'Bandung',
//             'status' => 'Aktif'
//         ],
//         3 => [
//             'id' => 3,
//             'kode' => 'AGT-003',
//             'nama' => 'Andi Saputra',
//             'email' => 'andi@email.com',
//             'telepon' => '083456789012',
//             'alamat' => 'Surabaya',
//             'status' => 'Nonaktif'
//         ],
//         4 => [
//             'id' => 4,
//             'kode' => 'AGT-004',
//             'nama' => 'Dewi Lestari',
//             'email' => 'dewi@email.com',
//             'telepon' => '084567890123',
//             'alamat' => 'Yogyakarta',
//             'status' => 'Aktif'
//         ],
//         5 => [
//             'id' => 5,
//             'kode' => 'AGT-005',
//             'nama' => 'Rina Wijaya',
//             'email' => 'rina@email.com',
//             'telepon' => '085678901234',
//             'alamat' => 'Semarang',
//             'status' => 'Aktif'
//         ]
//     ];

//     // Cek data anggota
//     if (!isset($anggota_list[$id])) {
//         abort(404, 'Anggota tidak ditemukan');
//     }

//     $anggota = $anggota_list[$id];

//     return view('anggota.show', compact('anggota'));
// });


// //Route kategori
// Route::get('/kategori',
//     [KategoriController::class,'index']);

// Route::get('/kategori/search',
//     [KategoriController::class,'search']);

// Route::get('/kategori/{id}',
//     [KategoriController::class,'show']);
// // PERTEMUAN 11
// Route::get('/test-accessor-scope', function () {

//     $buku = Buku::all();
//     $bukuTerbaru = Buku::terbaru()->get(); // atau bukuTerbaru() sesuai model Anda
//     $stokMenipis = Buku::stokMenipis()->get();

//     $anggota = Anggota::all();
//     $anggotaBulanIni = Anggota::terdaftarBulanIni()->get();

//     $html = '
//     <!DOCTYPE html>
//     <html lang="id">
//     <head>
//         <meta charset="UTF-8">
//         <meta name="viewport" content="width=device-width, initial-scale=1.0">
//         <title>Testing Accessor & Scope</title>

//         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

//         <style>
//             body{
//                 background:#f5f5f5;
//             }

//             .card{
//                 border-radius:12px;
//                 overflow:hidden;
//                 box-shadow:0 2px 8px rgba(0,0,0,.1);
//             }

//             .card-header{
//                 font-weight:bold;
//                 font-size:18px;
//             }

//             table td,
//             table th{
//                 vertical-align:middle;
//             }
//         </style>
//     </head>

//     <body>

//     <div class="container py-4">

//         <h1 class="text-primary fw-bold mb-4">
//             Testing Accessor & Scope
//         </h1>
//     ';

//     // =====================================
//     // ACCESSOR BUKU
//     // =====================================

//     $html .= '
//     <div class="card mb-4">
//         <div class="card-header bg-primary text-white">
//             Accessor Buku
//         </div>

//         <div class="card-body">

//             <table class="table table-bordered table-striped">

//                 <thead class="table-primary">
//                     <tr>
//                         <th>Judul Buku</th>
//                         <th>Stok</th>
//                         <th>Status Stok</th>
//                         <th>Tahun Terbit</th>
//                         <th>Status Tahun</th>
//                     </tr>
//                 </thead>

//                 <tbody>
//     ';

//     foreach ($buku as $item) {

//         $html .= "
//         <tr>
//             <td>{$item->judul}</td>
//             <td>{$item->stok}</td>
//             <td>{$item->status_stok_badge}</td>
//             <td>{$item->tahun_terbit}</td>
//             <td>{$item->tahun_label}</td>
//         </tr>
//         ";
//     }

//     $html .= '
//                 </tbody>

//             </table>

//         </div>
//     </div>
//     ';

//     // =====================================
//     // SCOPE BUKU TERBARU
//     // =====================================

//     $html .= '
//     <div class="card mb-4">

//         <div class="card-header bg-success text-white">
//             Scope Buku Terbaru (Tahun >= 2024)
//         </div>

//         <div class="card-body">

//             <table class="table table-bordered table-striped">

//                 <thead class="table-success">
//                     <tr>
//                         <th>Judul</th>
//                         <th>Tahun Terbit</th>
//                         <th>Status Tahun</th>
//                     </tr>
//                 </thead>

//                 <tbody>
//     ';

//     foreach ($bukuTerbaru as $item) {

//         $html .= "
//         <tr>
//             <td>{$item->judul}</td>
//             <td>{$item->tahun_terbit}</td>
//             <td>{$item->tahun_label}</td>
//         </tr>
//         ";
//     }

//     $html .= '
//                 </tbody>

//             </table>

//         </div>

//     </div>
//     ';

//     // =====================================
//     // SCOPE STOK MENIPIS
//     // =====================================

//     $html .= '
//     <div class="card mb-4">

//         <div class="card-header bg-warning">
//             Scope Buku Stok Menipis (Stok < 5)
//         </div>

//         <div class="card-body">

//             <table class="table table-bordered table-striped">

//                 <thead class="table-warning">
//                     <tr>
//                         <th>Judul</th>
//                         <th>Stok</th>
//                         <th>Status Stok</th>
//                     </tr>
//                 </thead>

//                 <tbody>
//     ';

//     foreach ($stokMenipis as $item) {

//         $html .= "
//         <tr>
//             <td>{$item->judul}</td>
//             <td>{$item->stok}</td>
//             <td>{$item->status_stok_badge}</td>
//         </tr>
//         ";
//     }

//     $html .= '
//                 </tbody>

//             </table>

//         </div>

//     </div>
//     ';

//     // =====================================
//     // ACCESSOR ANGGOTA
//     // =====================================

//     $html .= '
//     <div class="card mb-4">

//         <div class="card-header bg-info text-white">
//             Accessor Anggota
//         </div>

//         <div class="card-body">

//             <table class="table table-bordered table-striped">

//                 <thead class="table-info">
//                     <tr>
//                         <th>Nama</th>
//                         <th>Umur</th>
//                         <th>Kategori Usia</th>
//                         <th>Status</th>
//                         <th>Status Badge</th>
//                     </tr>
//                 </thead>

//                 <tbody>
//     ';

//     foreach ($anggota as $item) {

//         $html .= "
//         <tr>
//             <td>{$item->nama}</td>
//             <td>{$item->umur} Tahun</td>
//             <td>{$item->kategori_usia}</td>
//             <td>{$item->status}</td>
//             <td>{$item->status_badge}</td>
//         </tr>
//         ";
//     }

//     $html .= '
//                 </tbody>

//             </table>

//         </div>

//     </div>
//     ';

//     // =====================================
//     // ANGGOTA BULAN INI
//     // =====================================

//     $html .= '
//     <div class="card mb-4">

//         <div class="card-header bg-secondary text-white">
//             Scope Anggota Terdaftar Bulan Ini
//         </div>

//         <div class="card-body">

//             <table class="table table-bordered table-striped">

//                 <thead class="table-secondary">
//                     <tr>
//                         <th>Nama</th>
//                         <th>Status</th>
//                         <th>Kategori Usia</th>
//                         <th>Tanggal Daftar</th>
//                     </tr>
//                 </thead>

//                 <tbody>
//     ';

//     foreach ($anggotaBulanIni as $item) {

//         $tanggal = \Carbon\Carbon::parse($item->tanggal_daftar)
//                     ->format('d M Y');

//         $html .= "
//         <tr>
//             <td>{$item->nama}</td>
//             <td>{$item->status}</td>
//             <td>{$item->kategori_usia}</td>
//             <td>{$tanggal}</td>
//         </tr>
//         ";
//     }

//     $html .= '
//                 </tbody>

//             </table>

//         </div>

//     </div>

//     </div>

//     </body>
//     </html>
//     ';

//     return $html;
// });

// ========== TESTING BUKU ==========
// Pertemuan 10
// List all buku
// Route::get('/buku', function () {
//     $bukus = Buku::all();
    
//     $html = '<h1>Daftar Buku</h1>';
//     $html .= '<a href="/buku/create">Tambah Buku</a><br /><br />';
//     $html .= '<table border="1" cellpadding="10">';
//     $html .= '<tr>
//                 <th>ID</th>
//                 <th>Kode</th>
//                 <th>Judul</th>
//                 <th>Kategori</th>
//                 <th>Harga</th>
//                 <th>Stok</th>
//                 <th>Aksi</th>
//               </tr>';
    
//     foreach ($bukus as $buku) {
//         $html .= '<tr>';
//         $html .= '<td>' . $buku->id . '</td>';
//         $html .= '<td>' . $buku->kode_buku . '</td>';
//         $html .= '<td>' . $buku->judul . '</td>';
//         $html .= '<td>' . $buku->kategori . '</td>';
//         $html .= '<td>' . $buku->harga_format . '</td>';
//         $html .= '<td>' . $buku->stok . '</td>';
//         $html .= '<td>
//                     <a href="/buku/' . $buku->id . '">Detail</a> | 
//                     <a href="/buku/' . $buku->id . '/edit">Edit</a>
//                   </td>';
//         $html .= '</tr>';
//     }
    
//     $html .= '</table>';
    
//     return $html;
// });
 
// // Show single buku
// Route::get('/buku/{id}', function ($id) {
//     $buku = Buku::findOrFail($id);
    
//     $html = '<h1>Detail Buku</h1>';
//     $html .= '<a href="/buku">Kembali</a><br /><br />';
//     $html .= '<table border="1" cellpadding="10">';
//     $html .= '<tr><th>Field</th><th>Value</th></tr>';
//     $html .= '<tr><td>ID</td><td>' . $buku->id . '</td></tr>';
//     $html .= '<tr><td>Kode Buku</td><td>' . $buku->kode_buku . '</td></tr>';
//     $html .= '<tr><td>Judul</td><td>' . $buku->judul . '</td></tr>';
//     $html .= '<tr><td>Kategori</td><td>' . $buku->kategori . '</td></tr>';
//     $html .= '<tr><td>Pengarang</td><td>' . $buku->pengarang . '</td></tr>';
//     $html .= '<tr><td>Penerbit</td><td>' . $buku->penerbit . '</td></tr>';
//     $html .= '<tr><td>Tahun</td><td>' . $buku->tahun_terbit . '</td></tr>';
//     $html .= '<tr><td>ISBN</td><td>' . $buku->isbn . '</td></tr>';
//     $html .= '<tr><td>Harga</td><td>' . $buku->harga_format . '</td></tr>';
//     $html .= '<tr><td>Stok</td><td>' . $buku->stok . '</td></tr>';
//     $html .= '<tr><td>Tersedia?</td><td>' . ($buku->tersedia ? 'Ya' : 'Tidak') . '</td></tr>';
//     $html .= '<tr><td>Created</td><td>' . $buku->created_at . '</td></tr>';
//     $html .= '<tr><td>Updated</td><td>' . $buku->updated_at . '</td></tr>';
//     $html .= '</table>';
    
//     return $html;
// });
 
// // ========== TESTING ANGGOTA ==========
 
// // List all anggota
// Route::get('/anggota', function () {
//     $anggotas = Anggota::all();
    
//     $html = '<h1>Daftar Anggota</h1>';
//     $html .= '<table border="1" cellpadding="10">';
//     $html .= '<tr>
//                 <th>ID</th>
//                 <th>Kode</th>
//                 <th>Nama</th>
//                 <th>Email</th>
//                 <th>Umur</th>
//                 <th>Status</th>
//                 <th>Aksi</th>
//               </tr>';
    
//     foreach ($anggotas as $anggota) {
//         $html .= '<tr>';
//         $html .= '<td>' . $anggota->id . '</td>';
//         $html .= '<td>' . $anggota->kode_anggota . '</td>';
//         $html .= '<td>' . $anggota->nama . '</td>';
//         $html .= '<td>' . $anggota->email . '</td>';
//         $html .= '<td>' . $anggota->umur . ' tahun</td>';
//         $html .= '<td>' . $anggota->status . '</td>';
//         $html .= '<td><a href="/anggota/' . $anggota->id . '">Detail</a></td>';
//         $html .= '</tr>';
//     }
    
//     $html .= '</table>';
    
//     return $html;
// });
 
// // Show single anggota
// Route::get('/anggota/{id}', function ($id) {
//     $anggota = Anggota::findOrFail($id);
    
//     $html = '<h1>Detail Anggota</h1>';
//     $html .= '<a href="/anggota">Kembali</a><br /><br />';
//     $html .= '<table border="1" cellpadding="10">';
//     $html .= '<tr><th>Field</th><th>Value</th></tr>';
//     $html .= '<tr><td>Kode Anggota</td><td>' . $anggota->kode_anggota . '</td></tr>';
//     $html .= '<tr><td>Nama</td><td>' . $anggota->nama . '</td></tr>';
//     $html .= '<tr><td>Email</td><td>' . $anggota->email . '</td></tr>';
//     $html .= '<tr><td>Telepon</td><td>' . $anggota->telepon . '</td></tr>';
//     $html .= '<tr><td>Alamat</td><td>' . $anggota->alamat . '</td></tr>';
//     $html .= '<tr><td>Tanggal Lahir</td><td>' . $anggota->tanggal_lahir->format('d-m-Y') . '</td></tr>';
//     $html .= '<tr><td>Umur</td><td>' . $anggota->umur . ' tahun</td></tr>';
//     $html .= '<tr><td>Jenis Kelamin</td><td>' . $anggota->jenis_kelamin . '</td></tr>';
//     $html .= '<tr><td>Pekerjaan</td><td>' . $anggota->pekerjaan . '</td></tr>';
//     $html .= '<tr><td>Tanggal Daftar</td><td>' . $anggota->tanggal_daftar->format('d-m-Y') . '</td></tr>';
//     $html .= '<tr><td>Lama Anggota</td><td>' . $anggota->lama_anggota . ' hari</td></tr>';
//     $html .= '<tr><td>Status</td><td>' . $anggota->status . '</td></tr>';
//     $html .= '</table>';
    
//     return $html;
// });
 
// // Testing Scope & Query
// Route::get('/test-query', function () {
//     $html = '<h1>Testing Query Eloquent</h1>';
    
//     // Buku tersedia
//     $tersedia = Buku::tersedia()->get();
//     $html .= '<h3>Buku Tersedia (Stok > 0): ' . $tersedia->count() . '</h3>';
//     $html .= '<ul>';
//     foreach ($tersedia as $buku) {
//         $html .= '<li>' . $buku->judul . ' (Stok: ' . $buku->stok . ')</li>';
//     }
//     $html .= '</ul>';
    
//     // Buku Programming
//     $programming = Buku::kategori('Programming')->get();
//     $html .= '<h3>Buku Programming: ' . $programming->count() . '</h3>';
//     $html .= '<ul>';
//     foreach ($programming as $buku) {
//         $html .= '<li>' . $buku->judul . '</li>';
//     }
//     $html .= '</ul>';
    
//     // Anggota Aktif
//     $aktif = Anggota::aktif()->get();
//     $html .= '<h3>Anggota Aktif: ' . $aktif->count() . '</h3>';
//     $html .= '<ul>';
//     foreach ($aktif as $anggota) {
//         $html .= '<li>' . $anggota->nama . ' (' . $anggota->email . ')</li>';
//     }
//     $html .= '</ul>';
    
//     return $html;
// });

