<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
 
class Anggota extends Model
{
    use HasFactory;
 
    /**
     * Nama tabel yang digunakan oleh model ini.
     *
     * @var string
     */
    protected $table = 'anggota';
 
    /**
     * Kolom yang dapat diisi secara mass assignment.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_anggota',
        'nama',
        'email',
        'telepon',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'pekerjaan',
        'tanggal_daftar',
        'status',
    ];
 
    /**
     * Tipe casting untuk atribut.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_daftar' => 'date',
    ];
 
    /**
     * Accessor untuk menghitung umur. 
     */
    public function getUmurAttribute(): int
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }
 
    /**
     * Accessor untuk lama menjadi anggota (dalam hari). 
     */
    public function getLamaAnggotaAttribute(): int
    {
        return Carbon::parse($this->tanggal_daftar)->diffInDays(now());
    }
 
    /**
     * Scope untuk filter anggota aktif. 
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'Aktif');
    }
 
    /**
     * Scope untuk filter berdasarkan jenis kelamin. (Bawaan Lama & Tugas 2)
     * Catatan: Karena bawaan lama dan Tugas 2 sama, satu fungsi ini sudah memenuhi kedua kebutuhan.
     */
    public function scopeJenisKelamin($query, $jenisKelamin)
    {
        return $query->where('jenis_kelamin', $jenisKelamin);
    }

    // =========================================================================
    // TAMBAHAN TUGAS 2: ACCESSORS BARU
    // =========================================================================

    /**
     * Accessor status_badge untuk Tugas 2.
     */
    public function getStatusBadgeAttribute(): string
    {
        // Menggunakan strtolower untuk menghindari error akibat perbedaan huruf kapital (Aktif vs aktif)
        $status = strtolower($this->status ?? '');

        if ($status === 'aktif') {
            return '<span class="badge bg-success">Aktif</span>';
        }
        
        return '<span class="badge bg-secondary">Nonaktif</span>';
    }

    /**
     * Accessor kategori_usia untuk Tugas 2.
     * Memanfaatkan accessor $this->umur yang sudah Anda buat di atas.
     */
    public function getKategoriUsiaAttribute(): string
    {
        $umur = $this->umur;

        if ($umur < 20) {
            return 'Remaja';
        } elseif ($umur >= 20 && $umur <= 50) {
            return 'Dewasa';
        } else {
            return 'Senior';
        }
    }

    // =========================================================================
    // TAMBAHAN TUGAS 2: SCOPES BARU
    // =========================================================================

    /**
     * Scope terdaftarBulanIni untuk Tugas 2.
     * Disesuaikan menggunakan kolom 'tanggal_daftar' dari tabel Anda.
     */
    public function scopeTerdaftarBulanIni($query)
    {
        return $query->whereMonth('tanggal_daftar', Carbon::now()->month)
                     ->whereYear('tanggal_daftar', Carbon::now()->year);
    }
}
