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
    ?>
    <div id="main">
        <form method = "post">
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
                <input type="submit" class = "button" value="Sign In">
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