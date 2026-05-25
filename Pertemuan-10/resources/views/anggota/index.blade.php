@extends('layouts.app')
@section('title', 'Daftar Kategori Buku')
@section('content')


<div class="container mt-5">

    <h2 class="mb-4 text-primary">Daftar Anggota Perpustakaan</h2>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Kode Anggota</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($anggota_list as $index => $anggota)

                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $anggota['kode'] }}</td>
                        <td>{{ $anggota['nama'] }}</td>
                        <td>{{ $anggota['email'] }}</td>
                        <td>
                            @if ($anggota['status'] == 'Aktif')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>

                        <td>
                            <a href="/anggota/{{ $anggota['id'] }}"
                               class="btn btn-primary btn-sm">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection