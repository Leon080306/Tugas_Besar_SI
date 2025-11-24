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

    $getNimStmt = $con->prepare("SELECT m.nim, u.nama FROM mahasiswa m INNER JOIN users u ON u.user_id = m.user_id WHERE u.user_id = ?");
    $getNimStmt->bind_param("s", $_GET["user_id"]);
    $getNimStmt->execute();
    $getNimResult = $getNimStmt->get_result();
    $getNimResult = $getNimResult->fetch_assoc();
    $nim = $getNimResult["nim"];
    $nama = decryptData($getNimResult["nama"]);
    ?>
    <div id="main">
        <div id="title">
            <h1>Transkrip Nilai <?php echo $nama; ?> (IPS: <?php echo hitungIP($nim) ?>)</h1>
            <a href="../Nilai/" class="button">Return</a>
        </div>
        <div class="container">
            <table>
                <tr>
                    <th>Kode-MK</th>
                    <th>Nama Mata Kuliah</th>
                    <th>Jumlah SKS</th>
                    <th>Nilai</th>
                    <th>Grade</th>
                    <th>Action</th>
                </tr>
                <?php
                $getMatkulStmt = $con->prepare("SELECT n.nim, m.kode_mk, m.nama_mk, m.sks, n.nilai, n.grade 
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
                        <td>
                            <div id='tableActions'>
                                <a class='actionIcon' href='editNilaiAdmin.php?nim=" . $row['nim'] . "&kode_mk=" . $row['kode_mk'] .  "&nilai=" .$row['nilai']."'>
                                    <img src='../../Assets/Icons/editIcon.png' alt=''>
                                </a>
                                <a class='actionIcon' href='deleteNilai.php?nim=" . $row['nim'] . "&kode_mk=" . $row['kode_mk'] . "'>
                                    <img src='../../Assets/Icons/deleteIcon.png' alt=''>
                                </a>
                            </div
                        </td>
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

    th:nth-last-child(1) {
        text-align: start;
    }
</style>

</html>