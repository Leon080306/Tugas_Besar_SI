<?php
    if($_COOKIE["user_role"] == "A") {
        header("Location: matkulMenuAdmin.php");
    }
    else if($_COOKIE["user_role"] == "M") {
        header("Location: matkulMenuMahasiswa.php");
    }
?>