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
            <a href="" class="button">Tambah Mata Kuliah</a>
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
                <!-- ======================echo <tr> ini untuk setiap prodi========================= -->
                <tr>
                    <td>[kode mk]</td>
                    <td>[nama mk]</td>
                    <td>[sks]</td>
                    <!-- total mhs yang mengambil matkul ini -->
                    <td>[total mhs]</td>
                    <td>
                        <div id="tableActions">
                            <a class="actionIcon" href="">
                                <img src="../../Assets/Icons/editIcon.png" alt="">
                            </a>
                            <a class="actionIcon" href="">
                                <img src="../../Assets/Icons/deleteIcon.png" alt="">
                            </a>
                        </div>
                    </td>
                </tr>
                <!-- ====================================================================================== -->
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