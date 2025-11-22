<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mata Kuliah</title>
    <link rel="stylesheet" href="matkulMenuAdmin.css">
    <link rel="stylesheet" href="addMatkulMenuAdmin.css">
</head>
<body>
    <?php
    include "../../Assets/Global Components/navbar.php";
    include "../../SQL/connection.php";
    include "../../Utils/gradeUtil.php";
    $user_id = $_COOKIE['user_id'];
    $kode = $_GET['kode_mk'];

    $q = $con->prepare("SELECT nim FROM mahasiswa WHERE user_id = ?");
    $q->bind_param("s", $user_id);
    $q->execute();  
    $r = $q->get_result();
    $nim = $r->fetch_assoc()['nim'];


   if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nilai  = $_POST['NILAI'];
        $grade  = getGrades($_POST['NILAI']);

    $sql = "INSERT INTO nilai (nim, kode_mk, nilai, grade) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssis",$nim, $kode, $nilai, $grade);
    $stmt->execute();

    header("Location: matkulMenuMahasiswa.php");
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
                        <label>Nama MK :</label><input type="text" name="KodeMK" value="<?= $kode ?>" readonly>
                    </div>
                    <div id="field">
                        <label>Nilai MK :</label><input type="number" name="NILAI" value="0" required>
                    </div>
                        <input type="submit" class="button" value="Submit">
                </div>
                    
            </form>
        </div>  
    </div>
</body>
</html>