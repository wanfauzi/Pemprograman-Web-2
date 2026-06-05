<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataKategori = [
            [
                'nama_kategori' => 'Programming',
                'deskripsi' => 'Kategori seputar pengembangan perangkat lunak dan coding.',
                'icon' => 'code-slash',
                'warna' => 'primary',
            ],
            [
                'nama_kategori' => 'Database',
                'deskripsi' => 'Kategori seputar pengelolaan, perancangan, dan optimasi basis data.',
                'icon' => 'database',
                'warna' => 'success',
            ],
            [
                'nama_kategori' => 'Web Design',
                'deskripsi' => 'Kategori seputar desain antarmuka, UX/UI, dan estetika web.',
                'icon' => 'palette',
                'warna' => 'info',
            ],
            [
                'nama_kategori' => 'Networking',
                'deskripsi' => 'Kategori seputar jaringan komputer, keamanan, dan infrastruktur.',
                'icon' => 'wifi',
                'warna' => 'warning',
            ],
            [
                'nama_kategori' => 'Data Science',
                'deskripsi' => 'Kategori seputar analisis data, machine learning, dan statistik.',
                'icon' => 'graph-up',
                'warna' => 'danger',
            ],
        ];

        foreach ($dataKategori as $kategori) {
            Kategori::create($kategori);
        }
    }
}
