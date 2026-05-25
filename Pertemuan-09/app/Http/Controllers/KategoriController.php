<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Method daftar kategori
    public function index()
    {
        $kategori_list = [
            [
                'id' => 1,
                'nama' => 'Programming',
                'deskripsi' => 'Buku pemrograman dan coding',
                'jumlah_buku' => 25
            ],
            [
                'id' => 2,
                'nama' => 'Database',
                'deskripsi' => 'Buku database dan SQL',
                'jumlah_buku' => 18
            ],
            [
                'id' => 3,
                'nama' => 'Web Design',
                'deskripsi' => 'Buku UI/UX dan desain web',
                'jumlah_buku' => 12
            ],
            [
                'id' => 4,
                'nama' => 'Networking',
                'deskripsi' => 'Buku jaringan komputer',
                'jumlah_buku' => 15
            ],
            [
                'id' => 5,
                'nama' => 'Artificial Intelligence',
                'deskripsi' => 'Buku AI dan machine learning',
                'jumlah_buku' => 10
            ]
        ];

        return view('kategori.index', compact('kategori_list'));
    }


    // Method detail kategori
    public function show($id)
    {
        $kategori_data = [
            1 => [
                'id' => 1,
                'nama' => 'Programming',
                'deskripsi' => 'Buku pemrograman dan coding',
                'jumlah_buku' => 25
            ],
            2 => [
                'id' => 2,
                'nama' => 'Database',
                'deskripsi' => 'Buku database dan SQL',
                'jumlah_buku' => 18
            ],
            3 => [
                'id' => 3,
                'nama' => 'Web Design',
                'deskripsi' => 'Buku UI/UX dan desain web',
                'jumlah_buku' => 12
            ]
        ];

        if (!isset($kategori_data[$id])) {
            abort(404, 'Kategori tidak ditemukan');
        }

        $kategori = $kategori_data[$id];
        $buku_list = [
            [
                'judul' => 'Belajar Laravel',
                'pengarang' => 'Budi Raharjo',
                'tahun' => 2023
            ],
            [
                'judul' => 'PHP Modern',
                'pengarang' => 'Andi Nugroho',
                'tahun' => 2024
            ],
            [
                'judul' => 'Mastering Web',
                'pengarang' => 'Rina Wijaya',
                'tahun' => 2022
            ]
        ];

        return view('kategori.show', compact('kategori', 'buku_list'));
    }


    // Method search kategori
    public function search($keyword)
    {
        $kategori_list = [
            [
                'id' => 1,
                'nama' => 'Programming',
                'deskripsi' => 'Buku pemrograman dan coding',
                'jumlah_buku' => 25
            ],
            [
                'id' => 2,
                'nama' => 'Database',
                'deskripsi' => 'Buku database dan SQL',
                'jumlah_buku' => 18
            ],
            [
                'id' => 3,
                'nama' => 'Web Design',
                'deskripsi' => 'Buku UI/UX dan desain web',
                'jumlah_buku' => 12
            ]
        ];

        $hasil = [];

        foreach ($kategori_list as $kategori) {
            if (
                str_contains(
                    strtolower($kategori['nama']),
                    strtolower($keyword)
                )
            ) {
                $hasil[] = $kategori;
            }
        }

        return view('kategori.search', compact('hasil', 'keyword'));
    }
}