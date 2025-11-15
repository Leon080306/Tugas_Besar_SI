<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Studi</title>
    <link rel="icon" href="../../Assets/Icons/pageIcon.png" type="image/png">
    <link rel="stylesheet" href="prodiMenuAdmin.css">
</head>
<body>
    <?php
    include "../../Assets/Global Components/navbar.php";
    ?>
    <div id="main">
        <div id="title">
            <h1>Manajemen Program Studi</h1>
            <a href="" class="button">Tambah Prodi</a>
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
                <!-- ======================echo <tr> ini untuk setiap prodi========================= -->
                <tr>
                    <td>[Kode Prodi]</td>
                    <td>[Nama Prodi]</td>
                    <td>[Fakultas]</td>
                    <td>[Nama Ketua Prodi]</td>
                    <td>[Total mhs]</td>
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
    .navList:nth-child(3) {
        background-color: #2886ea;
    }
</style>

</html>