<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa</title>
    <link rel="icon" href="../../Assets/Icons/pageIcon.png" type="image/png">
    <link rel="stylesheet" href="addNewMahasiswa.css">
</head>

<body>
    <?php
    include "../../Assets/Global Components/navbar.php";
    include "../../SQL/connection.php";

    //untuk encrypt dan decrypt data
    require_once "../../config.php";
    require_once "../../Utils/encryption.php";

    //uuid generator
    require_once "../../Utils/uuidGenerator.php";

    $nim = filter_input(INPUT_POST, 'nim');
    $nama = filter_input(INPUT_POST, 'nama');
    $prodi = filter_input(INPUT_POST, 'prodi');
    $alamat = filter_input(INPUT_POST, 'alamat');
    $submit = filter_input(INPUT_POST, 'submit');

    if ($submit) {
        if ($nim && $prodi && $nama && $alamat) {
            $userID = generateUUID();
            $name_encrypted = encryptData($nama);
            $password = password_hash('123456', PASSWORD_BCRYPT);

            $con->begin_transaction();

            try {
                $sql_user = "INSERT INTO users (user_id, nama, alamat, password) VALUES (?, ?, ?, ?)";
                $stmt_user = $con->prepare($sql_user);
                $stmt_user->bind_param("ssss",  $userID, $name_encrypted, $alamat, $password);
                if (!$stmt_user->execute()) {
                    throw new Exception("Failed to insert to users");
                }
                if ($stmt_user->affected_rows !== 1) {
                    throw new Exception("Failed to insert to users");
                }

                $sql_mhs = "INSERT INTO mahasiswa (nim, user_id, kode_prodi) VALUES (?, ?, ?)";
                $stmt_mhs = $con->prepare($sql_mhs);
                $stmt_mhs->bind_param("sss", $nim, $userID, $prodi);
                if (!$stmt_mhs->execute()) {
                    throw new Exception("Failed to insert to mahasiswa");
                }
                if ($stmt_mhs->affected_rows !== 1) {
                    throw new Exception("Failed to insert to mahasiswa");
                }
                $con->commit();
                echo "<script>alert('Berhasil menambah Mahasiswa: " . $nama . "');</script>";

            } catch (Exception $e) {
                $con->rollback();
                echo "<script>console.error(" . json_encode($e->getMessage()) . ");</script>";
            }
        }
    }
    ?>
    <div id="main">
        <div id="title">
            <h1>Manajemen Mahasiswa</h1>
            <a href="mahasiswaMenuAdmin.php" class="button">Return</a>
        </div>

        <form method="post">
            <div class="container">
                <div class="container-form">
                    <table>
                        <tr>
                            <td><span class="label">NIM</span></td>
                            <td><span class="label"> : </span></td>
                            <td><input type="text" name="nim" class="nim" placeholder="Input Nim..."></td>
                        </tr>
                        <tr>
                            <td><span class="label">Program Study</span></td>
                            <td><span class="label"> : </span></td>
                            <td><select name="prodi">
                                    <option disabled selected>Select Program Study</option>
                                    <?php
                                    $result = $con->query("SELECT kode_prodi, nama_prodi FROM prodi");
                                    while ($row = $result->fetch_assoc()) {
                                        $kode = $row["kode_prodi"];
                                        $namaProdi = $row["nama_prodi"];
                                        echo "<option value = '$kode'>$namaProdi</option>";
                                    }
                                    ?>
                                </select></td>
                        </tr>
                        <tr>
                            <td><span class="label">Nama</span></td>
                            <td><span class="label"> : </span></td>
                            <td><input type="text" name="nama" class="nim" placeholder="Input Nama..."></td>
                        </tr>
                        <tr>
                            <td><span class="label">Alamat</span></td>
                            <td><span class="label"> : </span></td>
                            <td><input type="text" name="alamat" class="nim" placeholder="Input Alamat..."></td>
                        </tr>
                    </table>
                    <div class="input_button">
                        <input type="submit" name="submit" value="Create New Mahasiswa">
                    </div>
                </div>
            </div>
        </form>

    </div>
</body>
<style>
    .navList:nth-child(2) {
        background-color: #2886ea;
    }

    .admin {
        display: flex;
    }

    tr:nth-child(even) {
        background-color: none;
    }
</style>

</html>