<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="icon" href="../../Assets/Icons/pageIcon.png" type="image/png">
    <link rel="stylesheet" href="signup&login.css">
    <style>
        form {
            height: 95%;
        }

        #inputFields {
            margin: 0;
        }
    </style>
</head>

<body>
    <?php
    include "../../Assets/Global Components/navbar.php";
    require_once "../../SQL/connection.php";

    //untuk encrypt dan decrypt data
    require_once "../../config.php";
    require_once "../../Utils/encryption.php";

    //uuid generator
    require_once "../../Utils/uuidGenerator.php";

    if (isset($_POST["nim"]) && isset($_POST["password"]) && isset($_POST["name"])) {
        $userID = generateUUID();
        $nim = $_POST["nim"];
        $name = encryptData($_POST["name"]);
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
        $address = $_POST["address"] ?? "";
        $prodi = $_POST["prodi"];
        
        $con->begin_transaction();

        try {
            $sql_user = "INSERT INTO users (user_id, nama, alamat, password) VALUES (?, ?, ?, ?)";
            $stmt_user = $con->prepare($sql_user);
            $stmt_user->bind_param("ssss",  $userID, $name, $address, $password);
            if(!$stmt_user->execute()) {
                throw new Exception("Failed to insert to users");
            }
            if($stmt_user->affected_rows !== 1) {
                throw new Exception("Failed to insert to users");
            }

            $sql_mhs = "INSERT INTO mahasiswa (nim, user_id, kode_prodi) VALUES (?, ?, ?)";
            $stmt_mhs = $con->prepare($sql_mhs);
            $stmt_mhs->bind_param("sss", $nim, $userID, $prodi);
            if(!$stmt_mhs->execute()) {
                throw new Exception("Failed to insert to mahasiswa");
            }
            if($stmt_mhs->affected_rows !== 1) {
                throw new Exception("Failed to insert to mahasiswa");
            }
            $con->commit();

            setcookie('user_id', $userID, time() + (86400 * 30), '/', '', false, true);
            setcookie('user_role', 'M', time() + (86400 * 30), '/', '', false, true);
            header("Location: ../Dashboard");
            exit;
        } catch (Exception $e) {
            $con->rollback();
            echo "<script>console.error(" . json_encode($e->getMessage()) . ");</script>";
        }
    }
    ?>
    <div id="main">
        <form method="post">
            <div id="loginTitle">
                <img style="width: 100px; height: 100px;" src="../../Assets/Icons/loginHeader.png" alt="" class="icons">
                <h1>Create your Account</h1>
                <p>Please enter your details to get started</p>
            </div>

            <div id="inputFields">
                <input type="text" name="nim" placeholder="NIM" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="text" name="address" placeholder="Address">
                <select name="prodi">
                    <option disabled selected>Program Studi</option>
                    <?php
                    $result = $con->query("SELECT kode_prodi, nama_prodi FROM prodi");
                    while ($row = $result->fetch_assoc()) {
                        $kode = $row["kode_prodi"];
                        $namaProdi = $row["nama_prodi"];

                        echo "<option value = '$kode'>$namaProdi</option>";
                    }
                    ?>
                </select>
            </div>

            <div id="actions">
                <input type="submit" class="button" value="Sign Up">
                <a href="login.php">Already have an account?</a>
            </div>
        </form>
    </div>
</body>

<style>
    #sidebar {
        display: none;
    }

    #main {
        width: 100%;
        left: 0;
    }

    #drawerMenu {
        display: none;
    }

    #drawerIcon {
        display: none;
    }
</style>

</html>