<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mata Kuliah</title>
    <link rel="stylesheet" href="matkulMenuAdmin.css">
    <link rel="stylesheet" href="addMatkulMenuAdmin.css">
    <link rel="icon" href="../../Assets/Icons/pageIcon.png" type="image/png">
</head>

<body>
    <?php
    include "../../Assets/Global Components/navbar.php";
    include "../../SQL/connection.php";

    $kode = $_GET['kode_mk'];
    $sql = "SELECT * FROM matkul WHERE kode_mk = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $kode);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if (isset($_POST["NamaMK"]) && isset($_POST["SKS"])) {
        $nama = $_POST['NamaMK'];
        $sks  = $_POST['SKS'];

        $con->begin_transaction();
        try {
            $update = "UPDATE matkul SET nama_mk = ?, sks = ? WHERE kode_mk = ?";
            $stmt = $con->prepare($update);
            $stmt->bind_param("sis", $nama, $sks, $kode);
            $stmt->execute();
            $con->commit();
        } catch (Exception $e) {
            $con->rollback();
        }

        header("Location: matkulMenuAdmin.php");
        exit();
    }

    ?>
    <div id="main">
        <div id="title">
            <h1>Edit MataKuliah</h1>
            <a href="../Mata Kuliah/matkulMenuAdmin.php" class="button">Return</a>
        </div>
        <div class="container">
            <form method="post">
                <div id="inputMatkulFields">
                    <input type="hidden" name="oldKode" value="<?= $data['kode_mk'] ?>">
                    <div id="field">
                        <label>Kode MK :</label> <input type="text" name="KodeMK" value="<?= $data['kode_mk'] ?>" readonly>
                    </div>
                    <div id="field">
                        <label>Nama MK :</label><input type="text" name="NamaMK" value="<?= $data['nama_mk'] ?>" required>
                    </div>
                    <div id="field">
                        <label>Total SKS :</label><input type="number" min="1" name="SKS" value="<?= $data['sks'] ?>" required>
                    </div>
                    <input type="submit" class="button" value="Update">
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