<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Nilai</title>
    <link rel="icon" href="../../Assets/Icons/pageIcon.png" type="image/png">
    <link rel="stylesheet" href="nilaiMenu.css">
    <link rel="stylesheet" href="addNilaiAdmin.css">
</head>
<body>
    <?php
    include "../../Assets/Global Components/navbar.php";
    require_once "../../SQL/connection.php";
    include "../../Utils/gradeUtil.php";

    //untuk encrypt dan decrypt data
    require_once "../../config.php";
    require_once "../../Utils/encryption.php";

    $nim = $_GET['nim'];
    $kodeMK = $_GET['kode_mk'];
    $nilai = decryptData($_GET['nilai']);

    if(isset($_POST["nilai"])){
        $nilaiNormal = $_POST["nilai"];
        $nilaiEncrypt = encryptData($nilaiNormal);
        $grade = encryptData(getGrades($nilaiNormal));

        $con->begin_transaction();
        try {
        $query=$con->prepare("UPDATE nilai SET nilai = ?, grade = ? WHERE nim = ? AND kode_mk = ?;");
        $query->bind_param("ssss", $nilaiEncrypt, $grade, $nim, $kodeMK);
        $query->execute();
        $con->commit();
        } catch(Exception $e) {
            $con->rollback();
        }

        header("Location: nilaiMenuAdmin.php");
        exit();
    }
    ?>
    <div id="main">
        <div id="title">
            <h1>Edit Nilai Mahasiswa</h1>
            <a href="../Nilai/nilaiMenuAdmin.php" class="button">Return</a>
        </div>
        <div class="container">
            <form method="post">
                <div id="inputNilaiFields">
                    <div id="field">
                        <label>Kode MK :</label> <input type="text" name="NIM" value="<?= $nim ?>" readonly>
                    </div>
                    <div id="field">
                        <label>Kode MK :</label> <input type="text" name="KodeMK" value="<?= $kodeMK ?>" readonly>
                    </div>
                    <div id="field">
                        <label>Nilai :</label><input type="number" min="0" max="100" name="nilai" placeholder="<?= $nilai ?>" required>
                    </div>
                    <input type="submit" class="button" value="Submit">
                </div>
            </form>
        </div>
    </div>
</body>
<style>
    .navList:nth-child(5) {
        background-color: #2886ea;
    }
    .admin {
        display: flex;
    }
</style>
</html>