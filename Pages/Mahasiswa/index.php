<?php
    if($_COOKIE["user_role"] == "A") {
        header("Location: mahasiswaMenuAdmin.php");
    }
    else if($_COOKIE["user_role"] == "M") {
        header("Location: mahasiswaMenuMahasiswa.php");
    }
    else {
        header("Location: ../SignUp&Login");
    }
?>