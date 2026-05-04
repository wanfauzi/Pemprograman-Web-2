-- Buat tabel anggota 
CREATE TABLE anggota (
    id_anggota INT AUTO_INCREMENT PRIMARY KEY,
    kode_anggota VARCHAR(20) UNIQUE NOT NULL,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telepon VARCHAR(15) NOT NULL,
    alamat TEXT NOT NULL,
    tanggal_lahir DATE NOT NULL,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL,
    pekerjaan VARCHAR(50),
    tanggal_daftar DATE NOT NULL,
    status ENUM('Aktif', 'Nonaktif') DEFAULT 'Aktif',
    foto VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- Isi data anggota, total ada 11 data

INSERT INTO anggota 
(kode_anggota, nama, email, telepon, alamat, tanggal_lahir, jenis_kelamin, pekerjaan, tanggal_daftar, status, foto) 
VALUES
('AG001', 'Budi Santoso', 'budi@gmail.com', '081234567890', 'Semarang', '2000-05-10', 'Laki-laki', 'Mahasiswa', CURDATE(), 'Aktif', ''),
('AG002', 'Siti Aminah', 'siti@gmail.com', '081234567891', 'Jakarta', '1998-08-15', 'Perempuan', 'Karyawan', CURDATE(), 'Aktif', ''),
('AG003', 'Andi Wijaya', 'andi@gmail.com', '081234567892', 'Bandung', '1995-03-20', 'Laki-laki', 'Programmer', CURDATE(), 'Nonaktif', ''),
('AG004', 'Dewi Lestari', 'dewi@gmail.com', '081234567893', 'Surabaya', '2002-01-01', 'Perempuan', 'Mahasiswa', CURDATE(), 'Aktif', ''),
('AG005', 'Rizky Pratama', 'rizky@gmail.com', '081234567894', 'Yogyakarta', '1999-07-07', 'Laki-laki', 'Desainer', CURDATE(), 'Aktif', ''),
('AG006', 'Maya Putri', 'maya@gmail.com', '081234567895', 'Medan', '2001-12-12', 'Perempuan', 'Mahasiswa', CURDATE(), 'Aktif', ''),
('AG007', 'Fajar Nugroho', 'fajar@gmail.com', '081234567896', 'Solo', '1997-09-09', 'Laki-laki', 'Wiraswasta', CURDATE(), 'Nonaktif', ''),
('AG008', 'Nina Sari', 'nina@gmail.com', '081234567897', 'Malang', '2003-06-06', 'Perempuan', 'Pelajar', CURDATE(), 'Aktif', ''),
('AG009', 'Agus Salim', 'agus@gmail.com', '081234567898', 'Bogor', '1996-11-11', 'Laki-laki', 'Guru', CURDATE(), 'Aktif', ''),
('AG010', 'Putri Ayu', 'putri@gmail.com', '081234567899', 'Bekasi', '2000-02-02', 'Perempuan', 'Mahasiswa', CURDATE(), 'Aktif', ''),
('AG011', 'Hendra Gunawan', 'hendra@gmail.com', '081234567800', 'Depok', '1994-04-04', 'Laki-laki', 'Karyawan', CURDATE(), 'Aktif', '');

-- Set foto profile default dahulu sebelum diubah
UPDATE anggota SET foto='default.png';
