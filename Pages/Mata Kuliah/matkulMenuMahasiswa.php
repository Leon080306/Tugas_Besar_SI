<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mata Kuliah</title>
    <link rel="icon" href="../../Assets/Icons/pageIcon.png" type="image/png">
    <link rel="stylesheet" href="matkulMenuAdmin.css">
</head>
<body>
    <?php
    include "../../Assets/Global Components/navbar.php";
    ?>
    <div id="main">
        <div id="title">
            <h1>Mata Kuliah</h1>
             <a href="../Mata Kuliah/addMatkulMenuMahasiswa.php" class="button">Tambah Mata Kuliah</a>
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
                include "../../SQL/connection.php";
                $user_id = $_COOKIE['user_id'];
                $sql = "SELECT mk.kode_mk, mk.nama_mk, mk.sks, n.nilai, n.grade FROM nilai n JOIN mahasiswa m ON n.nim = m.nim JOIN matkul mk ON mk.kode_mk = n.kode_mk WHERE m.user_id = ?;";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("s", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["kode_mk"] . "</td>";
                    echo "<td>" . $row["nama_mk"] . "</td>";
                    echo "<td>" . $row["sks"] . "</td>";
                    echo "<td>". $row["nilai"] . "</td>";
                    echo "<td>". $row["grade"] . "</td>";
                    echo "</tr>";
                }
                ?>

        </div>
    </div>
</body>
<style>
    .navList:nth-child(5) {
        background-color: #2886ea;
    }
    .mahasiswa {
        display: flex;
    }
</style>
</html>