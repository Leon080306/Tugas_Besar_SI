<?php
// Pastikan path ini sesuai dengan struktur folder Anda
require_once "config.php";
require_once "SQL/connection.php"; 
require_once "Utils/encryption.php"; // Wajib ada function encryptData()
require_once "Utils/uuidGenerator.php";
require_once "Utils/gradeUtil.php";

// --- KONFIGURASI ---
// Password default untuk semua user dummy
$defaultPassword = password_hash("123456", PASSWORD_BCRYPT);

echo "<h1>Mulai Proses Generate Data Dummy...</h1>";

// ==========================================
// 1. INSERT DATA PRODI (Program Studi)
// ==========================================
$dataProdi = [
    ['kode' => 'TI', 'nama' => 'Teknik Industri', 'fak' => 'Teknik', 'kaprodi' => 'Dr. Indra'],
    ['kode' => 'AK', 'nama' => 'Akuntansi', 'fak' => 'Ekonomi', 'kaprodi' => 'Ibu Sri'],
    ['kode' => 'MJ', 'nama' => 'Manajemen', 'fak' => 'Ekonomi', 'kaprodi' => 'Bapak Budi']
];

echo "<h3>[1] Insert Prodi...</h3>";
foreach ($dataProdi as $p) {
    // Cek dulu biar ga error duplicate entry
    $cek = $con->query("SELECT kode_prodi FROM prodi WHERE kode_prodi = '{$p['kode']}'");
    if ($cek->num_rows == 0) {
        $sql = "INSERT INTO prodi (kode_prodi, nama_prodi, fakultas, nama_ketua_prodi) 
                VALUES ('{$p['kode']}', '{$p['nama']}', '{$p['fak']}', '{$p['kaprodi']}')";
        if($con->query($sql)) echo "Sukses insert Prodi: {$p['nama']}<br>";
    }
}

// ==========================================
// 2. INSERT DATA MATKUL (Mata Kuliah)
// ==========================================
$dataMatkul = [
    ['kode' => 'WEB', 'nama' => 'Pemrograman Web', 'sks' => 3],
    ['kode' => 'BASDAT', 'nama' => 'Basis Data', 'sks' => 3],
    ['kode' => 'JARKOM', 'nama' => 'Jaringan Komputer', 'sks' => 2],
    ['kode' => 'STAT', 'nama' => 'Statistika', 'sks' => 2]
];

echo "<h3>[2] Insert Mata Kuliah...</h3>";
foreach ($dataMatkul as $m) {
    $cek = $con->query("SELECT kode_mk FROM matkul WHERE kode_mk = '{$m['kode']}'");
    if ($cek->num_rows == 0) {
        $sql = "INSERT INTO matkul (kode_mk, nama_mk, sks) 
                VALUES ('{$m['kode']}', '{$m['nama']}', '{$m['sks']}')";
        if($con->query($sql)) echo "Sukses insert Matkul: {$m['nama']}<br>";
    }
}

// ==========================================
// 3. INSERT ADMIN (Users + Admin)
// ==========================================
$dummyAdmins = [
    ['nik' => '999001', 'nama' => 'Admin Utama', 'alamat' => 'Kantor Pusat'],
    ['nik' => '999002', 'nama' => 'Admin Akademik', 'alamat' => 'Gedung A']
];

echo "<h3>[3] Insert Admin...</h3>";
foreach ($dummyAdmins as $adm) {
    // Cek NIK
    $cek = $con->query("SELECT nik FROM admin WHERE nik = '{$adm['nik']}'");
    if ($cek->num_rows == 0) {
        $uuid = generateUUID();
        $namaEnc = encryptData($adm['nama']); // ENKRIPSI NAMA
        
        // Insert ke tabel USERS dulu
        $sqlUser = "INSERT INTO users (user_id, nama, alamat, user_role, password) 
                    VALUES ('$uuid', '$namaEnc', '{$adm['alamat']}', 'A', '$defaultPassword')";
        
        if ($con->query($sqlUser)) {
            // Insert ke tabel ADMIN
            $sqlAdmin = "INSERT INTO admin (nik, user_id) VALUES ('{$adm['nik']}', '$uuid')";
            if($con->query($sqlAdmin)) echo "Sukses insert Admin: {$adm['nama']} (NIK: {$adm['nik']})<br>";
        }
    }
}

