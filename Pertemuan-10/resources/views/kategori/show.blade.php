@extends('layouts.app')
@section('title', 'Detail Kategori Buku')
@section('content')


<div class="container mt-5">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/kategori">Kategori</a>
            </li>

            <li class="breadcrumb-item active">
                {{ $kategori['nama'] }}
            </li>
        </ol>
    </nav>


    <!-- Card Detail -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">
                {{ $kategori['nama'] }}
            </h3>
        </div>

        <div class="card-body">
            <p>
                <strong>Deskripsi:</strong>
                {{ $kategori['deskripsi'] }}
            </p>

            <p>
                <strong>Jumlah Buku:</strong>
                {{ $kategori['jumlah_buku'] }}
            </p>

        </div>
    </div>


    <!-- Tabel Buku -->
    <div class="card">
        <div class="card-header">
            Daftar Buku
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Pengarang</th>
                        <th>Tahun</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($buku_list as $index => $buku)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $buku['judul'] }}</td>
                        <td>{{ $buku['pengarang'] }}</td>
                        <td>{{ $buku['tahun'] }}</td>
                    </tr>

                    @endforeach

                </tbody>
            </table>

            <a href="/kategori" class="btn btn-secondary">
                Kembali
            </a>

        </div>
    </div>
</div>
@endsection