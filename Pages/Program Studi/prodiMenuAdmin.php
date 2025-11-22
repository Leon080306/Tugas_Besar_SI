<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Studi</title>
    <link rel="icon" href="../../Assets/Icons/pageIcon.png" type="image/png">
    <link rel="stylesheet" href="prodiMenu.css">
</head>
<body>
    <?php
    include "../../Assets/Global Components/navbar.php";
    ?>
    <div id="main">
        <div id="title">
            <h1>Manajemen Program Studi</h1>
            <a href="../Program Studi/addProgramStudi.php" class="button">Tambah Prodi</a>
        </div>

        <div class="container">
            <table>
                <tr>
                    <th>Kode Prodi</th>
                    <th>Nama Prodi</th>
                    <th>Fakultas</th>
                    <th>Nama Ketua Prodi</th>
                    <th>Total Mahasiswa</th>
                    <th>Aksi</th>
                </tr>
                <?php
                include "../../SQL/connection.php";
                $result = $con->query("SELECT p.kode_prodi, p.nama_prodi, p.fakultas, p.nama_ketua_prodi,(SELECT COUNT(*) FROM mahasiswa WHERE kode_prodi = p.kode_prodi) AS total_mhs FROM prodi p;");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>". $row["kode_prodi"] ."</td>";
                    echo "<td>". $row["nama_prodi"] ."</td>";
                    echo "<td>". $row["fakultas"] ."</td>";
                    echo "<td>". $row["nama_ketua_prodi"] ."</td>";
                    echo "<td>". $row["total_mhs"] ."</td>";
                    echo "<td>
                        <div id='tableActions'>
                            <a class='actionIcon' href='editProgramStudi.php?kode_prodi=".$row["kode_prodi"]."'>
                                <img src='../../Assets/Icons/editIcon.png' alt='Edit'>
                            </a>
                            <a class='actionIcon' href='deleteProgramStudi.php?kode_prodi=".$row["kode_prodi"]."'>
                                <img src='../../Assets/Icons/deleteIcon.png' alt='Delete'>
                            </a>
                        </div>
                    </td>";
                echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
<style>
    .navList:nth-child(4) {
        background-color: #2886ea;
    }
    .admin {
        display: flex;
    }
</style>

</html>