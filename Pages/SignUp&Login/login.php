<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="signup&login.css">
    <link rel="icon" href="../../Assets/Icons/pageIcon.png" type="image/png">
</head>

<body>
    <?php
    include "../../Assets/Global Components/navbar.php";
    include "../../SQL/connection.php";

    session_start();
    if (isset($_SESSION['login_error'])) {
        $error_message = $_SESSION['login_error'];
        echo "<script>alert('" . $error_message . "');</script>";
        unset($_SESSION['login_error']); // Hapus pesan setelah ditampilkan
    }

    $personID = filter_input(INPUT_POST, 'nim|nik');
    $password_raw = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);
    $submit = filter_input(INPUT_POST, 'submit');

    if ($submit) {
        if ($personID && $password_raw) {
            $stmt_mhs = $con->prepare("SELECT * FROM mahasiswa m JOIN users u ON m.user_id = u.user_id WHERE m.nim = ?");
            $stmt_mhs->bind_param("s", $personID);
            $stmt_mhs->execute();
            $result = $stmt_mhs->get_result();

            if ($stmt_mhs->num_rows === 0) {
                $stmt_adm = $con->prepare("SELECT * FROM admin a JOIN users u ON a.user_id = u.user_id WHERE a.nik = ?");
                $stmt_adm->bind_param("s", $personID);
                $stmt_adm->execute();
                $result = $stmt_adm->get_result();
            }

            $line = $result->fetch_assoc();

            if ($result->num_rows > 0) {
                if (password_verify($password_raw, $line['password'])) {
                    setcookie("user_id", $line['user_id'], time() + (86400 * 30), "/");
                    setcookie("user_role", $line['user_role'], time() + (86400 * 30), "/");
                    header("Location: ../../Pages/Dashboard/index.php");
                    exit();
                } else {
                    $error = "Incorrect password.";
                }
            } else {
                $error = "NIM/NIK not found.";
            }

            if (!empty($error)) {
                $_SESSION['login_error'] = $error;
                header("Location: login.php");
                exit();
            } else {
                $_SESSION['login_error'] = "Input tidak boleh kosong!";
                header("Location: login.php");
                exit();
            }


        }
    }


    ?>
    <div id="main">
        <form method="post">
            <div id="loginTitle">
                <img style="width: 100px; height: 100px;" src="../../Assets/Icons/loginHeader.png" alt="" class="icons">
                <h1>Welcome Back</h1>
                <p>Sign in to your account</p>
            </div>

            <div id="inputFields">
                <input type="text" name="nim|nik" placeholder="NIM/NIK" required>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div id="actions">
                <input type="submit" name="submit" class="button" value="Sign In">
                <a href="signup.php">Don't have an account yet?</a>
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