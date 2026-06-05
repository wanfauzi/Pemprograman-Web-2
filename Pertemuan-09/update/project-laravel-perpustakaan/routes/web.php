<?php

use Illuminate\Support\Facades\Route;
use App\Models\Buku;        
use App\Models\Anggota;     

// Route tes database
Route::get('/', function () {
    return view('welcome');
});                         

// Named route
Route::get('/perpustakaan', function () {
    return 'Halaman Perpustakaan';
})->name('perpus.home');
 
// Gunakan named route
Route::get('/test-route', function () {
    $url = route('perpus.home');
    return "URL perpustakaan: " . $url;
});

Route::get('/test-accessor-scope', function () {
    $html = '
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://jsdelivr.net" rel="stylesheet">
    <div class="container mt-4">
        <h1 class="mb-4 text-primary text-center">Hasil Testing Accessor & Scope</h1>
        <hr class="mb-5">
    ';
    
    // ====================================================
    // A. TESTING MODEL BUKU
    // ====================================================
    $html .= '<div class="card mb-4 shadow-sm"><div class="card-body">';
    $html .= '<h2 class="card-title text-secondary">A. Pengujian Model Buku</h2>';

    // 1. Menampilkan Semua Buku + Accessor (status_stok_badge & tahun_label)
    $html .= '<h5 class="mt-3 text-info">1. Semua Buku (Menampilkan Accessor):</h5><ul class="list-group mb-3">';
    foreach (Buku::all() as $buku) {
        $html .= "<li class='list-group-item'><strong>{$buku->judul}</strong> | Stok: {$buku->stok} -> Status: {$buku->status_stok_badge} | Label: <span class='badge bg-dark'>{$buku->tahun_label}</span></li>";
    }
    $html .= '</ul>';

    // 2. Menampilkan Buku Terbaru menggunakan Scope terbaru()
    $html .= '<h5 class="text-info">2. Buku Terbaru (Scope Terbaru - Tahun >= 2024):</h5><ul class="list-group mb-3">';
    foreach (Buku::terbaru()->get() as $buku) {
        $html .= "<li class='list-group-item text-success'>{$buku->judul} (Tahun: {$buku->tahun_terbit})</li>";
    }
    $html .= '</ul>';

    // 3. Menampilkan Buku Stok Menipis menggunakan Scope stokMenipis()
    $html .= '<h5 class="text-info">3. Buku Stok Menipis (Scope StokMenipis - Sisa < 5):</h5><ul class="list-group mb-3">';
    foreach (Buku::stokMenipis()->get() as $buku) {
        $html .= "<li class='list-group-item text-danger'>{$buku->judul} (Sisa Stok: {$buku->stok})</li>";
    }
    $html .= '</ul>';

    // 4. Menampilkan Buku Berdasarkan Range Harga (Tambahan Lengkap)
    $html .= '<h5 class="text-info">4. Buku dengan Harga Rp 30.000 - Rp 150.000 (Scope HargaRange):</h5><ul class="list-group">';
    foreach (Buku::hargaRange(30000, 150000)->get() as $buku) {
        $html .= "<li class='list-group-item text-muted'>{$buku->judul} (Harga: {$buku->harga_format})</li>";
    }
    $html .= '</ul>';
    $html .= '</div></div>';


    // ====================================================
    // B. TESTING MODEL ANGGOTA
    // ====================================================
    $html .= '<div class="card mb-4 shadow-sm"><div class="card-body">';
    $html .= '<h2 class="card-title text-secondary">B. Pengujian Model Anggota</h2>';

    // 1. Menampilkan Semua Anggota + Accessor (status_badge & kategori_usia)
    $html .= '<h5 class="mt-3 text-info">1. Semua Anggota (Menampilkan Accessor):</h5><ul class="list-group mb-3">';
    foreach (Anggota::all() as $anggota) {
        $html .= "<li class='list-group-item'><strong>{$anggota->nama}</strong> | Status: {$anggota->status_badge} | Kategori Usia: <span class='badge bg-primary'>{$anggota->kategori_usia}</span> (Umur: {$anggota->umur} Tahun)</li>";
    }
    $html .= '</ul>';

    // 2. Menampilkan Anggota yang Terdaftar Bulan Ini menggunakan Scope terdaftarBulanIni()
    $html .= '<h5 class="text-info">2. Anggota Terdaftar Bulan Ini (Scope TerdaftarBulanIni):</h5><ul class="list-group mb-3">';
    foreach (Anggota::terdaftarBulanIni()->get() as $anggota) {
        $tanggal = \Carbon\Carbon::parse($anggota->tanggal_daftar)->format('d F Y');
        $html .= "<li class='list-group-item text-success'>{$anggota->nama} (Terdaftar pada: {$tanggal})</li>";
    }
    $html .= '</ul>';

    // 3. Menampilkan Anggota Berdasarkan Jenis Kelamin (Tambahan Lengkap)
    $html .= '<h5 class="text-info">3. Anggota Laki-laki (Scope JenisKelamin):</h5><ul class="list-group">';
    foreach (Anggota::jenisKelamin('L')->get() as $anggota) {
        $html .= "<li class='list-group-item text-dark'>{$anggota->nama} (Jenis Kelamin: {$anggota->jenis_kelamin})</li>";
    }
    $html .= '</ul>';
    $html .= '</div></div>';

    $html .= '</div>';
    return $html;
});
