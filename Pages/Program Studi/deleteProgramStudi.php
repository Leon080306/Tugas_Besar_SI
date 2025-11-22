<?php
include "../../SQL/connection.php";

if(isset($_GET['kode_prodi'])){
    $kode = $_GET['kode_prodi'];
    $sql = "DELETE FROM prodi WHERE kode_prodi = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $kode);
    $stmt->execute();
}

header("Location: prodiMenuAdmin.php");
exit();
?>