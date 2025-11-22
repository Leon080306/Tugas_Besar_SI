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

    $user_id = $_GET['user_id'];
    $stmt_call_information_student = $con->prepare("SELECT u.user_id, u.nama, u.alamat, m.nim, m.kode_prodi FROM users u JOIN mahasiswa m ON u.user_id = m.user_id WHERE u.user_id = ?");
    $stmt_call_information_student->bind_param("s", $user_id);
    $stmt_call_information_student->execute();
    $result = $stmt_call_information_student->get_result();
    $line_call_student = $result->fetch_array();

    $nim = filter_input(INPUT_POST, 'nim');
    $nama = filter_input(INPUT_POST, 'nama');
    $prodi = filter_input(INPUT_POST, 'prodi');
    $alamat = filter_input(INPUT_POST, 'alamat');
    $submit = filter_input(INPUT_POST, 'submit');

    if ($submit) {
        if ($nim && $prodi && $nama && $alamat) {
            $name_encrypted = encryptData($nama);

            $con->begin_transaction();

            try {
                $stmt_user = $con->prepare("UPDATE users SET nama = ?, alamat = ?, updated_at = NOW() WHERE user_id = ?");
                $stmt_user->bind_param("sss", $name_encrypted, $alamat, $user_id);
                if (!$stmt_user->execute()) {
                    throw new Exception("Failed to update to users");
                }

                $stmt_mhs = $con->prepare("UPDATE mahasiswa SET nim = ?, kode_prodi = ?, updated_at = NOW() WHERE user_id = ?");
                $stmt_mhs->bind_param("sss", $nim, $prodi, $user_id);
                if (!$stmt_mhs->execute()) {
                    throw new Exception("Failed to insert to mahasiswa");
                }
                $con->commit();
                echo "<script>alert('Berhasil update Mahasiswa: " . $nama . "');</script>";
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
                            <td><input type="text" name="nim" class="nim" value="<?php echo $line_call_student["nim"] ?>"></td>
                        </tr>
                        <tr>
                            <td><span class="label">Program Study</span></td>
                            <td><span class="label"> : </span></td>
                            <td><select name="prodi">
                                    <?php
                                    $result = $con->query("SELECT kode_prodi, nama_prodi FROM prodi");
                                    while ($row = $result->fetch_assoc()) {
                                        $kode = $row["kode_prodi"];
                                        $namaProdi = $row["nama_prodi"];
                                        if ($line_call_student["kode_prodi"] == $kode) {
                                            echo "<option selected value = '$kode'>$namaProdi (Current Prodi)</option>";
                                        } else {
                                            echo "<option value = '$kode'>$namaProdi </option>";
                                        }
                                    }
                                    ?>
                                </select></td>
                        </tr>
                        <tr>
                            <td><span class="label">Nama</span></td>
                            <td><span class="label"> : </span></td>
                            <td><input type="text" name="nama" class="nim" value="<?php echo decryptData($line_call_student["nama"]) ?>"></td>
                        </tr>
                        <tr>
                            <td><span class="label">Alamat</span></td>
                            <td><span class="label"> : </span></td>
                            <td><input type="text" name="alamat" class="nim" value="<?php echo $line_call_student["alamat"] ?>"></td>
                        </tr>
                    </table>
                    <div class="input_button">
                        <input type="submit" name="submit" value="Update Mahasiswa <?php echo decryptData($line_call_student["nama"]) ?>">
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