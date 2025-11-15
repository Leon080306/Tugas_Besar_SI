<?php
    if($_COOKIE["user_role"] == "A") {
        header("Location: nilaiMenuAdmin.php.php");
    }
    else if($_COOKIE["user_role"] == "M") {
        header("Location: nilaiMenuMahasiswa.php");
    }
?>