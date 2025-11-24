<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Studi</title>
    <link rel="stylesheet" href="prodiMenu.css">
    <link rel="stylesheet" href="addProdiMenuAdmin.css">
    <link rel = "icon" href = "../../Assets/Icons/pageIcon.png" type="image/png">
</head>
<body>
    <?php
    include "../../Assets/Global Components/navbar.php";
    include "../../SQL/connection.php";

    $kode = $_GET['kode_prodi'];
    $sql = "SELECT * FROM prodi WHERE kode_prodi = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $kode);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if(isset($_POST["NamaProdi"]) && isset($_POST["Fakultas"]) && isset($_POST["NamaKetuaProdi"])){
        $nama = $_POST['NamaProdi'];
        $fakultas = $_POST['Fakultas'];
        $nama_ketua = $_POST['NamaKetuaProdi'];

        $con->begin_transaction();
        try {
            $update = "UPDATE prodi SET nama_prodi = ?, fakultas = ?, nama_ketua_prodi = ? WHERE kode_prodi = ?";
            $stmt = $con->prepare($update);
            $stmt->bind_param("ssss", $nama, $fakultas, $nama_ketua, $kode);
            $stmt->execute();
            $con->commit();
        } catch (Exception $e) {
            $con->rollback();
        }

        header("Location: prodiMenuAdmin.php");
        exit();
    }
    ?>
    <div id="main">
        <div id="title">
            <h1>Edit Program Studi</h1>
            <a href="../Program Studi/prodiMenuAdmin.php" class="button">Return</a>
        </div>
        <div class="container">
            <form method="post">
                <div id="inputMatkulFields">
                    <div id="field">
                        <label>Kode Prodi :</label> <input type="text" name="KodeProdi" value="<?= $data['kode_prodi'] ?>" readonly>
                    </div>
                    <div id="field">
                        <label>Nama Prodi :</label><input type="text" name="NamaProdi" value="<?= $data['nama_prodi'] ?>" required>
                    </div>
                    <div id = "field">
                        <label>Fakultas :</label><input type="text" name="Fakultas" value="<?= $data['fakultas'] ?>" required>
                    </div>
                    <div id="field">
                        <label>Nama Ketua Prodi :</label><input type="text" name="NamaKetuaProdi" value="<?= $data['nama_ketua_prodi'] ?>" required>
                    </div>
                </div>
                <div id="submitButtonContainer">
                    <button type="submit" class="button">Submit</button>
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