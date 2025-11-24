<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa</title>
    <link rel="icon" href="../../Assets/Icons/pageIcon.png" type="image/png">
    <link rel="stylesheet" href="mahasiswaMenu.css">
</head>

<body>
    <?php
    session_start();
    include "../../Assets/Global Components/navbar.php";
    include "../../SQL/connection.php";

    //untuk encrypt dan decrypt data
    require_once "../../config.php";
    require_once "../../Utils/encryption.php";


    $user_id = $_COOKIE['user_id'];

    $stmt = $con->prepare("SELECT u.user_id, u.nama, u.alamat, m.nim, m.kode_prodi, p.nama_prodi FROM users u JOIN mahasiswa m ON u.user_id = m.user_id JOIN prodi p ON m.kode_prodi = p.kode_prodi WHERE u.user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $line_student = $result->fetch_array();

    if (isset($_SESSION['updated_profile'])) {
        echo "<script>alert('Berhasil update Mahasiswa: " . $_SESSION['updated_profile'] . "');</script>";
        unset($_SESSION['updated_profile']);
    }

    $password = filter_input(INPUT_POST, 'password');
    $nama = filter_input(INPUT_POST, 'nama');
    $prodi = filter_input(INPUT_POST, 'prodi');
    $alamat = filter_input(INPUT_POST, 'alamat');
    $submit = filter_input(INPUT_POST, 'submit');

    if ($submit) {
        if ($password && $prodi && $nama && $alamat) {
            $name_encrypted = encryptData($nama);
            $password_hashed = password_hash($password, PASSWORD_BCRYPT);

            $con->begin_transaction();

            try {
                $stmt_user = $con->prepare("UPDATE users SET nama = ?, alamat = ?, password = ?, updated_at = NOW() WHERE user_id = ?");
                $stmt_user->bind_param("ssss", $name_encrypted, $alamat, $password_hashed, $user_id);
                if (!$stmt_user->execute()) {
                    throw new Exception("Failed to update to users");
                }

                $stmt_mhs = $con->prepare("UPDATE mahasiswa SET kode_prodi = ?, updated_at = NOW() WHERE user_id = ?");
                $stmt_mhs->bind_param("ss", $prodi, $user_id);
                if (!$stmt_mhs->execute()) {
                    throw new Exception("Failed to insert to mahasiswa");
                }
                $con->commit();
                
                $_SESSION['updated_profile'] = $nama;
                header("Location: mahasiswaMenuMahasiswa.php");
                exit;
            } catch (Exception $e) {
                $con->rollback();
                echo "<script>alert('" . json_encode($e->getMessage()) . "');</script>";
                echo "<script>console.error(" . json_encode($e->getMessage()) . ");</script>";
            }
        }
    }

    ?>
    <div id="main">
        <div id="title">
            <h1>Profil Mahasiswa</h1>
            <!-- <a href="" class="button"></a> -->
        </div>

        <div class="container">
            <form method="post">
                <div id="inputFields">
                    <div id="field">
                        <label>Nama :</label>
                        <input type="text" name="nama" value="<?php echo decryptData($line_student["nama"]) ?>" required>
                    </div>
                    <div id="field">
                        <label>Alamat :</label>
                        <input type="text" name="alamat" value="<?php echo $line_student["alamat"] ?>" required>
                    </div>
                    <div id="field">
                        <label>Password :</label>
                        <input type="password" name="password" placeholder="Enter new password" required>
                    </div>
                    <div id="field">
                        <label>Prodi :</label>
                        <select name="prodi" required>
                            <!-- <option disabled selected>Change Program Study (Before: <?php echo $line_student["nama_prodi"] ?>)</option> -->
                            <?php
                            $result = $con->query("SELECT kode_prodi, nama_prodi FROM prodi");
                            while ($row = $result->fetch_assoc()) {
                                $kode = $row["kode_prodi"];
                                $namaProdi = $row["nama_prodi"];
                                if ($line_student["nama_prodi"] == $namaProdi) {
                                    echo "<option selected value = '$kode'>$namaProdi (Current Prodi)</option>";
                                } else {
                                    echo "<option value = '$kode'>$namaProdi </option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <input type="submit" name="submit" class="button" value="Update">
                </div>
            </form>
        </div>
    </div>
</body>
<style>
    .navList:nth-child(3) {
        background-color: #2886ea;
    }

    .mahasiswa {
        display: flex;
    }
</style>

</html>