<?php
    if(isset($_COOKIE["user_id"]) && isset($_COOKIE["user_role"])) {
        header("Location: ../Dashboard");
        exit;
    }
    else {
        header("Location: login.php");
        exit;
    }
?>