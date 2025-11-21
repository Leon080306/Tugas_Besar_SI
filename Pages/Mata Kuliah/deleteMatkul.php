<?php
include "../../SQL/connection.php";

if (isset($_GET['kode_mk'])) {
    $kode = $_GET['kode_mk'];

    $sql = "DELETE FROM matkul WHERE kode_mk = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $kode);
    $stmt->execute();
}
header("Location: matkulMenuAdmin.php");
exit();
