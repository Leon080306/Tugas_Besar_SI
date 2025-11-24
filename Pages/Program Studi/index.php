<?php
    if($_COOKIE["user_role"] == "A") {
        header("Location: prodiMenuAdmin.php");
    }
    else if($_COOKIE["user_role"] == "M") {
        header("Location: prodiMenuMahasiswa.php");
    }
    else {
        header("Location: ../SignUp&Login");
    }
?>