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
    include "../../SQL/connection.php";
    require_once "../../config.php";
    require_once "../../Utils/encryption.php";
    require_once "../../Utils/gradeUtil.php";

    $getNimStmt = $con->prepare("SELECT nim FROM mahasiswa WHERE user_id = ?");
    $getNimStmt->bind_param("s", $_COOKIE["user_id"]);
    $getNimStmt->execute();
    $getNimResult = $getNimStmt->get_result();
    $getNimResult = $getNimResult->fetch_assoc();
    $nim = $getNimResult["nim"];
    ?>
    <div id="main">
        <div id="title">
            <h1>Transkrip Nilai (IPS: <?php echo hitungIP($nim) ?>)</h1>
        </div>
        <div class="container">
            <table>
                <tr>
                    <th>Kode-MK</th>
                    <th>Nama Mata Kuliah</th>
                    <th>Jumlah SKS</th>
                    <th>Nilai</th>
                    <th>Grade</th>
                </tr>
                <?php


                $getMatkulStmt = $con->prepare("SELECT m.kode_mk, m.nama_mk, m.sks, n.nilai, n.grade 
                                        FROM matkul m INNER JOIN nilai n ON n.kode_mk = m.kode_mk
                                        WHERE n.nim = ?;");
                $getMatkulStmt->bind_param("s", $nim);
                $getMatkulStmt->execute();
                $getMatkulResult = $getMatkulStmt->get_result();
                while ($row = $getMatkulResult->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["kode_mk"] . "</td>
                        <td>" . $row["nama_mk"] . "</td>
                        <td>" . $row["sks"] . "</td>
                        <td>" . decryptData($row["nilai"]) . "</td>
                        <td>" . decryptData($row["grade"]) . "</td>
                    </tr>";
                }
                ?>
                <!-- <tr>
                    <td>[Kode MK]</td>
                    <td>[Nama MK]</td>
                    <td>[SKS MK]</td>
                    <td>[Nilai MK]</td>
                    <td>[Grade MK]</td>
                </tr> -->
            </table>
        </div>
    </div>
</body>
<style>
    .navList:nth-child(6) {
        background-color: #2886ea;
    }

    .mahasiswa {
        display: flex;
    }

    th:nth-last-child(1) {
        text-align: start;
    }
</style>

</html>