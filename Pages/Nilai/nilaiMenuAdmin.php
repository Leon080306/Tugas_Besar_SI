<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transkrip Nilai</title>
    <link rel="icon" href="../../Assets/Icons/pageIcon.png" type="image/png">
    <link rel="stylesheet" href="nilaiMenuAdmin.css">
</head>
<body>
    <?php
    include "../../Assets/Global Components/navbar.php";
    ?>
    <div id="main">
        <div id="title">
            <h1>Manajemen Nilai Mahasiswa</h1>
            <a href="" class="button">Tambah Nilai Mahasiswa</a>
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
                <!-- ======================echo <tr> ini untuk setiap prodi========================= -->
                <tr>
                    <td>[nim]</td>
                    <td>[kode mk]</td>
                    <td>[nilai]</td>
                    <td>[grade]</td>
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
    .navList:nth-child(5) {
        background-color: #2886ea;
    }
</style>
</html>