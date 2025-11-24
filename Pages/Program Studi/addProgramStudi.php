<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Studi</title>
    <link rel = "icon" href = "../../Assets/Icons/pageIcon.png" type="image/png">
    <link rel="stylesheet" href="addProdiMenuAdmin.css">
    <link rel ="stylesheet" href="prodiMenu.css">
</head>
<body>
    <?php
    include "../../Assets/Global Components/navbar.php";
    require_once "../../SQL/connection.php";
    include "../../Utils/gradeUtil.php";
    require_once "../../config.php";    
    require_once "../../Utils/encryption.php";
    
    if (isset($_POST["KodeProdi"]) && isset($_POST["NamaProdi"]) && isset($_POST["Fakultas"]) && isset($_POST["NamaKetuaProdi"])) {
        $kode = $_POST['KodeProdi'];
        $nama = $_POST['NamaProdi'];
        $fakultas = $_POST['Fakultas'];
        $nama_ketua = $_POST['NamaKetuaProdi'];
        
        $con->begin_transaction();
        try {
            $sql = "INSERT INTO prodi (kode_prodi, nama_prodi, fakultas, nama_ketua_prodi) VALUES (?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ssss", $kode, $nama, $fakultas, $nama_ketua);
            $stmt->execute();
            $con->commit();
        } catch(Exception $e) {
            $con->rollback();
        }

        header("Location: prodiMenuAdmin.php");
        exit();
        
    }
    ?>
    <div id="main">
        <div id="title">
            <h1>Add Program Studi</h1>
            <a href="../Program Studi/prodiMenuAdmin.php" class="button">Return</a>
        </div>
        <div class="container">
            <form method="post">
                <div id="inputMatkulFields">
                    <div id="field">
                        <label>Kode Prodi :</label> <input type="text" name="KodeProdi" placeholder="Kode Program Studi" required>
                    </div>
                    <div id="field">
                        <label>Nama Prodi :</label><input type="text" name="NamaProdi" placeholder="Nama Program Studi" required>
                    </div>
                    <div id = "field">
                        <label>Fakultas :</label><input type="text" name="Fakultas" placeholder="Fakultas" required>
                    </div>
                    <div id="field">
                        <label>Nama Ketua Prodi :</label><input type="text" name="NamaKetuaProdi" placeholder="Nama Ketua Program Studi" required>
                    </div>
                    <input type="submit" class="button" value="Submit">
                </div>
            </form>
        </div>
    </div>
</body>
<style>
    .admin {
        display: flex;
    }
    
    .navList:nth-child(4) {
        background-color: #2886ea;
    }
</style>
</html>