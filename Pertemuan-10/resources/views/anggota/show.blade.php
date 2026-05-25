@extends('layouts.app')
@section('title', 'Detail Anggota')
@section('content')

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Detail Anggota</h3>
        </div>

        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th width="200">Kode Anggota</th>
                    <td>: {{ $anggota['kode'] }}</td>
                </tr>

                <tr>
                    <th>Nama Lengkap</th>
                    <td>: {{ $anggota['nama'] }}</td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>: {{ $anggota['email'] }}</td>
                </tr>

                <tr>
                    <th>Telepon</th>
                    <td>: {{ $anggota['telepon'] }}</td>
                </tr>

                <tr>
                    <th>Alamat</th>
                    <td>: {{ $anggota['alamat'] }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>:
                        @if ($anggota['status'] == 'Aktif')
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-danger">Nonaktif</span>
                        @endif
                    </td>
                </tr>
            </table>

            <a href="/anggota" class="btn btn-secondary">Kembali ke Daftar</a>
        </div>
    </div>
</div>
@endsection