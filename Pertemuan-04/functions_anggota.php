
<?php
// 1. Function untuk hitung total anggota
function hitung_total_anggota($anggota_list) {
    return count($anggota_list);
    // TODO: return count
}
 
// 2. Function untuk hitung anggota aktif
function hitung_anggota_aktif($anggota_list) {
    $anggota_aktif = 0;

    foreach($anggota_list as $anggota) {
        if($anggota["status"] == "Aktif") {
        $anggota_aktif++;
        }
    }
    return $anggota_aktif;
    // TODO: hitung yang status = "Aktif"
}
 
// 3. Function untuk hitung rata-rata pinjaman
function hitung_rata_rata_pinjaman($anggota_list) {
    if(count($anggota_list) == 0) return 0;

    $total_pinjaman = 0;
    foreach ($anggota_list as $anggota) {
        $total_pinjaman += $anggota["total_pinjam"];
    }
    return $total_pinjaman / count($anggota_list);
    // TODO: hitung average total_pinjaman
}
 
// 4. Function untuk cari anggota by ID
function cari_anggota_by_id($anggota_list, $id) {
    if(count($anggota_list) == 0) return null;

    foreach($anggota_list as $anggota) {
        if($anggota["id"] == $id) {
            return $anggota; //Kembalikan data anggota
        }
    }
    return null; // Jika tidak ada yang cocok
    // TODO: return anggota atau null
}
 
// 5. Function untuk cari anggota teraktif
function cari_anggota_teraktif($anggota_list) {
    if (count($anggota_list) == 0) return null;

    $anggota_teraktif = $anggota_list[0];
    foreach ($anggota_list as $anggota) {
        if ($anggota["total_pinjam"] > $anggota_teraktif["total_pinjam"]) {
            $anggota_teraktif = $anggota;
        }
    }
    return $anggota_teraktif;
}
    // TODO: return anggota dengan total_pinjaman tertinggi
 
// 6. Function untuk filter by status
function filter_by_status($anggota_list, $status) {
    $hasil = []; //array untuk menampung anggota yang sesuai
    foreach($anggota_list as $anggota) {
        if($anggota["status"] == $status) {
            $hasil[] = $anggota;
        }
    }
    return $hasil;
    // TODO: return array anggota dengan status tertentu
}
 
// 7. Function untuk validasi email
// Menggunakan fungsi bawaan PHP
function validasi_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) 
    !== false;
}
    // TODO: return true/false
    // Cek: tidak kosong, ada @, ada .

 
// 8. Function untuk format tanggal Indonesia
function format_tanggal_indo($tanggal) {
    // Array nama bulan
    $bulan = [
        1 => "Januari",
        2 => "Februari",
        3 => "Maret",
        4 => "April",
        5 => "Mei",
        6 => "Juni",
        7 => "Juli",
        8 => "Agustus",
        9 => "September",
        10 => "Oktober",
        11 => "November",
        12 => "Desember"
    ];

    // Memisahkan tanggal ke tahun, bulan, hari
    $split = explode("-", $tanggal); // "2024-12-22" menjadi "2024", "12", "22"
    $tahun = $split[0];
    $bln = (int)$split[1]; //Konversi ke int agar bisa ambil nama bulan, supaya bisa jadi index untuk array bulan
    $hari = $split[2];
    
    // Menggabungkan format indonesia
    return $hari . " " . $bulan[$bln] . " " . $tahun;
    // TODO: ubah 2024-01-15 jadi 15 Januari 2024
}

    // Bonus
    // Function search data anggota by A-Z
function sort_anggota_by_nama($anggota_list) {
    usort($anggota_list, function($a, $b) {
        return strcmp($a["nama"], $b["nama"]);
    });
    return $anggota_list;
}


function search_anggota($anggota_list, $keyword) {
    $hasil = [];
    foreach ($anggota_list as $a) {
        if (stripos($a["nama"], $keyword) !== false) {
            $hasil[] = $a;
        }
    }
    return $hasil;
}
?>