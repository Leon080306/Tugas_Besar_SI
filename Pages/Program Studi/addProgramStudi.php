<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Studi</title>
    <link rel = "icon" href = "../../Assets/Icons/pageIcon.png" type="image/png">
    <link rel="stylesheet" href="addProdiMenuAdmin.css">
    <link rel ="stylesheet" href="prodiMenuAdmin.css">
</head>
<body>
    <?php
    include "../../Assets/Global Components/navbar.php";
    include "../../SQL/connection.php";
    
    if (isset($_POST["KodeProdi"]) && isset($_POST["NamaProdi"]) && isset($_POST["Fakultas"]) && isset($_POST["NamaKetuaProdi"]) && isset($_POST["TotalMahasiswa"])) {
        $kode = $_POST['KodeProdi'];
        $nama = $_POST['NamaProdi'];
        $fakultas = $_POST['Fakultas'];
        $nama_ketua = $_POST['NamaKetuaProdi'];
        $total_mhs  = $_POST['TotalMahasiswa'];

        $con->begin_transaction();
        try {
            $sql = "INSERT INTO prodi (kode_prodi, nama_prodi, fakultas, nama_ketua_prodi, total_mhs) VALUES (?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ssssi", $kode, $nama, $fakultas, $nama_ketua, $total_mhs);
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
                    <div id="field">
                        <label>Total Mahasiswa :</label><input type="number" min="1" name="TotalMahasiswa" placeholder="Total Mahasiswa" required>
                    </div>
                    <input type="submit" class="button" value="Submit">
                </div>
            </form>
        </div>
    </div>
</body>
</html>