// ==========================================
// 4. INSERT MAHASISWA & NILAI (Users + Mhs + Nilai)
// ==========================================
$dummyMhs = [
    ['nim' => '1124101', 'nama' => 'Rizky Ramadhan', 'prodi' => 'IF', 'alamat' => 'Bandung'],
    ['nim' => '1124102', 'nama' => 'Siti Aminah', 'prodi' => 'SI', 'alamat' => 'Jakarta'],
    ['nim' => '1124103', 'nama' => 'Budi Gunawan', 'prodi' => 'TI', 'alamat' => 'Surabaya'],
    ['nim' => '1124104', 'nama' => 'Dewi Persik', 'prodi' => 'DKV', 'alamat' => 'Depok'],
    ['nim' => '1124105', 'nama' => 'Ahmad Dhani', 'prodi' => 'AK', 'alamat' => 'Malang']
];

// Ambil semua kode matkul yang ada di DB untuk dirandom
$allMatkuls = [];
$resMatkul = $con->query("SELECT kode_mk FROM matkul");
while($row = $resMatkul->fetch_assoc()) {
    $allMatkuls[] = $row['kode_mk'];
}

echo "<h3>[4] Insert Mahasiswa & Nilai...</h3>";

foreach ($dummyMhs as $mhs) {
    // Cek NIM
    $cek = $con->query("SELECT nim FROM mahasiswa WHERE nim = '{$mhs['nim']}'");
    if ($cek->num_rows == 0) {
        $uuid = generateUUID();
        $namaEnc = encryptData($mhs['nama']); // ENKRIPSI NAMA
        
        // 1. Insert User
        $sqlUser = "INSERT INTO users (user_id, nama, alamat, user_role, password) 
                    VALUES ('$uuid', '$namaEnc', '{$mhs['alamat']}', 'M', '$defaultPassword')";
        
        if ($con->query($sqlUser)) {
            // 2. Insert Mahasiswa
            // Pastikan kode prodi si mahasiswa ada di tabel prodi, jika tidak default ke IF (sesuaikan dgn data anda)
            $prodi = $mhs['prodi']; 
            
            // Cek existensi prodi, kalau dummy prodi di atas blm masuk database, fallback ke null/IF
            // Disini diasumsikan data prodi sudah masuk di tahap 1
            
            $sqlMhs = "INSERT INTO mahasiswa (nim, user_id, kode_prodi) 
                       VALUES ('{$mhs['nim']}', '$uuid', '$prodi')";
            
            if ($con->query($sqlMhs)) {
                echo "<b>Sukses insert Mahasiswa: {$mhs['nama']} ({$mhs['nim']})</b><br>";
                
                // 3. Insert Nilai (Random 3-4 matkul per mahasiswa)
                $jumlahMatkulDiambil = rand(3, count($allMatkuls));
                $matkulDiambil = array_rand(array_flip($allMatkuls), $jumlahMatkulDiambil);
                
                // Jika array_rand mengembalikan 1 value (bukan array), ubah jadi array
                if (!is_array($matkulDiambil)) $matkulDiambil = [$matkulDiambil];

                foreach ($matkulDiambil as $mk) {
                    $nilaiAngka = rand(45, 100); // Random nilai
                    $gradeHuruf = getGrades($nilaiAngka);
                    
                    // ENKRIPSI NILAI & GRADE
                    $nilaiEnc = encryptData((string)$nilaiAngka);
                    $gradeEnc = encryptData($gradeHuruf);
                    
                    $sqlNilai = "INSERT INTO nilai (nim, kode_mk, nilai, grade) 
                                 VALUES ('{$mhs['nim']}', '$mk', '$nilaiEnc', '$gradeEnc')";
                    
                    if($con->query($sqlNilai)) {
                         echo "&nbsp;&nbsp;-> Nilai $mk: $nilaiAngka ($gradeHuruf) [Terenkripsi]<br>";
                    }
                }
            } else {
                echo "Gagal insert data mahasiswa NIM {$mhs['nim']}: " . $con->error . "<br>";
            }
        } else {
            echo "Gagal insert data user: " . $con->error . "<br>";
        }
    } else {
        echo "Data NIM {$mhs['nim']} sudah ada, skip.<br>";
    }
}

echo "<br><hr><h1>SELESAI.</h1>";
?>