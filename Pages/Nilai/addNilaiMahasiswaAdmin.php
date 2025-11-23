<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Nilai Mahasiswa</title>
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

    if (isset($_POST["NIM"]) && isset($_POST["KodeMK"]) && isset($_POST["Nilai"])) {

        $nim = $_POST['NIM'];
        $kodeMK = $_POST["KodeMK"];
        $nilaiNormal = $_POST["Nilai"];
        $nilai = encryptData($_POST["Nilai"]);
        $grade = encryptData(getGrades($nilaiNormal));

        $check = $con->query("SELECT COUNT(*) AS total 
                      FROM nilai 
                      WHERE nim = '$nim' AND kode_mk = '$kodeMK'");
        $row = $check->fetch_assoc();

        if ($row['total'] > 0) {
            echo "<script>alert('Nilai Matkul ini sudah ada!'); window.history.back();</script>";
            exit();
        }

        $con->begin_transaction();
        try {
            $query = $con->prepare("INSERT INTO nilai (nim, kode_mk, nilai, grade) VALUES (?,?,?,?);");
            $query->bind_param("ssss", $nim,$kodeMK,$nilai,$grade);
            $query->execute();
            $con->commit();
        } catch(Exception $e){
            $con->rollback();
        }


        header("Location: nilaiMenuAdmin.php");
        exit();
    }
    ?>
    <div id="main">
        <div id="title">
            <h1>Add Nilai Mahasiswa</h1>
            <a href="../Nilai/nilaiMenuAdmin.php" class="button">Return</a>
        </div>
        <div class="container">
            <form method="post">
                <div id="inputNilaiFields">
                    <div id="field">
                        <label>NIM : </label>
                        <select name="NIM">
                            <option disabled selected>NIM</option>
                            <?php
                            $result = $con->query("SELECT nim FROM mahasiswa ORDER BY nim ASC");
                            while ($row = $result->fetch_assoc()) {
                                $nim = $row["nim"];
                                echo "<option value='$nim'>$nim</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div id="field">
                        <label>Kode MK : </label>
                        <select name="KodeMK">
                            <option disabled selected>Kode Matakuliah</option>
                            <?php
                            $result = $con->query("SELECT kode_mk, nama_mk FROM matkul ORDER BY kode_mk ASC");
                            while ($row = $result->fetch_assoc()) {
                                $kodeMK = $row["kode_mk"];
                                $namaMK = $row["nama_mk"];
                                echo "<option value='$kodeMK'>$namaMK</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div id="field">
                        <label>Nilai :</label><input type="number" min="0" max="100" name="Nilai" placeholder="Nilai" required>
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