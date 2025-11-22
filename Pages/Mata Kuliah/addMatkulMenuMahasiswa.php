<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <a href="../Mata Kuliah/matkulMenuMahasiswa.php" class="button">Return</a>
        </div>

        <div class="container">
            <table>
                <tr>
                    <th>Kode-MK</th>
                    <th>Nama Mata Kuliah</th>
                    <th>Jumlah SKS</th> 
                    <th>Aksi</th>
                </tr>
                <?php
                include "../../SQL/connection.php";
                $user_id = $_COOKIE['user_id'];
                $q = $con->prepare("SELECT nim FROM mahasiswa WHERE user_id = ?");
                $q->bind_param("s", $user_id);
                $q->execute();
                $nim = $q->get_result()->fetch_assoc()['nim'];  
                $sql = "SELECT mk.kode_mk, mk.nama_mk, mk.sks FROM matkul mk WHERE mk.kode_mk NOT IN (SELECT n.kode_mk FROM nilai n WHERE n.nim = ?);";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("s", $nim);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["kode_mk"] . "</td>";
                    echo "<td>" . $row["nama_mk"] . "</td>";
                    echo "<td>" . $row["sks"] . "</td>";
                    echo "<td>
                                <div id='tableActions'>
                                    <a class='actionIcon' href='addMatkulMahasiswa.php?kode_mk=" . $row['kode_mk'] . "'>
                                        <img src='../../Assets/Icons/addicon2.png' alt=''>
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

</html>