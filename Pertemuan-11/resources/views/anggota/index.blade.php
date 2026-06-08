@extends('layouts.app')

@section('content')

<div class="mb-4">

    <h2 class="fw-bold mb-1">
        Anggota
    </h2>

    <p class="text-muted mb-0">
        Kelola data anggota perpustakaan
    </p>

</div>

<div class="card border-0 shadow-sm">

<div class="card-body">

    <div class="table-responsive">

        <table class="table table-hover align-middle">

            <thead class="table-light">

                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th width="150">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @foreach($anggotas as $anggota)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>
                        <span class="fw-semibold">
                            {{ $anggota['kode'] }}
                        </span>
                    </td>

                    <td>{{ $anggota['nama'] }}</td>

                    <td>{{ $anggota['email'] }}</td>

                    <td>

                        @if($anggota['status'] == 'Aktif')

                            <span class="badge bg-success">
                                Aktif
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Nonaktif
                            </span>

                        @endif

                    </td>

                    <td>

                        <a href="/anggota/{{ $anggota['id'] }}"
                           class="btn btn-sm btn-primary">

                            <i class="bi bi-eye"></i>

                        </a>

                        <button class="btn btn-sm btn-warning text-white">

                            <i class="bi bi-pencil"></i>

                        </button>

                        <button class="btn btn-sm btn-danger">

                            <i class="bi bi-trash"></i>

                        </button>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

</div>

@endsection
