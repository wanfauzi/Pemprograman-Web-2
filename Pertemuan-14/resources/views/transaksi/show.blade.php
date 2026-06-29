@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>
        <i class="bi bi-receipt"></i>
        Detail Transaksi
    </h1>

    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

{{-- Flash Message --}}
@if(session('success'))
    <div class="alert alert-success">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
    </div>
@endif

<!-- Notifikasi Warning Terlambat -->
@if($transaksi->status == 'Dipinjam' && $transaksi->terlambat > 0)
    <div class="alert alert-danger">
        <h5 class="alert-heading">
            <i class="bi bi-exclamation-triangle"></i>
            Buku Terlambat Dikembalikan
        </h5>

        <p class="mb-1">
            Buku ini sudah melewati batas tanggal kembali selama 
            <strong>{{ $transaksi->terlambat }} hari</strong>.
        </p>

        <p class="mb-0">
            Estimasi denda saat ini:
            <strong>
                Rp {{ number_format($transaksi->terlambat * 5000, 0, ',', '.') }}
            </strong>
        </p>
    </div>
@endif

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="bi bi-info-circle"></i>
                    Informasi Peminjaman
                </h4>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="35%">Kode Transaksi</th>
                        <td><code>{{ $transaksi->kode_transaksi }}</code></td>
                    </tr>

                    <tr>
                        <th>Nama Anggota</th>
                        <td>{{ $transaksi->anggota->nama }}</td>
                    </tr>

                    <tr>
                        <th>Kode Anggota</th>
                        <td>{{ $transaksi->anggota->kode_anggota }}</td>
                    </tr>

                    <tr>
                        <th>Judul Buku</th>
                        <td>{{ $transaksi->buku->judul }}</td>
                    </tr>

                    <tr>
                        <th>Tanggal Pinjam</th>
                        <td>{{ $transaksi->tanggal_pinjam->format('d M Y') }}</td>
                    </tr>

                    <tr>
                        <th>Batas Tanggal Kembali</th>
                        <td>{{ $transaksi->tanggal_kembali->format('d M Y') }}</td>
                    </tr>

                    <tr>
                        <th>Tanggal Dikembalikan</th>
                        <td>
                            @if($transaksi->tanggal_dikembalikan)
                                {{ $transaksi->tanggal_dikembalikan->format('d M Y') }}
                            @else
                                <span class="text-muted">Belum dikembalikan</span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>
                            @if($transaksi->status == 'Dipinjam')
                                <span class="badge bg-warning text-dark">Dipinjam</span>
                            @else
                                <span class="badge bg-success">Dikembalikan</span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>Keterlambatan</th>
                        <td>
                            @if($transaksi->terlambat > 0)
                                <span class="text-danger fw-bold">
                                    {{ $transaksi->terlambat }} hari terlambat
                                </span>
                            @else
                                <span class="text-success">Tidak terlambat</span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>Total Denda</th>
                        <td>
                            <strong class="{{ $transaksi->denda > 0 ? 'text-danger' : 'text-success' }}">
                                Rp {{ number_format($transaksi->denda, 0, ',', '.') }}
                            </strong>
                        </td>
                    </tr>

                    <tr>
                        <th>Keterangan</th>
                        <td>{{ $transaksi->keterangan ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Aksi Transaksi</h5>
            </div>

            <div class="card-body">
                @if($transaksi->status == 'Dipinjam')
                    <div class="alert alert-warning">
                        <strong>Perhatian!</strong><br>
                        Klik tombol di bawah untuk memproses pengembalian buku.
                    </div>

                    <form action="{{ route('transaksi.kembalikan', $transaksi->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin mengembalikan buku ini?')">
                        @csrf
                        @method('PUT')

                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-check-circle"></i>
                            Kembalikan Buku
                        </button>
                    </form>
                @else
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle"></i>
                        Buku sudah dikembalikan.
                    </div>
                @endif
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header bg-light">
                <h5 class="mb-0">Aturan Denda</h5>
            </div>

            <div class="card-body">
                <ul class="mb-0">
                    <li>Denda hanya dihitung jika terlambat.</li>
                    <li>Denda: <strong>Rp 5.000/hari</strong>.</li>
                    <li>Stok buku otomatis bertambah setelah dikembalikan.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection