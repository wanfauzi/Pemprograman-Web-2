@php
    $transaksiTerlambat = \App\Models\Transaksi::with(['anggota', 'buku'])
        ->where('status', 'Dipinjam')
        ->whereDate('tanggal_kembali', '<', today())
        ->orderBy('tanggal_kembali', 'asc')
        ->get();

    $jumlahTerlambat = $transaksiTerlambat->count();
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Perpustakaan') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Total Buku</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Buku::count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
 
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Total Anggota</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Anggota::count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
 
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Dipinjam</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Transaksi::where('status', 'Dipinjam')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
 
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Transaksi Hari Ini</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Transaksi::whereDate('created_at', today())->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Widget Buku Terlambat -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border-l-4 border-red-500">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-red-100 text-red-600 mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                                    </svg>
                                </span>
                                Buku Terlambat
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">
                                Daftar transaksi yang sudah melewati tanggal kembali dan belum dikembalikan.
                            </p>
                        </div>

                        <div class="bg-red-50 border border-red-200 rounded-lg px-5 py-3 text-center">
                            <p class="text-sm font-medium text-red-700">Jumlah Terlambat</p>
                            <p class="text-3xl font-bold text-red-600">{{ $jumlahTerlambat }}</p>
                        </div>
                    </div>

                    @if($jumlahTerlambat > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 border border-gray-200 rounded-lg">
                                <thead class="bg-red-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase tracking-wider">Anggota</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase tracking-wider">Buku</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase tracking-wider">Tanggal Kembali</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase tracking-wider">Terlambat</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase tracking-wider">Denda Sementara</th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($transaksiTerlambat as $item)
                                        @php
                                            $hariTerlambat = \Carbon\Carbon::parse($item->tanggal_kembali)
                                                ->startOfDay()
                                                ->diffInDays(today());

                                            $dendaSementara = $hariTerlambat * 5000;
                                        @endphp

                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-semibold text-gray-900">
                                                    {{ $item->anggota->nama }}
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    {{ $item->anggota->kode_anggota ?? '-' }}
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $item->buku->judul }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $item->tanggal_kembali->format('d M Y') }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Terlambat {{ $hariTerlambat }} hari
                                                </span>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-red-600">
                                                Rp {{ number_format($dendaSementara, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <p class="text-sm font-medium text-green-700">
                                    Tidak ada buku yang terlambat dikembalikan.
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
 
            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Aksi Cepat</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <a href="{{ route('buku.create') }}" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                            <svg class="h-8 w-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <span class="font-medium text-blue-900">Tambah Buku</span>
                        </a>
                        
                        <a href="{{ route('anggota.create') }}" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition">
                            <svg class="h-8 w-8 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            <span class="font-medium text-green-900">Tambah Anggota</span>
                        </a>
                        
                        <a href="{{ route('transaksi.create') }}" class="flex items-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition">
                            <svg class="h-8 w-8 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                            </svg>
                            <span class="font-medium text-yellow-900">Pinjam Buku</span>
                        </a>
                        
                        <a href="{{ route('transaksi.index') }}" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
                            <svg class="h-8 w-8 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <span class="font-medium text-purple-900">Lihat Transaksi</span>
                        </a>
                    </div>
                </div>
            </div>
 
            <!-- Recent Transactions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Transaksi Terbaru</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anggota</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse(\App\Models\Transaksi::with(['anggota', 'buku'])->latest()->take(5)->get() as $transaksi)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $transaksi->kode_transaksi }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $transaksi->anggota->nama }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $transaksi->buku->judul }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $transaksi->tanggal_pinjam->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $transaksi->status == 'Dipinjam' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                            {{ $transaksi->status }}
                                        </span>

                                        @if($transaksi->status == 'Dipinjam' && $transaksi->tanggal_kembali < today())
                                            @php
                                                $hariTerlambatRecent = \Carbon\Carbon::parse($transaksi->tanggal_kembali)
                                                    ->startOfDay()
                                                    ->diffInDays(today());
                                            @endphp

                                            <span class="mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Terlambat {{ $hariTerlambatRecent }} hari
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                        Belum ada transaksi
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>