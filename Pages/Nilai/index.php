<?php
    if($_COOKIE["user_role"] == "A") {
        header("Location: nilaiMenuAdmin.php");
    }
    else if($_COOKIE["user_role"] == "M") {
        header("Location: nilaiMenuMahasiswa.php");
    }
    else {
        header("Location: ../SignUp&Login");
    }
?>