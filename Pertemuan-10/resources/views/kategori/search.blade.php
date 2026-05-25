@extends('layouts.app')
@section('title', 'Hasil Pencarian')
@section('content')

<div class="container mt-5">
    <h2 class="mb-4">Hasil pencarian untuk:
        <span class="text-primary">
            "{{ $keyword }}"
        </span>
    </h2>

    @if (count($hasil) > 0)
        <div class="row">
            @foreach ($hasil as $kategori)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            {{ $kategori['nama'] }}
                        </h4>

                        <p class="card-text">
                            {{ $kategori['deskripsi'] }}
                        </p>

                        <p>
                            <strong>Jumlah Buku:</strong>
                            {{ $kategori['jumlah_buku'] }}
                        </p>

                        <a href="/kategori/{{ $kategori['id'] }}"
                           class="btn btn-primary btn-sm">
                            Detail
                        </a>
                    </div>
                </div>
            </div>

            @endforeach

        </div>

    @else

        <div class="alert alert-danger">Kategori dengan keyword
            <strong>{{ $keyword }}</strong>
            tidak ditemukan.
        </div>

    @endif


    <a href="/kategori" class="btn btn-secondary mt-3">
        Kembali ke Daftar Kategori
    </a>

</div>
@endsection