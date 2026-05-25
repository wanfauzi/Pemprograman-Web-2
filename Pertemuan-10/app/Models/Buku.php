<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = [
        'kode_buku',
        'judul',
        'kategori',
        'pengarang',
        'penerbit',
        'negara_penerbit',
        'kota_penerbit',
        'tahun_terbit',
        'isbn',
        'harga',
        'stok',
        'deskripsi',
        'bahasa',
    ];

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR
    |--------------------------------------------------------------------------
    */

    // Accessor Status Stok Badge
    public function getStatusStokBadgeAttribute(): string
    {
        if ($this->stok == 0) {
            return '<span class="badge bg-danger">Habis</span>';
        } elseif ($this->stok <= 5) {
            return '<span class="badge bg-warning">Menipis</span>';
        } elseif ($this->stok <= 15) {
            return '<span class="badge bg-info">Sedang</span>';
        }

        return '<span class="badge bg-success">Aman</span>';
    }

    // Accessor Tahun Label
    public function getTahunLabelAttribute(): string
    {
        if ($this->tahun_terbit >= 2024) {
            return 'Buku Baru';
        }

        return 'Buku Lama';
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE
    |--------------------------------------------------------------------------
    */

    // Scope stok menipis
    public function scopeStokMenipis($query)
    {
        return $query->where('stok', '<', 5);
    }

    // Scope harga range
    public function scopeHargaRange($query, $min, $max)
    {
        return $query->whereBetween('harga', [$min, $max]);
    }

    // Scope buku terbaru
    public function scopeTerbaru($query)
    {
        return $query->where('tahun_terbit', '>=', 2024);
    }
}