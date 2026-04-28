-- FILE: NIM_Nama_database.sql
-- DESKRIPSI: Database Perpustakaan Lengkap

-- 
-- 1. CREATE DATABASE
-- 
CREATE DATABASE perpustakaan_lengkap;
USE perpustakaan_lengkap;
-- 
-- 2. TABEL KATEGORI BUKU
--
CREATE TABLE kategori_buku (
    id_kategori INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(50) NOT NULL UNIQUE,
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- 
-- 3. TABEL PENERBIT
-- 
CREATE TABLE penerbit (
    id_penerbit INT AUTO_INCREMENT PRIMARY KEY,
    nama_penerbit VARCHAR(100) NOT NULL,
    alamat TEXT,
    telepon VARCHAR(15),
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- 
-- 4. TABEL BUKU (DENGAN RELASI)
-- 
CREATE TABLE buku (
    id_buku INT AUTO_INCREMENT PRIMARY KEY,
    kode_buku VARCHAR(20) UNIQUE NOT NULL,
    judul VARCHAR(200) NOT NULL,

    id_kategori INT,
    id_penerbit INT,

    pengarang VARCHAR(100),
    tahun_terbit INT,
    harga DECIMAL(10,2),
    stok INT DEFAULT 0,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (id_kategori) REFERENCES kategori_buku(id_kategori),
    FOREIGN KEY (id_penerbit) REFERENCES penerbit(id_penerbit)
);


-- 
-- 5. INSERT DATA KATEGORI
-- 
INSERT INTO kategori_buku (nama_kategori, deskripsi) VALUES
('Programming', 'Buku pemrograman'),
('Database', 'Buku database'),
('Web Design', 'Desain web'),
('Networking', 'Jaringan komputer'),
('AI', 'Artificial Intelligence');


-- 
-- 6. INSERT DATA PENERBIT
-- 
INSERT INTO penerbit (nama_penerbit, alamat, telepon, email) VALUES
('Informatika', 'Bandung', '0811111111', 'info@informatika.com'),
('Erlangga', 'Jakarta', '0822222222', 'info@erlangga.com'),
('Graha Ilmu', 'Yogyakarta', '0833333333', 'info@graha.com'),
('Andi', 'Yogyakarta', '0844444444', 'info@andi.com'),
('Gramedia', 'Jakarta', '0855555555', 'info@gramedia.com');


-- 
-- 7. INSERT DATA BUKU (MINIMAL 15)
-- 
INSERT INTO buku (kode_buku, judul, id_kategori, id_penerbit, pengarang, tahun_terbit, harga, stok) VALUES
('BK-001', 'Belajar PHP', 1, 1, 'Budi Raharjo', 2023, 75000, 10),
('BK-002', 'MySQL Dasar', 2, 3, 'Andi Nugroho', 2022, 90000, 5),
('BK-003', 'Laravel Advanced', 1, 1, 'Siti Aminah', 2024, 120000, 8),
('BK-004', 'Web Design Modern', 3, 4, 'Dedi Santoso', 2023, 85000, 15),
('BK-005', 'Jaringan Komputer', 4, 2, 'Rina Wijaya', 2023, 100000, 3),
('BK-006', 'Python AI', 5, 5, 'Ahmad Yani', 2024, 150000, 7),
('BK-007', 'CSS Mastery', 3, 4, 'Siti Aminah', 2022, 70000, 9),
('BK-008', 'PostgreSQL Advanced', 2, 3, 'Ahmad Yani', 2024, 110000, 6),
('BK-009', 'Machine Learning', 5, 5, 'Andi Nugroho', 2023, 130000, 4),
('BK-010', 'HTML Dasar', 3, 4, 'Dedi Santoso', 2021, 60000, 20),
('BK-011', 'JavaScript Modern', 1, 1, 'Budi Raharjo', 2023, 80000, 12),
('BK-012', 'Cyber Security', 4, 2, 'Rina Wijaya', 2024, 140000, 5),
('BK-013', 'Deep Learning', 5, 5, 'Ahmad Yani', 2024, 160000, 3),
('BK-014', 'Database Lanjut', 2, 3, 'Ahmad Yani', 2022, 95000, 7),
('BK-015', 'React JS', 1, 1, 'Siti Aminah', 2024, 125000, 10);


-- 
-- 8. QUERY JOIN
-- 

-- Menampilkan buku beserta kategori dan penerbit
SELECT 
    b.judul,
    k.nama_kategori,
    p.nama_penerbit,
    b.harga,
    b.stok
FROM buku b
JOIN kategori_buku k ON b.id_kategori = k.id_kategori
JOIN penerbit p ON b.id_penerbit = p.id_penerbit;


-- Menampilkan jumlah buku per kategori
SELECT 
    k.nama_kategori,
    COUNT(b.id_buku) AS jumlah_buku
FROM buku b
JOIN kategori_buku k ON b.id_kategori = k.id_kategori
GROUP BY k.nama_kategori;


-- Menampilkan jumlah buku per penerbit
SELECT 
    p.nama_penerbit,
    COUNT(b.id_buku) AS jumlah_buku
FROM buku b
JOIN penerbit p ON b.id_penerbit = p.id_penerbit
GROUP BY p.nama_penerbit;


-- Menampilkan detail lengkap buku
SELECT 
    b.kode_buku,
    b.judul,
    k.nama_kategori,
    p.nama_penerbit,
    b.pengarang,
    b.tahun_terbit,
    b.harga,
    b.stok
FROM buku b
JOIN kategori_buku k ON b.id_kategori = k.id_kategori
JOIN penerbit p ON b.id_penerbit = p.id_penerbit;


-- 
-- BONUS: TABEL RAK
-- 
CREATE TABLE rak (
    id_rak INT AUTO_INCREMENT PRIMARY KEY,
    nama_rak VARCHAR(50),
    lokasi VARCHAR(100)
);

-- Tambahkan relasi ke buku
ALTER TABLE buku 
ADD COLUMN id_rak INT;

ALTER TABLE buku
ADD FOREIGN KEY (id_rak) REFERENCES rak(id_rak);

-- Insert data rak
INSERT INTO rak (nama_rak, lokasi) VALUES
('Rak A', 'Lantai 1'),
('Rak B', 'Lantai 1'),
('Rak C', 'Lantai 2');

UPDATE buku SET id_rak = 1 WHERE id_buku <= 5;
UPDATE buku SET id_rak = 2 WHERE id_buku BETWEEN 6 AND 10;
UPDATE buku SET id_rak = 3 WHERE id_buku > 10;

-- Soft Delete
ALTER TABLE buku ADD is_deleted BOOLEAN DEFAULT FALSE;
ALTER TABLE kategori_buku ADD is_deleted BOOLEAN DEFAULT FALSE;
ALTER TABLE penerbit ADD is_deleted BOOLEAN DEFAULT FALSE;

-- Stored Procedure
DELIMITER //

CREATE PROCEDURE get_all_books()
BEGIN
    SELECT * FROM buku WHERE is_deleted = FALSE;
END //

DELIMITER ;