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
                    <th>Kode Mata Kuliah</th>
                    <th>Nilai</th>
                    <th>Grade</th>
                    <th>Aksi</th>
                </tr>
                <?php
                include "../../SQL/connection.php";
                $result = $con->query("SELECT * FROM nilai ORDER BY kode_mk,nim;");
                $currentMK = "";
                $groupIndex = "";
                while ($row = $result->fetch_assoc()) {
                    $kodeMK = $row["kode_mk"];
                    $nilai = decryptData($row["nilai"]);
                    $grade = decryptData($row["grade"]);
                    if($currentMK != $kodeMK){
                        if($currentMK != ""){
                            echo"</tbody>";
                        }

                        // update marker
                        $currentMK = $kodeMK;
                        $groupIndex++;

                        // create a unique id per group
                        $tbodyId = "tbody_{$kodeMK}_{$groupIndex}";

                        echo "<tr class='matkul' data-target='{$tbodyId}'>";
                        echo "<td>". $row["kode_mk"] ."</td>";
                        echo "<td>       </td>";
                        echo "<td>       </td>";
                        echo "<td>       </td>";
                        echo "<td>       </td>";
                        echo"</tr>";
                        $currentMK = $row["kode_mk"];
                        echo "<tbody class='nilai' id='{$tbodyId}' style='display:none;'>"; //testing
                    }
                    echo"<tr>";
                    echo"<td>". $row["nim"] ."</td>";
                    echo "<td>". $row["kode_mk"] ."</td>";
                    echo "<td>". $nilai ."</td>";
                    echo "<td>". $grade ."</td>";
                    echo "<td>";
                    echo "<div id='tableActions'>
                            <a class='actionIcon' href='editNilaiAdmin.php?nim=" . $row['nim'] . "&kode_mk=" . $row['kode_mk'] .  "&nilai=" .$row['nilai']."'>
                                <img src='../../Assets/Icons/editIcon.png' alt=''>
                            </a>
                            <a class='actionIcon' href='deleteNilai.php?nim=" . $row['nim'] . "&kode_mk=" . $row['kode_mk'] . "'>
                                <img src='../../Assets/Icons/deleteIcon.png' alt=''>
                            </a>
                        </div>";
                    echo "</td>";
                    echo"</tr>";
                }
                if ($currentMK != "") {
                    echo "</tbody>";
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
<script>
    $(document).ready(function () {
        $(".matkul").click(function () {
            let targetId = $(this).data("target");
            $("#" + targetId).slideToggle(400);
            $(this).toggleClass("opened");
        })
    })
</script>
</html>