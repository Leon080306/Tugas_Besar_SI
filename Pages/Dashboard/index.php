<?php
    if($_COOKIE["user_role"] == "A") {
        header("Location: dashboardAdmin.php");
    }
    else if($_COOKIE["user_role"] == "M") {
        header("Location: dashboardMahasiswa.php");
    }
?>