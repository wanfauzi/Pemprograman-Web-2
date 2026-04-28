-- =========================================
-- FILE: query_tugas.sql
-- DESKRIPSI: Kumpulan query database perpustakaan
-- =========================================


-- 
-- 1. STATISTIK BUKU
-- 

-- Menghitung total jumlah seluruh buku dalam tabel
SELECT COUNT(*) AS total_buku 
FROM buku;

-- Menghitung total nilai inventaris (harga dikali stok semua buku)
SELECT SUM(harga * stok) AS total_inventaris 
FROM buku;

-- Menghitung rata-rata harga dari semua buku
SELECT AVG(harga) AS rata_rata_harga 
FROM buku;

-- Menampilkan buku dengan harga paling mahal
SELECT judul, harga 
FROM buku 
ORDER BY harga DESC 
LIMIT 1;

-- Menampilkan buku dengan jumlah stok terbanyak
SELECT judul, stok 
FROM buku 
ORDER BY stok DESC 
LIMIT 1;


-- 
-- 2. FILTER DAN PENCARIAN
-- 

-- Menampilkan buku kategori Programming dengan harga kurang dari 100.000
SELECT * 
FROM buku 
WHERE kategori = 'Programming' 
AND harga < 100000;

-- Menampilkan buku yang judulnya mengandung kata "PHP" atau "MySQL"
SELECT * 
FROM buku 
WHERE judul LIKE '%PHP%' 
OR judul LIKE '%MySQL%';

-- Menampilkan buku yang diterbitkan pada tahun 2024
SELECT * 
FROM buku 
WHERE tahun_terbit = 2024;

-- Menampilkan buku dengan stok antara 5 sampai 10
SELECT * 
FROM buku 
WHERE stok BETWEEN 5 AND 10;

-- Menampilkan buku dengan pengarang "Budi Raharjo"
SELECT * 
FROM buku 
WHERE pengarang = 'Budi Raharjo';


-- 
-- 3. GROUPING DAN AGREGASI
--

-- Menampilkan jumlah buku dan total stok berdasarkan kategori
SELECT 
    kategori,
    COUNT(*) AS jumlah_buku,
    SUM(stok) AS total_stok
FROM buku
GROUP BY kategori;

-- Menampilkan rata-rata harga buku berdasarkan kategori
SELECT 
    kategori,
    AVG(harga) AS rata_rata_harga
FROM buku
GROUP BY kategori;

-- Menampilkan kategori dengan total nilai inventaris terbesar
SELECT 
    kategori,
    SUM(harga * stok) AS total_inventaris
FROM buku
GROUP BY kategori
ORDER BY total_inventaris DESC
LIMIT 1;


-- 
-- 4. UPDATE DATA
-- 

-- Menaikkan harga semua buku kategori Programming sebesar 5%
UPDATE buku
SET harga = harga * 1.05
WHERE kategori = 'Programming';

-- Menambahkan stok sebanyak 10 untuk semua buku yang stoknya kurang dari 5
UPDATE buku
SET stok = stok + 10
WHERE stok < 5;


-- 
-- 5. LAPORAN KHUSUS
-- 
-- Menampilkan daftar buku yang perlu dilakukan restocking (stok kurang dari 5)
SELECT * 
FROM buku 
WHERE stok < 5;

-- Menampilkan 5 buku dengan harga paling mahal
SELECT * 
FROM buku 
ORDER BY harga DESC 
LIMIT 5;