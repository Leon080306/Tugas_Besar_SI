<?php
include "../../SQL/connection.php";

if (isset($_GET['kode_mk']) && isset($_GET['nim'])) {
    $kode = $_GET['kode_mk'];
    $nim = $_GET['nim'];
    $sql = "DELETE FROM nilai WHERE kode_mk = ? AND nim = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $kode , $nim);
    $stmt->execute();
}
header("Location: nilaiMenuAdmin.php");
exit();
?>