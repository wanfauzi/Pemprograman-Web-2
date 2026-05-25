@extends('layouts.app')
@section('title', 'Daftar Kategori Buku')
@section('content')

<div class="container mt-5">
    <h2 class="mb-4 text-primary">
        Daftar Kategori Buku
    </h2>

    <!-- Form Search -->
    <form id="searchForm" class="mb-4">
        <div class="input-group">
            <input type="text"
                   id="keyword"
                   class="form-control"
                   placeholder="Cari kategori...">
            <button type="submit"
                    class="btn btn-primary">
                    Search
            </button>
        </div>
    </form>

    <div class="row">
        @foreach ($kategori_list as $kategori)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
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
                        Detail Kategori
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

<script>

document.getElementById('searchForm').addEventListener('submit', function(e) {
    e.preventDefault();
    let keyword = document.getElementById('keyword').value;
    window.location.href = '/kategori/search/' + keyword;
});

</script>

@endsection