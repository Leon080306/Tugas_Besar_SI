<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transkrip Nilai</title>
    <link rel="icon" href="../../Assets/Icons/pageIcon.png" type="image/png">
    <link rel="stylesheet" href="nilaiMenu.css">
    <script src="../../Assets/Library/jquery.js"></script>
</head>

<body>
    <?php
    include "../../Assets/Global Components/navbar.php";

    //untuk encrypt dan decrypt data
    require_once "../../config.php";
    require_once "../../Utils/encryption.php";
    require_once "../../SQL/connection.php";
    require_once "../../Utils/gradeUtil.php";
    ?>
    <div id="main">
        <div id="title">
            <h1>Manajemen Nilai Mahasiswa</h1>
            <a href="../Nilai/addNilaiMahasiswaAdmin.php" class="button">Tambah Nilai Mahasiswa</a>
        </div>

        <div class="container">
            <table>
                <tr>
                    <th>NIM Mahasiswa</th>
                    <th>Nama Mahasiswa</th>
                    <th>Prodi Mahasiswa</th>
                    <th>IPS</th>
                </tr>
                <?php
                $getMhs = $con->query("SELECT u.user_id, m.nim, u.nama, p.nama_prodi
                    FROM mahasiswa m 
                    INNER JOIN users u ON m.user_id = u.user_id
                    INNER JOIN prodi p ON p.kode_prodi = m.kode_prodi
                    WHERE m.nim IN (SELECT nim FROM nilai)");
                while ($row = $getMhs->fetch_assoc()) {
                    $mhsID = $row["user_id"];
                    echo "<tr style='cursor:pointer;' onclick=\"window.location='viewTranskripNilai.php?user_id=$mhsID'\">
                        <td>" . $row["nim"] . "</td>
                        <td>" . decryptData($row["nama"]) . "</td>
                        <td>" . $row["nama_prodi"] . "</td>
                        <td>" . hitungIP($row["nim"]) . "</td>
                    </tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
<style>
    .navList:nth-child(6) {
        background-color: #2886ea;
    }

    .admin {
        display: flex;
    }
</style>

</html>