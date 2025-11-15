<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Admin Account</title>
    <link rel="icon" href="../../Assets/Icons/pageIcon.png" type="image/png">
    <link rel="stylesheet" href="signup&login.css">
    <style>
        form {
            height: 85%;
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

    if (isset($_POST["nik"]) && isset($_POST["password"]) && isset($_POST["name"])) {
        $userID = generateUUID();
        $nik = $_POST["nik"];
        $name = encryptData($_POST["name"]);
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
        $address = $_POST["address"] ?? "";
        
        $con->begin_transaction();

        try {
            $sql_user = "INSERT INTO users (user_id, nama, alamat, password, user_role) VALUES (?, ?, ?, ?, ?)";
            $stmt_user = $con->prepare($sql_user);
            $userRole = "A";
            $stmt_user->bind_param("sssss",  $userID, $name, $address, $password, $userRole);
            if(!$stmt_user->execute()) {
                throw new Exception("Failed to insert to users");
            }
            if($stmt_user->affected_rows !== 1) {
                throw new Exception("Failed to insert to users");
            }

            $sql_admin = "INSERT INTO admin (nik, user_id) VALUES (?, ?)";
            $stmt_admin = $con->prepare($sql_admin);
            $stmt_admin->bind_param("ss", $nik, $userID);
            if(!$stmt_admin->execute()) {
                throw new Exception("Failed to insert to admin");
            }
            if($stmt_admin->affected_rows !== 1) {
                throw new Exception("Failed to insert to admin");
            }
            $con->commit();

            setcookie('user_id', $userID, time() + (86400 * 30), '/', '', false, true);
            setcookie('user_role', 'A', time() + (86400 * 30), '/', '', false, true);
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
                <h1>Add New Admin Account</h1>
                <p>Please enter account details to get started</p>
            </div>

            <div id="inputFields">
                <input type="text" name="nik" placeholder="NIK" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="text" name="address" placeholder="Address">
            </div>

            <div id="actions">
                <input type="submit" class="button" value="Add Account">
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