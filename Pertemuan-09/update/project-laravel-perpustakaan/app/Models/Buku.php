<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buku extends Model
{
    use HasFactory;
 
    /**
     * Nama tabel yang digunakan oleh model ini.
     *
     * @var string
     */
    protected $table = 'buku';
 
    /**
     * Kolom yang dapat diisi secara mass assignment.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_buku',
        'judul',
        'kategori',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'isbn',
        'harga',
        'stok',
        'deskripsi',
        'bahasa',
    ];
 
    /**
     * Tipe casting untuk atribut.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tahun_terbit' => 'integer',
        'harga' => 'decimal:2',
        'stok' => 'integer',
    ];
 
    /**
     * Accessor untuk format harga. (Bawaan Lama)
     */
    public function getHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
 
    /**
     * Accessor untuk status ketersediaan. (Bawaan Lama)
     */
    public function getTersediaAttribute(): bool
    {
        return $this->stok > 0;
    }
 
    /**
     * Scope untuk filter buku tersedia. (Bawaan Lama)
     */
    public function scopeTersedia($query)
    {
        return $query->where('stok', '>', 0);
    }
 
    /**
     * Scope untuk filter berdasarkan kategori. (Bawaan Lama)
     */
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    // =========================================================================
    // TAMBAHAN TUGAS 2: ACCESSORS BARU
    // =========================================================================

    /**
     * Accessor status_stok_badge untuk Tugas 2.
     */
    public function getStatusStokBadgeAttribute(): string
    {
        $stok = $this->stok; // Mengambil langsung dari properti casting integer

        if ($stok == 0) {
            return '<span class="badge bg-danger">Habis</span>';
        } elseif ($stok >= 1 && $stok <= 5) {
            return '<span class="badge bg-warning">Menipis</span>';
        } elseif ($stok >= 6 && $stok <= 15) {
            return '<span class="badge bg-info">Sedang</span>';
        } else {
            return '<span class="badge bg-success">Aman</span>';
        }
    }

    /**
     * Accessor tahun_label untuk Tugas 2.
     */
    public function getTahunLabelAttribute(): string
    {
        return $this->tahun_terbit >= 2024 ? 'Buku Baru' : 'Buku Lama';
    }

    // =========================================================================
    // TAMBAHAN TUGAS 2: SCOPES BARU
    // =========================================================================

    /**
     * Scope stokMenipis untuk Tugas 2.
     */
    public function scopeStokMenipis($query)
    {
        return $query->where('stok', '<', 5);
    }

    /**
     * Scope hargaRange untuk Tugas 2.
     */
    public function scopeHargaRange($query, $min, $max)
    {
        return $query->whereBetween('harga', [$min, $max]);
    }

    /**
     * Scope terbaru untuk Tugas 2.
     */
    public function scopeTerbaru($query)
    {
        return $query->where('tahun_terbit', '>=', 2024);
    }
}
