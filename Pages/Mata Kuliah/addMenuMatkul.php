<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mata Kuliah</title>
    <link rel="icon" href="../../Assets/Icons/pageIcon.png" type="image/png">
    <link rel="stylesheet" href="matkulMenuAdmin.css">
    <link rel="stylesheet" href="addMatkulMenuAdmin.css">
</head>

<body>
    <?php
    include "../../Assets/Global Components/navbar.php";
    include "../../SQL/connection.php";

    if (isset($_POST["KodeMK"]) && isset($_POST["NamaMK"]) && isset($_POST["SKS"])) {
        $kode = $_POST['KodeMK'];
        $nama = $_POST['NamaMK'];
        $sks  = $_POST['SKS'];

        $con->begin_transaction();
        try {
            $sql = "INSERT INTO matkul (kode_mk, nama_mk, sks) VALUES (?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ssi", $kode, $nama, $sks);
            $stmt->execute();
            $con->commit();
        } catch(Exception $e) {
            $con->rollback();
        }

        header("Location: matkulMenuAdmin.php");
        exit();
    }

    ?>
    <div id="main">
        <div id="title">
            <h1>Add MataKuliah</h1>
            <a href="../Mata Kuliah/matkulMenuAdmin.php" class="button">Return</a>
        </div>
        <div class="container">
            <form method="post">
                <div id="inputMatkulFields">
                    <div id="field">
                        <label>Kode MK :</label> <input type="text" name="KodeMK" placeholder="Kode MataKuliah" required>
                    </div>
                    <div id="field">
                        <label>Nama MK :</label><input type="text" name="NamaMK" placeholder="Nama Matakuliah" required>
                    </div>
                    <div id="field">
                        <label>Total SKS :</label><input type="number" min="1" name="SKS" placeholder="SKS" required>
                    </div>
                    <input type="submit" class="button" value="Submit">
                </div>
            </form>
        </div>
    </div>
</body>

</html>