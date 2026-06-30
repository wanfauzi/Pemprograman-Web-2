# Dokumentasi Tugas Praktikum Perpustakaan Laravel

Dokumentasi ini berisi hasil implementasi fitur:

1. Fitur Pengembalian Buku
2. Laporan Transaksi
3. Notifikasi Buku Terlambat

---

## 1. Fitur Pengembalian Buku

Fitur ini digunakan untuk mengembalikan buku yang sedang dipinjam. Saat buku dikembalikan, sistem akan menghitung denda jika terlambat dan stok buku bertambah 1.

### Screenshot Daftar Transaksi

Menampilkan transaksi dengan status **Dipinjam** dan tombol **Kembalikan**.

![Daftar Transaksi](screenshots/01-daftar-transaksi.png)

### Screenshot Detail Transaksi dan Konfirmasi Pengembalian

Menampilkan detail transaksi, status, tanggal kembali, total denda, dan tombol **Kembalikan Buku**.

Menampilkan popup konfirmasi sebelum buku dikembalikan.

![Konfirmasi Pengembalian](screenshots/03-konfirmasi-pengembalian.png)

### Screenshot Setelah Dikembalikan

Status transaksi berubah menjadi **Dikembalikan**, tanggal dikembalikan terisi, dan stok buku bertambah.

![Setelah Dikembalikan](screenshots/04-setelah-dikembalikan.png)

### Screenshot Denda Keterlambatan

Jika buku terlambat, sistem menampilkan denda Rp 5.000 per hari.

![Denda Keterlambatan](screenshots/05-denda-keterlambatan.png)

---

## 2. Laporan Transaksi

Fitur laporan digunakan untuk menampilkan data transaksi berdasarkan filter tanggal, status, dan anggota.

### Screenshot Halaman Laporan

Menampilkan tabel transaksi, total transaksi, total denda, filter, dan tombol export PDF.

![Halaman Laporan](screenshots/06-halaman-laporan.png)

### Screenshot Filter Status

Menampilkan data transaksi berdasarkan status **Dipinjam** yang ada dibawah.

![Filter Status](screenshots/08-filter-status.png)

### Screenshot Filter Anggota

Menampilkan transaksi berdasarkan anggota tertentu.

![Filter Anggota](screenshots/09-filter-anggota.png)

### Screenshot Export PDF

Menampilkan hasil laporan transaksi yang berhasil diexport ke PDF.

![Export PDF](screenshots/10-export-pdf.png)

---

## 3. Notifikasi Terlambat

Fitur ini digunakan untuk menampilkan informasi transaksi yang sudah melewati tanggal kembali.

### Screenshot Dashboard Buku Terlambat

Menampilkan card **Buku Terlambat**, jumlah transaksi terlambat, dan list anggota terlambat.

## ![Dashboard Buku Terlambat](screenshots/11-dashboard-buku-terlambat.png)

## Kesimpulan

Berdasarkan hasil pengujian, fitur pengembalian buku, laporan transaksi, export PDF, dan notifikasi keterlambatan berhasil diimplementasikan sesuai instruksi tugas.
