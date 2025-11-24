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
    include "../../SQL/connection.php";
    require_once "../../config.php";
    require_once "../../Utils/encryption.php";
    require_once "../../Utils/gradeUtil.php";
    ?>
    <div id="main">
        <div id="title">
            <h1>Program Studi</h1>
        </div>
        <?php
        $getProdiStmt = $con->prepare("SELECT p.kode_prodi, p.nama_prodi, p.fakultas, p.nama_ketua_prodi 
                                        FROM prodi p INNER JOIN mahasiswa m ON m.kode_prodi = p.kode_prodi
                                        WHERE m.user_id = ?;");
        $getProdiStmt->bind_param("s", $_COOKIE["user_id"]);
        $getProdiStmt->execute();
        $getProdiResult = $getProdiStmt->get_result();
        $prodi = $getProdiResult->fetch_assoc();

        ?>
        <div class="container">
            <form method="post">
                <div id="inputFields">
                    <div id="field">
                        <label>Kode Prodi :</label> 
                        <input type="text" name="kodeProdi" value="<?php echo $prodi['kode_prodi']; ?>" readonly>
                    </div>
                    <div id="field">
                        <label>Nama Prodi :</label>
                        <input type="text" name="namaProdi" value="<?php echo $prodi['nama_prodi']; ?>" readonly>
                    </div>
                    <div id="field">
                        <label>Fakultas Prodi :</label>
                        <input type="text" name="fakultasProdi" value="<?php echo $prodi['fakultas']; ?>" readonly>
                    </div>
                    <div id="field">
                        <label>Ketua Prodi :</label>
                        <input type = "text" name = "ketuaProdi" value="<?php echo $prodi['nama_ketua_prodi']; ?>" readonly>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
<style>
    .navList:nth-child(4) {
        background-color: #2886ea;
    }
    .mahasiswa {
        display: flex;
    }
</style>
</html>