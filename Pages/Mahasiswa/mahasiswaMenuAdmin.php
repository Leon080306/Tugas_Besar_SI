<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa</title>
    <link rel="icon" href="../../Assets/Icons/pageIcon.png" type="image/png">
    <link rel="stylesheet" href="mahasiswaMenuAdmin.css">
</head>
<body>
    <?php
    include "../../Assets/Global Components/navbar.php";
    include "../../SQL/connection.php";

    require_once "../../config.php";
    require_once "../../Utils/encryption.php";

    ?>
    <div id="main">
        <div id="title">
            <h1>Manajemen Mahasiswa</h1>
            <a href="addNewMahasiswa.php" class="button">Tambah Mahasiswa</a>
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
                <?php 
                $stmt = $con->prepare("SELECT m.nim, m.kode_prodi, u.nama, u.alamat, u.user_id FROM mahasiswa m JOIN users u ON u.user_id = m.user_id WHERE m.deleted_at IS NULL && u.deleted_at IS NULL ORDER BY m.nim ASC ");
                $stmt->execute();
                $result = $stmt->get_result();
                while ($line = $result->fetch_array()) {
                ?>
                <tr>
                    <td><?php echo $line["nim"]?></td>
                    <td><?php echo decryptData($line["nama"])?></td>
                    <td><?php echo $line["alamat"]?></td>
                    <td><?php echo $line["kode_prodi"]?></td>
                    <td>
                        <div id="tableActions">
                            <a class="actionIcon" href="editMahasiswa.php?user_id=<?php echo $line["user_id"]?>">
                                <img src="../../Assets/Icons/editIcon.png" alt="">
                            </a>
                            <a class="actionIcon" href="deleteMahasiswa.php?user_id=<?php echo $line["user_id"]?>" onclick="return confirm('Yakin mau hapus?');">
                                <img src="../../Assets/Icons/deleteIcon.png" alt="">
                            </a>
                        </div>
                    </td>
                </tr>
                <?php }?>
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