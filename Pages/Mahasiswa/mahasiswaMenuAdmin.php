<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa</title>
    <link rel="icon" href="../../Assets/Icons/pageIcon.png" type="image/png">
    <link rel="stylesheet" href="mahasiswaMenu.css">
</head>
<body>
    <?php
    include "../../Assets/Global Components/navbar.php";
    ?>
    <div id="main">
        <div id="title">
            <h1>Manajemen Mahasiswa</h1>
            <a href="" class="button">Tambah Mahasiswa</a>
        </div>

        <div class="container">
            <table>
                <tr>
                    <th>NIM</th>
                    <th>Nama Lengkap</th>
                    <th>Alamat Mahasiswa</th>
                    <th>Program Studi</th>
                    <th>Aksi</th>
                </tr>
                <!-- ======================echo <tr> ini untuk setiap prodi========================= -->
                <tr>
                    <td>[NIM]</td>
                    <td>[Nama]</td>
                    <td>[Alamat]</td>
                    <td>[Prodi]</td>
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
    .navList:nth-child(2) {
        background-color: #2886ea;
    }
    .admin {
        display: flex;
    }
</style>
</html>