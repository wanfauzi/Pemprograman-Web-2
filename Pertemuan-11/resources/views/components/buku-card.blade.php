<div class="card h-100 shadow-sm">

    <div class="card-header text-center bg-light">
        <i class="bi bi-book-fill text-primary display-4"></i>
    </div>

    <div class="card-body">

        {{-- Kategori --}}
        <span class="badge bg-info mb-2">
            {{ $buku->kategori }}
        </span>

        {{-- Judul --}}
        <h5 class="card-title">
            {{ $buku->judul }}
        </h5>

        {{-- Pengarang --}}
        <p class="text-muted mb-2">
            <i class="bi bi-person"></i>
            {{ $buku->pengarang }}
        </p>

        {{-- Harga --}}
        <p class="mb-2">
            <strong>Harga:</strong><br>
            {{ $buku->harga_format ?? 'Rp ' . number_format($buku->harga, 0, ',', '.') }}
        </p>

        {{-- Stok --}}
        <p class="mb-2">
            <strong>Stok:</strong>
            {{ $buku->stok }}
        </p>

        {{-- Status --}}
        @if($buku->stok > 0)
            <span class="badge bg-success">
                Tersedia
            </span>
        @else
            <span class="badge bg-danger">
                Habis
            </span>
        @endif

    </div>

    @if($showActions)
    <div class="card-footer">

        <a href="{{ route('buku.show', $buku->id) }}"
           class="btn btn-primary btn-sm">

            <i class="bi bi-eye"></i>
            Detail
        </a>

        <a href="{{ route('buku.edit', $buku->id) }}"
           class="btn btn-warning btn-sm">

            <i class="bi bi-pencil"></i>
            Edit
        </a>

    </div>
    @endif

</div>