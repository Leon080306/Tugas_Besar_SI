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
            <h1>Manajemen Mata Kuliah</h1>
            <a href="../Mata Kuliah/addMenuMatkul.php" class="button">Tambah Mata Kuliah</a>
        </div>

        <div class="container">
            <table>
                <tr>
                    <th>Kode-MK</th>
                    <th>Nama Mata Kuliah</th>
                    <th>Jumlah SKS</th>
                    <th>Total Mahasiwa</th>
                    <th>Aksi</th>
                </tr>
                <?php
                    include "../../SQL/connection.php";
                    $sql = "SELECT m.kode_mk, m.nama_mk, m.sks ,(SELECT COUNT(*) FROM nilai WHERE kode_mk = m.kode_mk) AS total_mhs FROM matkul m;";
                    $result = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>". $row["kode_mk"] ."</td>";
                        echo "<td>". $row["nama_mk"] ."</td>";
                        echo "<td>". $row["sks"] ."</td>";
                        echo "<td>". $row["total_mhs"]."</td>";
                        echo "<td>
                                <div id='tableActions'>
                                    <a class='actionIcon' href='editMatkul.php?kode_mk=" . $row['kode_mk'] . "'>
                                        <img src='../../Assets/Icons/editIcon.png' alt=''>
                                    </a>
                                    <a class='actionIcon' href='deleteMatkul.php?kode_mk=" . $row['kode_mk'] . "'
                                        onclick=\"return confirm('delete " . $row['kode_mk'] . "?');\"> 
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
</style>
</html>